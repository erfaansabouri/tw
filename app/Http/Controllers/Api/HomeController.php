<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HabitResource;
use App\Http\Resources\HabitWeekResource;
use App\Http\Resources\WaitingTextResource;
use App\Models\Day;
use App\Models\Habit;
use App\Models\PushNotification;
use App\Models\User;
use App\Models\WaitingText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
     * @OA\Get(
     *      path="/api/home",
     *      tags={"Home"},
     *      summary="صفحه اصلی کاربر",
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
        PushNotification::query()
                        ->where([
                                    'type' => PushNotification::TYPES[ 'ONE_DAY_OFFLINE' ] ,
                                    'user_id' => $user->id ,
                                ])
                        ->delete();
        $habits = Habit::query()
                       ->with([
                                  'currentWeek.currentDay.day' ,
                              ])
                       ->where('user_id' , $user->id)
                       ->where('is_dual' , false)
                       ->get();
        $randomHabit = Habit::query()
                            ->with([
                                       'currentWeek.currentDay.day' ,
                                   ])
                            ->where('is_dual' , false)
                            ->whereHas('currentWeek')
                            ->where('user_id' , $user->id)
                            ->inRandomOrder()
                            ->first();
        $currentWeekOfRandomHabit = Habit::query()
                                         ->with([
                                                    'currentWeek.currentDay.day' ,
                                                ])
                                         ->whereHas('currentWeek')
                                         ->where('is_dual' , false)
                                         ->where('user_id' , $user->id)
                                         ->inRandomOrder()
                                         ->first();
        $allWeeksOfRandomHabit = Habit::query()
                                      ->with([
                                                 'habitWeeks' ,
                                             ])
                                      ->where('user_id' , $user->id)
                                      ->where('is_dual' , false)
                                      ->inRandomOrder()
                                      ->first();
        $user->was_online_at = now();
        $user->save();

        return response()->json([
                                    'habits' => HabitResource::collection($habits) ,
                                    'random_habit' => $randomHabit ? HabitResource::make($randomHabit) : null ,
                                    'current_week_of_random_habit' => $currentWeekOfRandomHabit && $currentWeekOfRandomHabit->currentWeek ? [
                                        'week' => HabitWeekResource::make($currentWeekOfRandomHabit->currentWeek) ,
                                        'habit' => HabitResource::make($currentWeekOfRandomHabit) ,
                                    ] : null ,
                                    'all_weeks_of_random_habit' => $allWeeksOfRandomHabit ? [
                                        'weeks' => HabitWeekResource::collection($allWeeksOfRandomHabit->habitWeeks) ,
                                        'habit' => HabitResource::make($allWeeksOfRandomHabit) ,
                                    ] : null ,
                                ]);
    }

    /**
     * @OA\Get(
     *      path="/api/waiting-texts",
     *      tags={"Waiting-Texts"},
     *      summary="Waiting Texts",
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
    public function waitingTexts () {
        $waiting_texts = WaitingText::all();
        $waiting_texts = WaitingTextResource::collection($waiting_texts);

        return response()->json([
                                    'waiting_texts' => $waiting_texts ,
                                ]);
    }

    // swagger

    /**
     * @OA\Get(
     *      path="/api/days-success-text",
     *      tags={"Days-Success-Text"},
     *      summary="Days Success Text",
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
    public function daysSuccessText () {
        $days = Day::all();
        $success_text = $days->map(function ( $day ) {
            return [
                'number' => $day->number ,
                'success_text' => $day->success_text ,
            ];
        });

        return response()->json([
                                    'success_texts' => $success_text ,
                                ]);
    }
}
