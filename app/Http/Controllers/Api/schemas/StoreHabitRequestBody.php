<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="StoreHabitRequestBody schema model",
 *     title="StoreHabitRequestBody model",
 *     required={}
 * )
 */
class StoreHabitRequestBody
{
    /**
     * @OA\Property(
     *     example="ورزش کردن در پارک",
     *     format="string",
     *     description="",
     *     title="title",
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     example="time",
     *     format="string",
     *     description="repeat or time",
     *     title="followup_type",
     * )
     *
     * @var string
     */
    private $followup_type;

    /**
     * @OA\Property(
     *     example="30",
     *     format="integer",
     *     description="Enter a number",
     *     title="followup_value",
     * )
     *
     * @var string
     */
    private $followup_value;

    /**
     * @OA\Property(
     *     example="12:30",
     *     format="string",
     *     description="Enter a number",
     *     title="notification_time",
     * )
     *
     * @var string
     */
    private $notification_time;
}
