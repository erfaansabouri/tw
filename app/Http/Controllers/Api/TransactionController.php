<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;

class TransactionController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/transactions/generate-link",
     *      tags={"Transaction"},
     *      summary="دریافت لینک پرداخت درگاه",
     *      description="",
     *     @OA\Parameter(
     *         example="1",
     *         name="plan_id",
     *         in="query",
     *         description="آی دی پلان مورد نظر را ارسال کنید",
     *         required=true,
     *         explode=true
     *     ),
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     @OA\Response(response=204, description="Successful"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     *     security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */
    public function generateLink(Request $request)
    {
        $request->validate([
            'plan_id' => ['required', 'exists:plans,id']
        ]);
        $plan = Plan::query()->findOrFail($request->plan_id);
        $transaction = Transaction::query()
            ->create([
                'user_id' => Auth::user()->id,
                'plan_id' => $request->plan_id,
                'total_price' => $plan->total_price,
            ]);

        $payment = Payment::callbackUrl(route('transaction.verify'))->purchase(
            (new Invoice)->amount($plan->total_price)->detail('mobile', Auth::user()->phone),
            function($driver, $transactionId) use ($transaction){
                $transaction->transaction_id = $transactionId;
                $transaction->save();
            }
        )->pay()->toJson();

        return response()->json([
            'price' => $plan->total_price,
            'link' => json_decode($payment)->action
        ]);
    }


    public function verify(Request $request)
    {
        $transaction = Transaction::query()
            ->where('transaction_id', $request->Authority)
            ->notVerified()
            ->firstOrFail();


        $plan = Plan::findOrFail($transaction->plan_id);

        $user = User::findOrFail($transaction->user_id);
        try {
            $receipt = Payment::amount($transaction->total_price)->transactionId($request->Authority)->verify();
            $transaction->reference_id = $receipt->getReferenceId();
            $transaction->order_id = $request->orderId;
            $transaction->verified_at = now();
            $transaction->save();
            $user->addCredit($plan);
            return redirect()->route('transaction.sub-success');
        } catch (InvalidPaymentException $exception) {
            $transaction->order_id = $request->orderId;
            $transaction->save();
            return redirect()->route('transaction.sub-failed');
        }
        return view('payment.callback', compact('request'));
    }

    public function subSuccess(Request $request)
    {
        $agent = new Agent($request->server->all());
        return view('payment.sub-success', compact('agent'));
    }

    public function subFailed(Request $request)
    {
        $agent = new Agent($request->server->all());
        return view('payment.sub-failed', compact('agent'));

    }
}
