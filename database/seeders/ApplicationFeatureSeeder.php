<?php

namespace Database\Seeders;

use App\Models\ApplicationFeature;
use Illuminate\Database\Seeder;

class ApplicationFeatureSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'panel_title' => 'اسلاید اول',
                'description' => 'اینجا قراره عادت هایی رو بسازی که نگرانی و اضطراب رو ازت دور می‌کنن.',
                'image_url' => asset('application-assets/step-1.png'),
            ],
            [
                'panel_title' => 'اسلاید دوم',
                'description' => 'اینجا قدم به قدم مسیر ساختن عادت های جدید رو یاد می‌گیری.',
                'image_url' => asset('application-assets/step-2.png'),
            ],
            [
                'panel_title' => 'اسلاید سوم',
                'description' => 'عادت هایی که سرزنش رو با حس رضایت جایگزین می‌کنن.',
                'image_url' => asset('application-assets/step-3.png'),
            ],
        ];
        foreach ($items as $item) {
            $applicationFeature = ApplicationFeature::query()
                ->updateOrCreate(['panel_title' => $item['panel_title']], [
                    'description' => $item['description'],
                ]);

            $applicationFeature->addMediaFromUrl($item['image_url'])->toMediaCollection('image');
        }
    }
}
