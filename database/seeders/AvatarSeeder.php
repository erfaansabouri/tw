<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'panel_title' => 'آواتار اول',
                'image_url' => asset('application-assets/avatars/1.png'),
            ],
            [
                'panel_title' => 'آواتار دوم',
                'image_url' => asset('application-assets/avatars/2.png'),
            ],
            [
                'panel_title' => 'آواتار سوم',
                'image_url' => asset('application-assets/avatars/3.png'),
            ],
            [
                'panel_title' => 'آواتار چهارم',
                'image_url' => asset('application-assets/avatars/4.png'),
            ],
            [
                'panel_title' => 'آواتار پنجم',
                'image_url' => asset('application-assets/avatars/5.png'),
            ],
            [
                'panel_title' => 'آواتار ششم',
                'image_url' => asset('application-assets/avatars/6.png'),
            ],
        ];

        foreach ($items as $item) {
            $avatar = Avatar::query()
                ->updateOrCreate(['panel_title' => $item['panel_title']]);

            $avatar->addMediaFromUrl($item['image_url'])->toMediaCollection('image');
        }
    }
}
