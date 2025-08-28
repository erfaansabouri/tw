<?php

namespace App\Models;


class Exercise extends Model
{
    public function decodedData(){
        return json_decode($this->question);
    }

    public function exerciseType()
    {
        return $this->belongsTo(ExerciseType::class);
    }

    public function getPreviewAttribute(){
        switch ($this->exerciseType->name){
            case ExerciseType::NAMES['ordered-list']:
                return json_decode($this->question)->title;
            case ExerciseType::NAMES['textarea']:
                return json_decode($this->question)->title;
            case ExerciseType::NAMES['checkbox-list']:
                return json_decode($this->question)[0]->li;
            case ExerciseType::NAMES['fill-in-the-blank']:
                return json_decode($this->question)->phrase;
        }
        return 'نا مشخص';
    }
}
