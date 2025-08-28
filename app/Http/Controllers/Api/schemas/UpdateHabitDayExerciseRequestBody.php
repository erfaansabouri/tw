<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateHabitDayExerciseRequestBody schema model",
 *     title="UpdateHabitDayExerciseRequestBody model",
 *     required={}
 * )
 */
class UpdateHabitDayExerciseRequestBody
{
    /**
     * @OA\Property(
     *     example="{""textarea"": ""هر آبجکتی خواستی با هر نوع فرمتی بفرستو اون طرف دیکد شده تحویل بگیر. فقط جیسون بفرس""}",
     *     format="object",
     *     description="",
     *     title="answer",
     * )
     *
     * @var object
     */
    private $answer;
}
