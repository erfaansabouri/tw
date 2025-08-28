<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\ExerciseQuestion */
class ExerciseQuestionResource extends JsonResource {
    public function toArray ( $request ) {
        return [
            'id' => $this->id ,
            'sort' => $this->sort ,
            'type' => $this->type ,
            'day_number' => $this->day->number ,
            'question' => $this->question ,
            'answer' => $this->exerciseAnswer ? json_decode($this->exerciseAnswer->answer) : null ,
        ];
    }
}
