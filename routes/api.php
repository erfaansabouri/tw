<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\HabitController;
use App\Http\Controllers\Api\HabitDayController;
use App\Http\Controllers\Api\HabitDayExerciseController;
use App\Http\Controllers\Api\HabitWeekController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MyProfileController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\SplashController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('splash', [SplashController::class, 'index']);
Route::post('get-sms', [AuthController::class, 'getSms']);
Route::post('verify-code', [AuthController::class, 'verifyCode']);
Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::prefix('my-profile')->group(function () {
        Route::get('', [MyProfileController::class, 'show']);
        Route::post('update', [MyProfileController::class, 'update']);
        Route::post('update-goals', [MyProfileController::class, 'updateGoals']);
        Route::get('show-note', [MyProfileController::class, 'showNote']);
        Route::post('update-note', [MyProfileController::class, 'updateNote']);
        Route::post('update-firebase-token', [MyProfileController::class, 'updateFirebaseToken']);
        Route::get('get-firebase-token', [MyProfileController::class, 'getFirebaseToken']);
    });
    Route::prefix('plans')->group(function () {
        Route::get('', [PlanController::class, 'index']);
        Route::get('demo', [PlanController::class, 'demoIndex']);
        Route::post('active-demo/{demo_plan_id}', [PlanController::class, 'activeDemo']);
    });
    Route::prefix('transactions')->group(function () {
        Route::post('generate-link', [TransactionController::class, 'generateLink']);
    });
    Route::prefix('habits')->group(function () {
        Route::get('complete/{id}', [HabitController::class, 'complete']);
        Route::get('show/{id}', [HabitController::class, 'show']);
        Route::delete('destroy/{id}', [HabitController::class, 'destroy']);
        Route::post('store', [HabitController::class, 'store']);
        Route::post('update/{id}', [HabitController::class, 'update']);
        Route::get('calendar/{id}', [HabitController::class, 'calendar']);
        Route::post('update-custom-challenge-title/{id}', [HabitController::class, 'updateCustomChallengeTitle']);
        Route::post('toggle-custom-challenge/{id}', [HabitController::class, 'toggleCustomChallenge']);
        Route::get('challenges/{id}', [HabitController::class, 'getChallenges']);
        Route::post('update-notification-time/{id}', [HabitController::class, 'updateNotificationTime']);

        Route::prefix('v2')->group(function (){
            Route::post('store', [HabitController::class, 'storeV2']);
            Route::post('update/{id}', [HabitController::class, 'updateV2']);
        });

        Route::get('get-popup-groups/{id}', [HabitController::class, 'getPopupGroups']);
        Route::post('submit-answer-popup-question/{habit_id}/{question_id}', [HabitController::class, 'submitAnswerPopupQuestion']);

    });

    Route::prefix('habit-weeks')->group(function () {
        Route::post('update-note/{habit_id}/{number}', [HabitWeekController::class, 'updateNote']);
    });

    Route::prefix('habit-days')->group(function () {
        Route::get('show/{habit_id}/{number}', [HabitDayController::class, 'show']);
        Route::post('update-followup-value/{habit_id}/{number}', [HabitDayController::class, 'updateFollowupValue']);
        Route::post('update-satisfaction-percentage/{habit_id}/{number}', [HabitDayController::class, 'updateSatisfactionPercentage']);
        Route::post('update-satisfaction-emoji/{habit_id}/{number}', [HabitDayController::class, 'updateSatisfactionEmoji']);
        Route::post('update-note/{habit_id}/{number}', [HabitDayController::class, 'updateNote']);
        Route::get('exercises/{habit_id}/{number}', [HabitDayController::class, 'exercises']);
        Route::post('update-exercise-answer/{habit_id}/{number}', [HabitDayController::class, 'updateExerciseAnswer']);
    });
    Route::prefix('habit-day-exercises')->group(function () {
        Route::post('update/{id}', [HabitDayExerciseController::class, 'update']);
    });
    Route::prefix('home')->group(function () {
        Route::get('', [HomeController::class, 'show']);
    });
    Route::prefix('waiting-texts')->group(function () {
        Route::get('', [HomeController::class, 'waitingTexts']);
    });
    Route::prefix('days-success-text')->group(function () {
        Route::get('', [HomeController::class, 'daysSuccessText']);
    });
    Route::prefix('social')->group(function () {
        Route::get('show-friend', [FriendController::class, 'showFriend']);
        Route::post('add-friend', [FriendController::class, 'addFriend']);
        Route::post('remove-friend', [FriendController::class, 'removeFriend']);
        Route::get('show-friend-request', [FriendController::class, 'showFriendRequest']);
        Route::post('accept-friend-request', [FriendController::class, 'acceptFriendRequest']);
        Route::post('decline-friend-request', [FriendController::class, 'declineFriendRequest']);
    });
});
