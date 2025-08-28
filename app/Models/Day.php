<?php

namespace App\Models;
class Day extends Model
{
    protected $with = ['lessons'];
    public function lessons()
    {
        return $this->hasMany(DayLesson::class);
    }

    public function exerciseQuestions(){
        return $this->hasMany(ExerciseQuestion::class);
    }
}
