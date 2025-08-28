<?php

namespace Database\Seeders;

use App\Models\Instruction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructionSeeder extends Seeder
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
                'type' => 'habit-page',
                'description' => 'قبل از این که شروع کنی یه مرور ساده از روند مراحل با هم داشته باشیم؛'
            ],
            [
                'type' => 'habit-page',
                'description' => 'قبل از خوندن درس هر روز لازمه عادت انتخابیت رو اجرا کنی،'
            ],
            [
                'type' => 'habit-page',
                'description' => 'بعد از اجرای عادت درس هایی که اینجا برای شما تدارک دیدیم رو مطالعه می‌کنی'
            ],
            [
                'type' => 'habit-page',
                'description' => 'و بعد وقتشه که تکالیف اون روز رو هم انجام بدی.'
            ],
        ];
        foreach ($items as $item) {
            Instruction::query()
                ->create([
                    'type' => $item['type'],
                    'description' => $item['description'],
                ]);
        }
    }
}
