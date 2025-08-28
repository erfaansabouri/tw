<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateSatisfactionPercentageRequestBody schema model",
 *     title="UpdateSatisfactionPercentageRequestBody model",
 *     required={}
 * )
 */
class UpdateSatisfactionPercentageRequestBody
{
    /**
     * @OA\Property(
     *     example="80",
     *     format="integer",
     *     description="",
     *     title="satisfaction_percentage",
     * )
     *
     * @var integer
     */
    private $satisfaction_percentage;
}
