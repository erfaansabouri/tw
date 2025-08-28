<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitWeekController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/habit-weeks/update-note/{habit_id}/{number}",
     *      tags={"Habit-Weeks"},
     *      summary="آپدیت یادداشت یک هتفته از یک عادت",
     *      description="",
     *     	 @OA\Parameter(
     *         description="آیدی عادت",
     *         in="path",
     *         name="habit_id",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     	 @OA\Parameter(
     *         description="شماره هفته",
     *         in="path",
     *         name="number",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateHabitDayNoteRequestBody")
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
    public function updateNote(Request $request, $habit_id, $number)
    {
        $request->validate([
            'note' => ['required'],
        ]);
        $habit = Habit::query()
            ->mineOrMyFriend()
            ->where('id', $habit_id)
            ->firstOrFail();
        $habitWeek = $habit->habitWeeks()
            ->where('habit_weeks.number', $number)
            ->firstOrFail();
        $habitWeek->note = $request->note;
        $habitWeek->save();
        return response()->json(null, 204);
    }
}
