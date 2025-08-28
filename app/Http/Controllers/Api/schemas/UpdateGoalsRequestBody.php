<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateGoalsRequestBody schema model",
 *     title="UpdateGoalsRequestBody model",
 *     required={}
 * )
 */
class UpdateGoalsRequestBody
{
    /**
     * @OA\Property(
     *      type="array",
     *      @OA\Items(
     *          type="integer",
     *      ),
     *      description="goal_ids"
     * )
     *
     * @var object[]
     */
    private $goal_ids;
}
