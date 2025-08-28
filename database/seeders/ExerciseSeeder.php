<?php

namespace Database\Seeders;

use App\Models\DayExercise;
use App\Models\Exercise;
use App\Models\ExerciseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder {
    public function run () {
        // DAY 1
        $exercise = Exercise::query()
                            ->create([
                                         'exercise_type_id' => ExerciseType::name(ExerciseType::NAMES[ 'ordered-list' ])
                                                                           ->first()->id ,
                                         'question' => json_encode([
                                                                       'title' => 'پیش نیاز های عادت جدیدم',
                                                                   ]) ,
                                     ]);
        DayExercise::query()
                   ->create([
                                'day_id' => 1 ,
                                'exercise_id' => $exercise->id ,
                                'sort' => 1,
                            ]);


        /////////////////
        $exercise = Exercise::query()
                            ->create([
                                         'exercise_type_id' => ExerciseType::name(ExerciseType::NAMES[ 'ordered-list' ])
                                                                           ->first()->id ,
                                         'question' => json_encode([
                                                                       'title' => 'شخصیت الگوی من این اخلاقیت رو داره',
                                                                   ]) ,
                                     ]);
        DayExercise::query()
                   ->create([
                                'day_id' => 1 ,
                                'exercise_id' => $exercise->id ,
                                'sort' => 1,
                            ]);

        /////////////////

        $exercise = Exercise::query()
                            ->create([
                                         'exercise_type_id' => ExerciseType::name(ExerciseType::NAMES[ 'ordered-list' ])
                                                                           ->first()->id ,
                                         'question' => json_encode([
                                                                       'title' => 'شخصیت الگوی من این اخلاقیت رو داره',
                                                                   ]) ,
                                     ]);
        DayExercise::query()
                   ->create([
                                'day_id' => 1 ,
                                'exercise_id' => $exercise->id ,
                                'sort' => 1,
                            ]);

        /////////////////
        $exercise = Exercise::query()
                            ->create([
                                         'exercise_type_id' => ExerciseType::name(ExerciseType::NAMES[ 'textarea' ])
                                                                           ->first()->id ,
                                         'question' => json_encode([
                                                                       'title' => 'شخصیت الگوی من این اخلاقیت رو داره',
                                                                   ]) ,
                                     ]);
        DayExercise::query()
                   ->create([
                                'day_id' => 2 ,
                                'exercise_id' => $exercise->id ,
                                'sort' => 2,
                            ]);
        $exercise = Exercise::query()
                            ->create([
                                         'exercise_type_id' => ExerciseType::name(ExerciseType::NAMES[ 'fill-in-the-blank' ])
                                                                           ->first()->id ,
                                         'question' => json_encode([
                                                                       'phrase' => 'من فقط وقتی [_] (عادت و رفتار مورد علاقه) که [_] (عادتی که سعی در ایجادش را دارید) رو انجام بدم.',
                                                                   ]) ,
                                     ]);
        DayExercise::query()
                   ->create([
                                'day_id' => 1 ,
                                'exercise_id' => $exercise->id ,
                                'sort' => 3,
                            ]);
        $exercise = Exercise::query()
                            ->create([
                                         'exercise_type_id' => ExerciseType::name(ExerciseType::NAMES[ 'checkbox-list' ])
                                                                           ->first()->id ,
                                         'question' => json_encode([
                                                                       [ 'li' => 'تهیه یک المان خاص' ] ,
                                                                       [ 'li' => 'چسبوندن استیکر یادآور' ],
                                                                   ]) ,
                                     ]);
        DayExercise::query()
                   ->create([
                                'day_id' => 1 ,
                                'exercise_id' => $exercise->id ,
                                'sort' => 4,
                            ]);
    }
}
