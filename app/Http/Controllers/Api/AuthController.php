<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Jobs\VerifyCodeSmsJob;
use App\Models\User;
use App\Models\VerificationCode;
use App\Rules\IranPhoneRule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/get-sms",
     *      tags={"Authenticate"},
     *      summary="دریافت کد ورود جهت ثبت نام یا ورود",
     *      description="",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/GetSmsRequestBody")
     *     ),
     *
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     @OA\Response(response=204, description="Successful"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function getSms(Request $request)
    {
        $request->validate([
            'phone' => ['required', new IranPhoneRule()],
        ]);
        $phone = Helper::standardPhone($request->phone);

        if ($phone == config('services.google_play.test_phone')){
            return response()->json([
                                        'status' => true,
                                        'message' => 'کد با موفقیت ارسال شد.',
                                    ]);
        }
        $code = 9999;
        if ($cooldownSeconds = Helper::getSmsCooldown($phone)) {
            throw ValidationException::withMessages(['phone' => "لطفا {$cooldownSeconds} ثانیه دیگر تلاش کنید."]);
        }
        VerificationCode::query()
            ->create([
                'phone' => $phone,
                'code' => $code,
            ]);
        VerifyCodeSmsJob::dispatchSync($code, $phone);
        return response()->json([
            'status' => true,
            'message' => 'کد با موفقیت ارسال شد.',
            //'code' => $code,
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/verify-code",
     *      tags={"Authenticate"},
     *      summary="ورود کد تایید",
     *      description="",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/VerifyCodeRequestBody")
     *     ),
     *
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     @OA\Response(response=204, description="Successful"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'phone' => ['required', new IranPhoneRule()],
            'code' => ['required', 'numeric'],
        ]);
        $phone = Helper::standardPhone($request->phone);
        if ($phone == config('services.google_play.test_phone') && $request->code == '9876'){
            $user = User::query()
                        ->where('phone', $phone)
                        ->first();
            return response()->json([
                                        'user' => UserResource::make($user),
                                        'bearer_token' => $user->createToken('twenty-one')->plainTextToken,
                                    ]);
        }
        $verificationCode = VerificationCode::query()
            ->where('phone', $phone)
            ->where('code', $request->code)
            ->notUsed()
            ->latest()
            ->first();
        if (! $verificationCode) {
            throw ValidationException::withMessages(['code' => 'کد تایید نا معتبر میباشد.']);
        }
        $user = User::query()
            ->where('phone', $phone)
            ->first();
        if (! $user) {
            $user = new User();
            $user->phone = $phone;
            $user->premium_expired_at = now()->subMinute();
            $user->save();
            $user->refresh();
        }
        $verificationCode->used_at = now();
        $verificationCode->save();

        return response()->json([
            'user' => UserResource::make($user),
            'bearer_token' => $user->createToken('twenty-one')->plainTextToken,
        ]);
    }
}
