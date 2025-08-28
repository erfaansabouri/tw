<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationFeatureResource;
use App\Http\Resources\AvatarResource;
use App\Http\Resources\GoalResource;
use App\Http\Resources\InstructionResource;
use App\Models\ApplicationFeature;
use App\Models\Avatar;
use App\Models\Goal;
use App\Models\Instruction;
use Illuminate\Http\Request;

class SplashController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/splash",
     *      tags={"Splash"},
     *      summary="ریکوست اسپلش شامل تمام مقادیر مورد نیاز استفاده شده در اپ هست",
     *
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     @OA\Response(response=204, description="Successful"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function index()
    {
        $applicationFeatures = ApplicationFeature::with('media')
            ->ordered()
            ->get();

        $avatars = Avatar::with('media')
            ->ordered()
            ->get();

        $goals = Goal::with('media')
            ->ordered()
            ->get();

        $habitPageInstructions = Instruction::query()
            ->ordered()
            ->where('type', 'habit-page')
            ->get();

        return response()->json([
            'application_features' => ApplicationFeatureResource::collection($applicationFeatures),
            'avatars' => AvatarResource::collection($avatars),
            'goals' => GoalResource::collection($goals),
            'habit_page_instructions' => InstructionResource::collection($habitPageInstructions),
        ]);
    }
}
