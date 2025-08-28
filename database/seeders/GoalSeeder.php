<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'small_title' => 'نظم',
                'full_title' => 'نظم شخصی',
                'image_url' => asset('application-assets/goals/g-1.png'),
            ],
            [
                'small_title' => 'استمرار',
                'full_title' => 'استمرار و ثبات',
                'image_url' => asset('application-assets/goals/g-2.png'),
            ],
            [
                'small_title' => 'ذهن',
                'full_title' => 'اهمیت به ذهن',
                'image_url' => asset('application-assets/goals/g-3.png'),
            ],
            [
                'small_title' => 'جسم',
                'full_title' => 'اهمیت به جسم',
                'image_url' => asset('application-assets/goals/g-4.png'),
            ],
            [
                'small_title' => 'انگیزه',
                'full_title' => 'با انگیزه بودن',
                'image_url' => asset('application-assets/goals/g-5.png'),
            ],
        ];

        foreach ($items as $item) {
            $goal = Goal::query()
                ->updateOrCreate(['small_title' => $item['small_title']], [
                    'full_title' => $item['full_title'],
                ]);

            $goal->addMediaFromUrl($item['image_url'])->toMediaCollection('image');
        }
    }
}
