<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationFeatureResource;
use App\Http\Resources\AvatarResource;
use App\Http\Resources\GoalResource;
use App\Http\Resources\HabitResource;
use App\Http\Resources\InstructionResource;
use App\Http\Resources\UserResource;
use App\Models\ApplicationFeature;
use App\Models\Avatar;
use App\Models\Goal;
use App\Models\Habit;
use App\Models\Instruction;
use App\Models\User;
use App\Rules\IranPhoneRule;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FriendController extends Controller {
    /**
     * @OA\Post(
     *      path="/api/social/add-friend",
     *      tags={"Social"},
     *      summary="Add friend",
     *     @OA\Parameter(
     *          description="phone",
     *          in="query",
     *          name="phone",
     *          required=true,
     *          @OA\Schema(type="string"),
     *      ),
     * @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     * @OA\Response(response=204, description="Successful"),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Not Found"),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * security={
     * {
     * "bearerAuth": {}
     * }
     * },
     * )
     */
    public function addFriend ( Request $request ) {
        $request->validate([
                               'phone' => [
                                   'required' ,
                                   new IranPhoneRule() ,
                               ] ,
                           ]);
        $user = Auth::user();
        if ( $user->friend_user_id ) {
            throw ValidationException::withMessages([ 'error' => ' امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $friend = User::query()
                      ->where('id' , '!=' , $user->id)
                      ->where('phone' , $request->get('phone'))
                      ->whereNull('friend_user_id')
                      ->first();
        if ( !$friend ) {
            throw ValidationException::withMessages([ 'error' => 'امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $user->friend_user_id = $friend->id;
        $user->save();

        return response()->json([
                                    'success' => "درخواست شما به $friend->phone ارسال شد" ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/social/remove-friend",
     *      tags={"Social"},
     *      summary="remove friend",
     * @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     * @OA\Response(response=204, description="Successful"),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Not Found"),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * security={
     * {
     * "bearerAuth": {}
     * }
     * },
     * )
     */
    public function removeFriend ( Request $request ) {
        $user = Auth::user();
        if ( !$user->friend_user_id ) {
            throw ValidationException::withMessages([ 'error' => ' امکان حذف این هم مسیر وجود ندارد' ]);
        }

        Habit::query()
             ->whereIn('user_id' , [
                 $user->id ,
                 $user->friend_user_id,
             ])
             ->where('is_dual', true)
             ->delete();

        User::query()
            ->where('id' , $user->friend_user_id)
            ->update([
                         'friend_user_id' => null ,
                     ]);
        $user->friend_user_id = null;
        $user->save();


        return response()->json([
                                    'success' => "دوست شما حذف شد" ,
                                ]);
    }

    /**
     * @OA\Get(
     *      path="/api/social/show-friend",
     *      tags={"Social"},
     *      summary="show friend",
     * @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     * @OA\Response(response=204, description="Successful"),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Not Found"),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * security={
     * {
     * "bearerAuth": {}
     * }
     * },
     * )
     */
    public function showFriend ( Request $request ) {
        $user = Auth::user();
        if ( !$user->friend_user_id ) {
            throw ValidationException::withMessages([ 'error' => ' امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $friend = User::query()
                      ->where('id' , $user->friend_user_id)
                      ->firstOrFail();
        $habits = Habit::query()
                       ->where('is_dual' , true)
                       ->whereIn('user_id' , [
                           $user->id ,
                           $user->friend_user_id ,
                       ])
                       ->get();
        $habits = HabitResource::collection($habits);

        return response()->json([
                                    'friend_user' => UserResource::make($friend) ,
                                    'habits' => $habits ,
                                    'accepted' => $friend->friend_user_id == $user->id,
                                ]);
    }

    /**
     * @OA\Get(
     *      path="/api/social/show-friend-request",
     *      tags={"Social"},
     *      summary="remove friend",
     * @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     * @OA\Response(response=204, description="Successful"),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Not Found"),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * security={
     * {
     * "bearerAuth": {}
     * }
     * },
     * )
     */
    public function showFriendRequest ( Request $request ) {
        $user = Auth::user();
        if ( $user->friend_user_id ) {
            throw ValidationException::withMessages([ 'error' => ' امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $friend = User::query()
                      ->where('friend_user_id' , $user->id)
                      ->first();
        if ( !$friend ) {
            throw ValidationException::withMessages([ 'error' => 'درخواستی ندارید' ]);
        }

        return response()->json([
                                    'friend_user' => UserResource::make($friend) ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/social/accept-friend-request",
     *      tags={"Social"},
     *      summary="remove friend",
     * @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     * @OA\Response(response=204, description="Successful"),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Not Found"),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * security={
     * {
     * "bearerAuth": {}
     * }
     * },
     * )
     */
    public function acceptFriendRequest ( Request $request ) {
        $user = Auth::user();
        if ( $user->friend_user_id ) {
            throw ValidationException::withMessages([ 'error' => ' امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $friend = User::query()
                      ->where('friend_user_id' , $user->id)
                      ->first();
        if ( !$friend ) {
            throw ValidationException::withMessages([ 'error' => ' امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $user->friend_user_id = $friend->id;
        $user->save();

        return response()->json([
                                    'friend_user' => UserResource::make($friend) ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/social/decline-friend-request",
     *      tags={"Social"},
     *      summary="decline friend request",
     * @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     * @OA\Response(response=204, description="Successful"),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Not Found"),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * security={
     * {
     * "bearerAuth": {}
     * }
     * },
     * )
     */
    public function declineFriendRequest ( Request $request ) {
        $user = Auth::user();
        if ( $user->friend_user_id ) {
            throw ValidationException::withMessages([ 'error' => ' امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $friend = User::query()
                      ->where('friend_user_id' , $user->id)
                      ->first();
        if ( !$friend ) {
            throw ValidationException::withMessages([ 'error' => ' امکان افزودن این هم مسیر وجود ندارد' ]);
        }
        $user->friend_user_id = null;
        $user->save();
        $friend->friend_user_id = null;
        $friend->save();

        return response()->json([
                                    'success' => "درخواست دوستی رد شد" ,
                                ]);
    }
}
