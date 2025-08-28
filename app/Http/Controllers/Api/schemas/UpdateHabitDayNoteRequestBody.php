<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateHabitDayNoteRequestBody schema model",
 *     title="UpdateHabitDayNoteRequestBody model",
 *     required={}
 * )
 */
class UpdateHabitDayNoteRequestBody
{
    /**
     * @OA\Property(
     *     example="I feel very good!",
     *     format="string",
     *     description="",
     *     title="note",
     * )
     *
     * @var string
     */
    private $note;
}
