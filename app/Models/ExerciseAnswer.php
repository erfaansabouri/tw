<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseAnswer extends Model
{
    public function day(): BelongsTo {
        return $this->belongsTo(Day::class);
    }

    public function habit(): BelongsTo {
        return $this->belongsTo(Habit::class);
    }

    public function exerciseQuestion(): BelongsTo {
        return $this->belongsTo(ExerciseQuestion::class);
    }
}
