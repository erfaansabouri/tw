<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateWeekNoteRequestBody schema model",
 *     title="UpdateWeekNoteRequestBody model",
 *     required={}
 * )
 */
class UpdateWeekNoteRequestBody
{
    /**
     * @OA\Property(
     *     example="1",
     *     format="integer",
     *     description="",
     *     title="week_id",
     * )
     *
     * @var string
     */
    private $week_id;

    /**
     * @OA\Property(
     *     example="This week has too many holidays.",
     *     format="string",
     *     description="",
     *     title="note",
     * )
     *
     * @var string
     */
    private $note;
}
