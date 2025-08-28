<?php

namespace Database\Seeders;

use App\Models\PopupQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopupQuestion48Seeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        PopupQuestion::query()
                     ->where('id' , 48)
                     ->update([
                                  'question' => ( [
                                      '1' => 'شناسایی پادکست هایی که به پیشرفت عادت مورد نظر من کمک میکنن.' ,
                                      '2' => 'شناسایی گروه های نزدیک به من که به پیشرفت عادت مورد نظر من کمک میکنن.' ,
                                      '3' => 'شناسایی گروه هایی که مانع و خلاف رفتار مورد نظر من هستن.' ,
                                  ]  ) ,
                              ]);
    }
}
