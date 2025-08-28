<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GoalResource;
use App\Http\Resources\PlanResource;
use App\Http\Resources\UserResource;
use App\Models\DemoPlanLog;
use App\Models\Goal;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller {
    /**
     * @OA\Get(
     *      path="/api/my-profile",
     *      tags={"My Profile"},
     *      summary="نمایش پروفایل من",
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
    public function show () {
        $user = Auth::user();
        $current_plan = $user->plans()
                             ->latest()
                             ->first();
        $fake_plan = Plan::first();
        $fake_plan->title = "اشتراک";

        $has_demo = DemoPlanLog::query()
            ->where('user_id', $user->id)
            ->exists();

        return response()->json([
                                    'user' => UserResource::make($user) ,
                                    'current_plan' => $current_plan ? PlanResource::make($current_plan) : null ,
                                    'goals' => GoalResource::collection($user->goals()
                                                                             ->get()) ,
                                    'app_version' => '2.0.0' ,
                                    'purchased_plans_count' => $user->plans()
                                                                    ->count() ,
                                    'has_demo' => !$current_plan && $has_demo,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/my-profile/update",
     *      tags={"My Profile"},
     *      summary="آپدیت نام و آواتار (هم در ثبت نام اولیه استفاده شود هم در آپدیت)",
     *      description="",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateMyProfileRequestBody")
     *     ),
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
    public function update ( Request $request ) {
        $request->validate([
                               'name' => [ 'required' ] ,
                               'avatar_id' => [
                                   'required' ,
                                   'exists:avatars,id',
                               ] ,
                           ]);
        $user = Auth::user();
        $user->register_completed_at = now();
        $user->name = $request->name;
        $user->avatar_id = $request->avatar_id;
        $user->save();

        return response()->json([
                                    'user' => UserResource::make($user->refresh()) ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/my-profile/update-goals",
     *      tags={"My Profile"},
     *      summary="آپدیت اهداف من - حداقل و حداکثر 3 مورد ارسال شود",
     *      description="",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateGoalsRequestBody")
     *     ),
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
    public function updateGoals ( Request $request ) {
        $request->validate([
                               'goal_ids' => [
                                   'required' ,
                                   'array' ,
                                   'size:3',
                               ] ,
                           ]);
        $goals = Goal::whereIn('id' , $request->goal_ids)
                     ->get();
        $user = Auth::user();
        $user->goals()
             ->sync($goals);

        return response()->json([
                                    'user' => UserResource::make($user),
                                ] , 200);
    }

    /**
     * @OA\Get(
     *      path="/api/my-profile/show-note",
     *      tags={"My Profile"},
     *      summary="نمایش یادداشت من",
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
    public function showNote () {
        $user = Auth::user();

        return response()->json([
                                    'note' => $user->note ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/my-profile/update-note",
     *      tags={"My Profile"},
     *      summary="آپدیت یادداشت من",
     *      description="",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateNoteRequestBody")
     *     ),
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
    public function updateNote ( Request $request ) {
        $request->validate([
                               'note' => [ 'required' ] ,
                           ]);
        $user = Auth::user();
        $user->note = $request->get('note');
        $user->save();

        return response()->json([
                                    'note' => $user->note ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/my-profile/update-firebase-token",
     *      tags={"My Profile"},
     *      summary="آپدیت توکن فایربیس",
     *      description="",
     *     	 @OA\Parameter(
     *         description="firebase_token",
     *         in="query",
     *         name="firebase_token",
     *         required=false,
     *         @OA\Schema(type="string"),
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
    public function updateFirebaseToken ( Request $request ) {
        $request->validate([
                               'firebase_token' => [ 'required' ] ,
                           ]);
        $user = Auth::user();
        $user->firebase_token = $request->get('firebase_token');
        $user->save();

        return response()->json([
                                    'status' => true ,
                                    'message' => "توکن با موفقیت آپدیت شد." ,
                                ]);
    }

    /**
     * @OA\Get(
     *      path="/api/my-profile/get-firebase-token",
     *      tags={"My Profile"},
     *      summary="دریافت توکن فایربیس",
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
    public function getFirebaseToken ( Request $request ) {
        $user = Auth::user();

        return response()->json([
                                    'firebase_token' => $user->firebase_token ,
                                ]);
    }
}
