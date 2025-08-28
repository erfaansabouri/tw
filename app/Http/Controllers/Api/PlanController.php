<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DemoPlanResource;
use App\Http\Resources\PlanResource;
use App\Models\DemoPlan;
use App\Models\DemoPlanLog;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PlanController extends Controller {
    /**
     * @OA\Get(
     *      path="/api/plans",
     *      tags={"Plan"},
     *      summary="لیست پلان های قابل خریداری",
     *
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
    public function index () {
        $plans = Plan::ordered()
                     ->get();

        return response()->json([
                                    'plans' => PlanResource::collection($plans) ,
                                ]);
    }

    /**
     * @OA\Get(
     *      path="/api/plans/demo",
     *      tags={"Demo Plans"},
     *      summary="لیست پلان های دمو",
     *
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
    public function demoIndex () {
        $user = Auth::user();

        if ($user->is_premium){
            return response()->json([
                                        'demo_plans' => [] ,
                                    ]);
        }
        $demo_plans = DemoPlan::all();

        return response()->json([
                                    'demo_plans' => DemoPlanResource::collection($demo_plans) ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/plans/active-demo/{demo_plan_id}",
     *      tags={"Demo Plans"},
     *      summary="فعال سازی دمو",
     *          	 @OA\Parameter(
     *          description="آیدی demo plan",
     *          in="path",
     *          name="demo_plan_id",
     *          required=false,
     *          @OA\Schema(type="integer"),
     *      ),
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
    public function activeDemo ( $demo_plan_id ) {
        $user = \Auth::user();
        $demo_plan = DemoPlan::query()
                             ->where('id' , $demo_plan_id)
                             ->firstOrFail();
        $demo_plan_log = DemoPlanLog::query()
                                    ->where('user_id' , $user->id)
                                    ->first();
        if ( $demo_plan_log ) {
            throw ValidationException::withMessages([ 'error' => 'شما قبلا از دمو استفاده کرده اید' ]);
        }
        DemoPlanLog::query()
                   ->create([
                                'user_id' => $user->id ,
                                'demo_plan_id' => $demo_plan_id,
                            ]);
        $user->premium_expired_at = Carbon::now()
                                          ->addDays((int)$demo_plan->days);
        $user->save();

        return response()->json([
                                    'message' => "دمو با موفقیت فعال شد" ,
                                ]);
    }
}
