<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Habit;
use App\Models\HabitDayExercise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitDayExerciseController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/habit-day-exercises/update/{id}",
     *      tags={"Habit-Day-Exercise"},
     *      summary="آپدیت جواب یک تمرین از یک روز",
     *      description="",
     *     	 @OA\Parameter(
     *         description="آیدی تمرین",
     *         in="path",
     *         name="id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateHabitDayExerciseRequestBody")
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
    public function update ( Request $request , $id ) {
        $request->validate([
                               'answer' => [ 'nullable' ] ,
                           ]);
        $habitDayExercise = HabitDayExercise::query()
                                            ->where('id' , $id)
                                            ->firstOrFail();
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habitDayExercise->habitDay->habitWeek->habit->id)
                      ->firstOrFail();

        $dynamic_column = $habit->isMine() ? 'answer' : 'friend_answer';

        if ( !$request->answer ) {
            $habitDayExercise->$dynamic_column = null;
        }
        else {
            $habitDayExercise->$dynamic_column = json_encode($request->answer);
        }
        $habitDayExercise->save();

        return response()->json(null , 204);
    }
}
