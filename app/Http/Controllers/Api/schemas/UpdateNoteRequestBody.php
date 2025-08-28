<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateNoteRequestBody schema model",
 *     title="UpdateNoteRequestBody model",
 *     required={}
 * )
 */
class UpdateNoteRequestBody
{
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
