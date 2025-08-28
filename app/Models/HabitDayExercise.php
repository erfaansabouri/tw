<?php

namespace App\Models;


class HabitDayExercise extends Model
{
    public function habitDay(){
        return $this->belongsTo(HabitDay::class);
    }

    public function dayExercise(){
        return $this->belongsTo(DayExercise::class);
    }
}
