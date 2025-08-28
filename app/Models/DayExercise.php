<?php

namespace App\Models;


class DayExercise extends Model
{
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
