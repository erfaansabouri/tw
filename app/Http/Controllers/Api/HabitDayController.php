<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExerciseQuestionResource;
use App\Http\Resources\HabitDayResource;
use App\Models\ExerciseAnswer;
use App\Models\ExerciseQuestion;
use App\Models\Habit;
use App\Models\HabitDayExercise;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class HabitDayController extends Controller {
    /**
     * @OA\Get(
     *     path="/api/habit-days/show/{habit_id}/{number}",
     *     summary="نمایش یک روز از یک عادت",
     *     tags={"Habit-Days"},
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره روز",
     *         in="path",
     *         name="number",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *
     *     @OA\Response(response=200, description="Successful",@OA\JsonContent()),
     *     @OA\Response(response=204, description="Successful"),
     *     @OA\Response(response=400, description="Badrequest"),
     *     @OA\Response(response=404, description="NotFound"),
     *     @OA\Response(response=401, description="Unauthenticated",@OA\JsonContent()),
     *     security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */
    public function show ( Request $request , $habit_id , $number ) {
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habit_id)
                      ->firstOrFail();
        $habitDay = $habit->habitDays()
                          ->with([ 'lessons' ])
                          ->where('habit_days.number' , $number)
                          ->firstOrFail();

        return response()->json([
                                    'day' => HabitDayResource::make($habitDay) ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habit-days/update-followup-value/{habit_id}/{number}",
     *      tags={"Habit-Days"},
     *      summary="آپدیت مقدار پیگیری یک روز از یک عادت",
     *      description="",
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره روز",
     *         in="path",
     *         name="number",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateFollowUpValueRequestBody")
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
    public function updateFollowupValue ( Request $request , $habit_id , $number ) {
        $request->validate([
                               'followup_value' => [
                                   'required' ,
                                   'numeric' ,
                               ] ,
                           ]);
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habit_id)
                      ->firstOrFail();
        $habitDay = $habit->habitDays()
                          ->where('habit_days.number' , $number)
                          ->firstOrFail();
        if ( $habit->isMine() ) {
            $habitDay->followup_value = $request->followup_value;
            $habitDay->done_at = now();
            $habitDay->save();
        }
        else {
            $habitDay->friend_followup_value = $request->followup_value;
            $habitDay->done_at = now();
            $habitDay->save();
        }

        return response()->json(null , 204);
    }

    /**
     * @OA\Post(
     *      path="/api/habit-days/update-satisfaction-percentage/{habit_id}/{number}",
     *      tags={"Habit-Days"},
     *      summary="آپدیت مقدار درصد رضایت یک روز از یک عادت",
     *      description="",
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره روز",
     *         in="path",
     *         name="number",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateSatisfactionPercentageRequestBody")
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
    public function updateSatisfactionPercentage ( Request $request , $habit_id , $number ) {
        $request->validate([
                               'satisfaction_percentage' => [
                                   'required' ,
                                   'numeric' ,
                                   'min:0' ,
                                   'max:100' ,
                               ] ,
                           ]);
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habit_id)
                      ->firstOrFail();
        $habitDay = $habit->habitDays()
                          ->where('habit_days.number' , $number)
                          ->firstOrFail();
        if ( $habit->isMine() ) {
            $habitDay->satisfaction_percentage = $request->satisfaction_percentage;
            $habitDay->done_at = now();
            $habitDay->save();
        }
        else {
            $habitDay->friend_satisfaction_percentage = $request->satisfaction_percentage;
            $habitDay->done_at = now();
            $habitDay->save();
        }

        return response()->json(null , 204);
    }

    /**
     * @OA\Post(
     *      path="/api/habit-days/update-satisfaction-emoji/{habit_id}/{number}",
     *      tags={"Habit-Days"},
     *      summary="آپدیت ایموجی",
     *      description="",
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره روز",
     *         in="path",
     *         name="number",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *      @OA\Parameter(
     *          description="شماره ایموجی بین 1 تا 4",
     *          in="query",
     *          name="satisfaction_emoji",
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
    public function updateSatisfactionEmoji ( Request $request , $habit_id , $number ) {
        $request->validate([
                               'satisfaction_emoji' => [
                                   'required' ,
                                   'numeric' ,
                                   'min:1' ,
                                   'max:4' ,
                               ] ,
                           ]);
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habit_id)
                      ->firstOrFail();
        $habitDay = $habit->habitDays()
                          ->where('habit_days.number' , $number)
                          ->firstOrFail();
        if ( $habit->isMine() ) {
            $habitDay->satisfaction_emoji = $request->satisfaction_emoji;
            $habitDay->done_at = now();
            $habitDay->save();
        }
        else {
            $habitDay->friend_satisfaction_emoji = $request->satisfaction_emoji;
            $habitDay->done_at = now();
            $habitDay->save();
        }
        if ( $habit->is_dual ) {
            $user = Auth::user();
            $text = "{$user->name} روز {$habitDay->number} از عادت مشترکتون رو کامل کرد 😍";
            if ( $habit->isMine() ) {
                $habit->sendFcmToFriend($text);
            }
            else {
                $habit->sendFcmToOwner($text);
            }
        }

        return response()->json(null , 204);
    }

    /**
     * @OA\Post(
     *      path="/api/habit-days/update-note/{habit_id}/{number}",
     *      tags={"Habit-Days"},
     *      summary="آپدیت یادداشت",
     *      description="",
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره روز",
     *         in="path",
     *         name="number",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateHabitDayNoteRequestBody")
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
    public function updateNote ( Request $request , $habit_id , $number ) {
        $request->validate([
                               'note' => [ 'required' ] ,
                           ]);
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habit_id)
                      ->firstOrFail();
        $habitDay = $habit->habitDays()
                          ->where('habit_days.number' , $number)
                          ->firstOrFail();
        if ( $habit->isMine() ) {
            $habitDay->note = $request->note;
        }
        else {
            $habitDay->friend_note = $request->note;
        }
        $habitDay->save();

        return response()->json(null , 204);
    }

    /**
     * @OA\Get(
     *     path="/api/habit-days/exercises/{habit_id}/{number}",
     *     summary="نمایش تمرینا های یک روز از یک عادت",
     *     tags={"Habit-Days"},
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره روز",
     *         in="path",
     *         name="number",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *
     *     @OA\Response(response=200, description="Successful",@OA\JsonContent()),
     *     @OA\Response(response=204, description="Successful"),
     *     @OA\Response(response=400, description="Badrequest"),
     *     @OA\Response(response=404, description="NotFound"),
     *     @OA\Response(response=401, description="Unauthenticated",@OA\JsonContent()),
     *     security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */
    public function exercises ( Request $request , $habit_id , $number ) {
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habit_id)
                      ->firstOrFail();
        $exercise_questions = ExerciseQuestion::query()
                                              ->with([
                                                         'day' ,
                                                         'exerciseAnswer' => function ( $query ) use ( $habit ) {
                                                             $query->where('habit_id' , $habit->id);
                                                         } ,
                                                     ])
                                              ->where('day_id' , $number)
                                              ->orderBy('sort')
                                              ->get();

        return response()->json([
                                    'exercise_questions' => ExerciseQuestionResource::collection($exercise_questions) ,
                                ]);
    }

    /**
     * @OA\POST(
     *     path="/api/habit-days/update-exercise-answer/{habit_id}/{exercise_question_id}",
     *     summary="آپدیت جواب یک تمرین",
     *     tags={"Habit-Days"},
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره تمرین",
     *         in="path",
     *         name="exercise_question_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateHabitDayExerciseRequestBody")
     *     ),
     *     @OA\Response(response=200, description="Successful",@OA\JsonContent()),
     *     @OA\Response(response=204, description="Successful"),
     *     @OA\Response(response=400, description="Badrequest"),
     *     @OA\Response(response=404, description="NotFound"),
     *     @OA\Response(response=401, description="Unauthenticated",@OA\JsonContent()),
     *     security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */
    public function updateExerciseAnswer ( Request $request , $habit_id , $exercise_question_id ) {
        $request->validate([
                               'answer' => [ 'nullable' ] ,
                           ]);
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $habit_id)
                      ->firstOrFail();
        $exercise_question = ExerciseQuestion::query()
                                             ->findOrFail($exercise_question_id);
        $exercise_answer = ExerciseAnswer::query()
                                         ->updateOrCreate([
                                                              'habit_id' => $habit_id ,
                                                              'day_id' => $exercise_question->day_id ,
                                                              'exercise_question_id' => $exercise_question->id ,
                                                          ] , [
                                                              'answer' => json_encode($request->get('answer')) ,
                                                          ]);

        return response()->json(null , 204);
    }
}
