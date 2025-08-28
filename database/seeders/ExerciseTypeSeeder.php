<?php

namespace Database\Seeders;

use App\Models\ExerciseType;
use Illuminate\Database\Seeder;

class ExerciseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ExerciseType::NAMES as $key => $name){
            ExerciseType::query()->firstOrCreate([
                'name' => $name
            ]);
        }
    }
}
