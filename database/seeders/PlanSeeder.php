<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
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
                'monthly_price' => 79000,
                'total_price' => 79000 * 3,
                'title' => 'اشتراک استارتر',
                'subtitle_1' => 'چهار عادت همزمان',
                'subtitle_2' => 'سه ماهه',
                'title_under_price' => 'ماهیانه',
                'days' => 90,
                'is_unlimited' => false,
            ],
            [
                'monthly_price' => 59000,
                'total_price' => 59000 * 6,
                'title' => 'اشتراک پرو',
                'subtitle_1' => 'هشت عادت همزمان',
                'subtitle_2' => 'شش ماهه',
                'title_under_price' => 'ماهیانه',
                'days' => 180,
                'is_unlimited' => false,
            ],
            [
                'monthly_price' => null,
                'total_price' => 490000,
                'title' => 'اشتراک ایمورتال',
                'subtitle_1' => 'بی نهایت عادت همزمان',
                'subtitle_2' => 'مادام العمر',
                'title_under_price' => 'مجموعا',
                'days' => null,
                'is_unlimited' => true,
            ],
        ];

        foreach ($items as $item){
            Plan::updateOrCreate(['title' => $item['title']],[
                'monthly_price' => $item['monthly_price'],
                'total_price' => $item['total_price'],
                'title' => $item['title'],
                'subtitle_1' => $item['subtitle_1'],
                'subtitle_2' => $item['subtitle_2'],
                'title_under_price' => $item['title_under_price'],
                'days' => $item['days'],
                'is_unlimited' => $item['is_unlimited'],
            ]);
        }
    }
}
