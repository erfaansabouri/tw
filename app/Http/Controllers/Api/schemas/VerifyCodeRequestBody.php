<?php

namespace App\Http\Controllers\Api\schemas;

/**
 * @OA\Schema(
 *     description="VerifyCodeRequestBody schema model",
 *     title="VerifyCodeRequestBody model",
 *     required={}
 * )
 */
class VerifyCodeRequestBody
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

    /**
     * @OA\Property(
     *     example="1234",
     *     format="string",
     *     description="",
     *     title="code",
     * )
     *
     * @var string
     */
    private $code;
}
