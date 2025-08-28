<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateFollowUpValueRequestBody schema model",
 *     title="UpdateFollowUpValueRequestBody model",
 *     required={}
 * )
 */
class UpdateFollowUpValueRequestBody
{
    /**
     * @OA\Property(
     *     example="30",
     *     format="integer",
     *     description="",
     *     title="followup_value",
     * )
     *
     * @var integer
     */
    private $followup_value;
}
