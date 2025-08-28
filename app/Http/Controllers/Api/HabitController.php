<?php

namespace App\Http\Controllers\Api;

use App\Builder\CalendarBuilder;
use App\Builder\SmartChartBuilder;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\HabitChallengeResource;
use App\Http\Resources\HabitDayChartResource;
use App\Http\Resources\HabitDayResource;
use App\Http\Resources\HabitResource;
use App\Http\Resources\HabitWeekResource;
use App\Models\Habit;
use App\Models\HabitChallenge;
use App\Models\HabitDay;
use App\Models\HabitWeek;
use App\Models\PopupAnswer;
use App\Models\PopupGroup;
use App\Models\PopupQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class HabitController extends Controller {
    /**
     * @OA\Get(
     *     path="/api/habits/complete/{id}",
     *     summary="complete habit",
     *     tags={"Habits"},
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="id",
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
    public function complete ( Request $request , $id ) {
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $id)
                      ->firstOrFail();
        if ( $habit->isMine() ) {
            $habit->completed_at = now();
        }
        else {
            $habit->friend_completed_at = now();
        }
        $habit->save();

        return response()->json([
                                    'message' => "عادت تکمیل شد." ,
                                ]);
    }

    /**
     * @OA\Get(
     *     path="/api/habits/show/{id}",
     *     summary="نمایش عادت",
     *     tags={"Habits"},
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
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
    public function show ( Request $request , $id ) {
        $habit = Habit::query()
                      ->with([
                                 'habitDays' ,
                                 'currentWeek.currentDay.day' ,
                             ])
                      ->mineOrMyFriend()
                      ->where('id' , $id)
                      ->firstOrFail();
        $user = Auth::user();
        $user->was_online_at = now();
        $user->save();

        return response()->json([
                                    'habit' => HabitResource::make($habit) ,
                                    'days' => HabitDayResource::collection($habit->habitDays) ,
                                    'chart' => $habit && $habit->currentWeek ? HabitDayChartResource::collection($habit->currentWeek->habitDays) : null ,
                                    'current_week' => $habit && $habit->currentWeek ? HabitWeekResource::make($habit->currentWeek) : null ,
                                    'all_time_chart' => HabitDayChartResource::collection($habit->habitDays) ,
                                    'all_weeks' => HabitWeekResource::collection($habit->habitWeeks) ,
                                    'smart_chart' => ( new SmartChartBuilder() )->setHabit($habit)
                                                                                ->render() ,
                                ]);
    }

    /**
     * @OA\Get(
     *     path="/api/habits/calendar/{id}",
     *     summary="نمایش تقویم",
     *     tags={"Habits"},
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="id",
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
    public function calendar ( Request $request , $id ) {
        $habit = Habit::query()
                      ->mineOrMyFriend()
                      ->where('id' , $id)
                      ->firstOrFail();
        $dates = CalendarBuilder::make($habit)
                                ->getDates();

        return response()->json([
                                    'days' => $dates ,
                                ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/habits/destroy/{id}",
     *     summary="حذف عادت",
     *     tags={"Habits"},
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
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
    public function destroy ( $id ) {
        $habit = Habit::query()
                      ->where('user_id' , Auth::user()->id)
                      ->where('id' , $id)
                      ->firstOrFail();
        $habit->delete();

        return response()->json([
                                    'message' => "عادت با موفقیت حذف شد." ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/store",
     *      tags={"Habits"},
     *      summary="تعریف عادت جدید",
     *      description="followup_type: repeat | time",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreHabitRequestBody")
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
    public function store ( Request $request ) {
        $request->validate([
                               'title' => [ 'required' ] ,
                               'followup_type' => [
                                   'required' ,
                                   'in:' . Helper::implodedElements(Habit::FOLLOWUP_TYPES) ,
                               ] ,
                               'followup_value' => [
                                   'required' ,
                                   'numeric' ,
                               ] ,
                           ]);
        $user = Auth::user();
        if ( $user->activeHabitsCount() >= $user->maxAllowedHabitsCount() ) {
            return response()->json([
                                        'status' => false ,
                                        'message' => "تعداد عادت مجاز همزمان شما به سقف رسیده است." ,
                                    ]);
        }
        Habit::query()
             ->create([
                          'user_id' => Auth::user()->id ,
                          'title' => $request->title ,
                          'followup_type' => $request->followup_type ,
                          'followup_value' => $request->followup_value ,
                          'notification_time' => $request->notification_time ,
                      ]);

        return response()->json([
                                    'status' => true ,
                                    'message' => "تبریک می‌گیم… این که می‌خوای شروع کنی یه عادت جدید رو به زندگیت اضافه کنی یه قدم خیلی بزرگه و فقط کافیه تصور کنی در صورت همیشگی شدن این عادت چه چیزایی رو می‌تونی تجربه کنی." ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/v2/store",
     *      tags={"Habits"},
     *      summary="تعریف عادت جدید",
     *      @OA\Parameter(
     *          description="time_text",
     *          in="query",
     *          name="time_text",
     *          required=true,
     *          @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter(
     *           description="location_text",
     *           in="query",
     *           name="location_text",
     *           required=true,
     *           @OA\Schema(type="string"),
     *       ),
     *           @OA\Parameter(
     *            description="habit_text",
     *            in="query",
     *            name="habit_text",
     *            required=true,
     *            @OA\Schema(type="string"),
     *        ),
     *        @OA\Parameter(
     *             description="character_text",
     *             in="query",
     *             name="character_text",
     *             required=true,
     *             @OA\Schema(type="string"),
     *         ),
     *        @OA\Parameter(
     *              description="is_dual",
     *              in="query",
     *              name="is_dual",
     *              required=true,
     *              @OA\Schema(type="integer"),
     *          ),
     *       @OA\Parameter(
     *               description="notification_time",
     *               in="query",
     *               name="notification_time",
     *               required=true,
     *               @OA\Schema(type="string"),
     *           ),
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
    public function storeV2 ( Request $request ) {
        $request->validate([
                               'time_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'location_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'habit_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'character_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'is_dual' => [
                                   'required' ,
                                   'boolean' ,
                               ] ,
                               'notification_time' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                           ]);
        $user = Auth::user();
        //if ( $user->activeHabitsCount() >= $user->maxAllowedHabitsCount() ) {
        //    return response()->json([
        //                                'status' => false ,
        //                                'message' => "تعداد عادت مجاز همزمان شما به سقف رسیده است." ,
        //                            ]);
        //}
        Habit::query()
             ->create([
                          'user_id' => Auth::user()->id ,
                          'time_text' => $request->time_text ,
                          'location_text' => $request->location_text ,
                          'habit_text' => $request->habit_text ,
                          'title' => $request->habit_text ,
                          'character_text' => $request->character_text ,
                          'is_dual' => $request->is_dual ,
                          'notification_time' => $request->notification_time ,
                      ]);

        return response()->json([
                                    'status' => true ,
                                    'message' => "تبریک می‌گیم… این که می‌خوای شروع کنی یه عادت جدید رو به زندگیت اضافه کنی یه قدم خیلی بزرگه و فقط کافیه تصور کنی در صورت همیشگی شدن این عادت چه چیزایی رو می‌تونی تجربه کنی." ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/v2/update/{id}",
     *      tags={"Habits"},
     *      summary="بروز رسانی عدت",
     *      @OA\Parameter(
     *           description="id",
     *           in="path",
     *           name="id",
     *           required=true,
     *           @OA\Schema(type="string"),
     *       ),
     *      @OA\Parameter(
     *          description="time_text",
     *          in="query",
     *          name="time_text",
     *          required=true,
     *          @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter(
     *           description="location_text",
     *           in="query",
     *           name="location_text",
     *           required=true,
     *           @OA\Schema(type="string"),
     *       ),
     *           @OA\Parameter(
     *            description="habit_text",
     *            in="query",
     *            name="habit_text",
     *            required=true,
     *            @OA\Schema(type="string"),
     *        ),
     *        @OA\Parameter(
     *             description="character_text",
     *             in="query",
     *             name="character_text",
     *             required=true,
     *             @OA\Schema(type="string"),
     *         ),
     *        @OA\Parameter(
     *              description="is_dual",
     *              in="query",
     *              name="is_dual",
     *              required=true,
     *              @OA\Schema(type="integer"),
     *          ),
     *       @OA\Parameter(
     *               description="notification_time",
     *               in="query",
     *               name="notification_time",
     *               required=true,
     *               @OA\Schema(type="string"),
     *           ),
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
    public function updateV2 ( Request $request , $id ) {
        $request->validate([
                               'time_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'location_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'habit_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'character_text' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                               'is_dual' => [
                                   'required' ,
                                   'boolean' ,
                               ] ,
                               'notification_time' => [
                                   'required' ,
                                   'string' ,
                               ] ,
                           ]);
        $habit = Habit::query()
                      ->where('id' , $id)
                      ->where('user_id' , Auth::user()->id)
                      ->firstOrFail();
        $habit->update([
                           'time_text' => $request->time_text ,
                           'location_text' => $request->location_text ,
                           'habit_text' => $request->habit_text ,
                           'title' => $request->habit_text ,
                           'character_text' => $request->character_text ,
                           'is_dual' => $request->is_dual ,
                           'notification_time' => $request->notification_time ,
                       ]);

        return response()->json([
                                    'status' => true ,
                                    'message' => "تبریک می‌گیم… این که می‌خوای شروع کنی یه عادت جدید رو به زندگیت اضافه کنی یه قدم خیلی بزرگه و فقط کافیه تصور کنی در صورت همیشگی شدن این عادت چه چیزایی رو می‌تونی تجربه کنی." ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/update/{id}",
     *      tags={"Habits"},
     *      summary="آپدیت عادت",
     *      description="followup_type: repeat | time",
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreHabitRequestBody")
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
    public function update ( Request $request , $id ) {
        $request->validate([
                               'title' => [ 'required' ] ,
                               'followup_type' => [
                                   'required' ,
                                   'in:' . Helper::implodedElements(Habit::FOLLOWUP_TYPES) ,
                               ] ,
                               'followup_value' => [
                                   'required' ,
                                   'numeric' ,
                               ] ,
                           ]);
        $habit = Habit::query()
                      ->where('id' , $id)
                      ->where('user_id' , Auth::user()->id)
                      ->firstOrFail();
        $habit->title = $request->title;
        $habit->followup_type = $request->followup_type;
        $habit->followup_value = $request->followup_value;
        //$habit->notification_time = $request->notification_time;
        $habit->saveQuietly();

        return response()->json([
                                    'status' => true ,
                                    'message' => "عادت با موفقیت بروز رسانی شد." ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/update-custom-challenge-title/{id}",
     *      tags={"Habits"},
     *      summary="آپدیت چالش",
     *      description="",
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="عنوان چالش",
     *         in="query",
     *         name="title",
     *         required=false,
     *         @OA\Schema(type="string"),
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
    public function updateCustomChallengeTitle ( Request $request , $id ) {
        $request->validate([
                               'title' => [ 'required' ] ,
                           ]);
        $habit = Habit::query()
                      ->where('id' , $id)
                      ->mineOrMyFriend()
                      ->firstOrFail();
        $habitChallenge = HabitChallenge::query()
                                        ->firstOrCreate([
                                                            'habit_id' => $habit->id ,
                                                        ]);
        $habitChallenge->title = $request->get('title');
        $habitChallenge->save();

        return response()->json([
                                    'status' => true ,
                                    'message' => "چالش با موفقیت بروز رسانی شد." ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/toggle-custom-challenge/{id}",
     *      tags={"Habits"},
     *      summary="آپدیت چالش",
     *      description="",
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="status",
     *         in="query",
     *         name="status",
     *         required=false,
     *         @OA\Schema(type="boolean"),
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
    public function toggleCustomChallenge ( Request $request , $id ) {
        $habit = Habit::query()
                      ->where('id' , $id)
                      ->mineOrMyFriend()
                      ->firstOrFail();
        $habitChallenge = HabitChallenge::query()
                                        ->firstOrCreate([
                                                            'habit_id' => $habit->id ,
                                                        ]);
        $habitChallenge->done_at = $request->status == 'true' ? now() : null;
        $habitChallenge->save();

        return response()->json([
                                    'status' => true ,
                                    'message' => "چالش با موفقیت بروز رسانی شد." ,
                                ]);
    }

    /**
     * @OA\Get(
     *     path="/api/habits/challenges/{id}",
     *     summary="نمایش چالش های عادت",
     *     tags={"Habits"},
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
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
    public function getChallenges ( $id ) {
        $habit = Habit::query()
                      ->where('id' , $id)
                      ->mineOrMyFriend()
                      ->firstOrFail();
        $habitChallenge = HabitChallenge::query()
                                        ->firstOrCreate([
                                                            'habit_id' => $habit->id ,
                                                        ]);
        $static_challenges = collect([]);
        $static_challenges->add(new HabitChallenge([
                                                       'title' => 'تموم کردن ۲۱روز بدون وقفه' ,
                                                       'done_at' => $habit->best_strike_count == 21 ? now() : null ,
                                                   ]));
        $static_challenges->add(new HabitChallenge([
                                                       'title' => 'کامل کردن همه تکالیف ۲۱روز' ,
                                                       'done_at' => $habit->is_completed ? now() : null ,
                                                   ]));
        $static_challenges->add(new HabitChallenge([
                                                       'title' => 'پیروی از قانون دو روز' ,
                                                       'done_at' => $habit->hasMoreThan2DaysGap() ? null : now() ,
                                                   ]));
        $static_challenges->add($habitChallenge);

        return response()->json([
                                    'habit_challenges' => HabitChallengeResource::collection($static_challenges) ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/update-notification-time/{id}",
     *      tags={"Habits"},
     *      summary="آپدیت زمان ارسال نوتیفیکشن",
     *      description="",
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="notification_time",
     *         in="query",
     *         name="notification_time",
     *         required=false,
     *         example="12:00",
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
    public function updateNotificationTime ( Request $request , $id ) {
        $request->validate([
                               'notification_time' => [
                                   'nullable' ,
                                   'date_format:H:i' ,
                               ] ,
                           ]);
        $habit = Habit::query()
                      ->where('id' , $id)
                      ->mineOrMyFriend()
                      ->firstOrFail();
        if ($habit->isMine()){
            $habit->notification_time = $request->get('notification_time');
            $habit->notification_sent_at = null;
        }else{
            $habit->friend_notification_time = $request->get('notification_time');
            $habit->friend_notification_sent_at = null;
        }

        $habit->save();

        return response()->json([
                                    'status' => true ,
                                    'message' => "چالش با موفقیت بروز رسانی شد." ,
                                ]);
    }

    /**
     * @OA\Get(
     *     path="/api/habits/get-popup-groups/{id}",
     *     summary="دریافت پاپ ها گروه بندی شده",
     *     tags={"Habits"},
     *     	 @OA\Parameter(
     *         description="ایدی",
     *         in="path",
     *         name="id",
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
    public function getPopupGroups ( $id ) {
        $habit = Habit::query()
                      ->where('id' , $id)
                      ->mineOrMyFriend()
                      ->firstOrFail();
        $popup_questions = PopupQuestion::query()
                                        ->orderBy('day_id')
                                        ->get([
                                                  'id' ,
                                                  'popup_group_id' ,
                                                  'day_id' ,
                                                  'type' ,
                                                  'question' ,
                                              ])
                                        ->groupBy('day_id')
                                        ->groupBy('popup_group_id')
                                        ->first();
        $popup_answer = PopupAnswer::query()
                                   ->where('habit_id' , $id)
                                   ->get();
        foreach ( $popup_questions as $day ) {
            foreach ( $day as $question ) {
                if ($habit->isMine()){
                    $question->answer = @json_decode($popup_answer->where('popup_question_id' , $question->id)
                                                                  ->first()?->answer);
                }else{
                    $question->answer = @json_decode($popup_answer->where('popup_question_id' , $question->id)
                                                                  ->first()?->friend_answer);
                }

            }
        }

        return response()->json([
                                    'popup_questions' => $popup_questions ,
                                ]);
    }

    /**
     * @OA\Post(
     *      path="/api/habits/submit-answer-popup-question/{habit_id}/{question_id}",
     *      tags={"Habits"},
     *      summary="ثبت جواب برای یک سوال",
     *      description="",
     *          	 @OA\Parameter(
     *          description="آیدی عادت",
     *          in="path",
     *          name="habit_id",
     *          required=false,
     *          @OA\Schema(type="integer"),
     *      ),
     *     	 @OA\Parameter(
     *         description="آیدی سوال",
     *         in="path",
     *         name="question_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="answer",
     *         in="query",
     *         name="answer",
     *         required=false,
     *         example="json befrest",
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
    public function submitAnswerPopupQuestion ( Request $request , $habit_id , $question_id ) {
        $habit = Habit::query()
                      ->where('id' , $habit_id)
                      ->mineOrMyFriend()
                      ->firstOrFail();
        $popup_answer = PopupAnswer::query()
                                   ->firstOrCreate([
                                                       'habit_id' => $habit_id ,
                                                       'popup_question_id' => $question_id ,
                                                   ]);
        if ( $habit->isMine() ) {
            $popup_answer->answer = json_encode($request->get('answer'));
        }
        else {
            $popup_answer->friend_answer = json_encode($request->get('answer'));
        }
        $popup_answer->save();

        return response()->json([
                                    'status' => true ,
                                    'message' => "با موفقیت ثبت شد" ,
                                ]);
    }
}
