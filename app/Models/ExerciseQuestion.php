<?php

namespace App\Models;
class ExerciseQuestion extends Model {
    // this model used for v2
    const TYPES = [
        'SIMPLE_DESCRIPTION' => 'SIMPLE_DESCRIPTION' ,
        'ORDERED_LIST' => 'ORDERED_LIST' ,
        'PERCENTAGE' => 'PERCENTAGE' ,
        'NOTE' => 'NOTE' ,
        'FILL_IN_THE_BLANK' => 'FILL_IN_THE_BLANK' ,
        'CHECKBOX' => 'CHECKBOX',
    ];

    protected $casts = [
        'question' => 'array' ,
    ];

    public function getTranslatedTypeAttribute () {
        return __(self::TYPES[$this->type]);
    }

    protected static function booted () {
        static::deleted(function ( ExerciseQuestion $exerciseQuestion ) {
            ExerciseAnswer::query()
                          ->where('exercise_question_id' , $exerciseQuestion->id)
                          ->delete();
        });
        static::saved(function ( ExerciseQuestion $exerciseQuestion ) {
            ExerciseAnswer::query()
                          ->where('exercise_question_id' , $exerciseQuestion->id)
                          ->delete();
        });
    }

    public function day () {
        return $this->belongsTo(Day::class);
    }

    public function exerciseAnswer () {
        return $this->hasOne(ExerciseAnswer::class);
    }
}
