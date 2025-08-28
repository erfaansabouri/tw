<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="UpdateMyProfileRequestBody schema model",
 *     title="UpdateMyProfileRequestBody model",
 *     required={}
 * )
 */
class UpdateMyProfileRequestBody
{
    /**
     * @OA\Property(
     *     example="Javad",
     *     format="string",
     *     description="",
     *     title="name",
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     example="1",
     *     format="integer",
     *     description="",
     *     title="avatar_id",
     * )
     *
     * @var int
     */
    private $avatar_id;
}
