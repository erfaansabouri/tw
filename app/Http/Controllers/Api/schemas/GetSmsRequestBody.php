<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="GetSmsRequestBody schema model",
 *     title="GetSmsRequestBody model",
 *     required={}
 * )
 */
class GetSmsRequestBody
{
    /**
     * @OA\Property(
     *     example="09371234567",
     *     format="string",
     *     description="",
     *     title="phone",
     * )
     *
     * @var string
     */
    private $phone;
}
