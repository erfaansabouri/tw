<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\ExerciseAnswer */
class ExerciseAnswerResource extends JsonResource {
    public function toArray ( $request ) {
        return [
            'id' => $this->id ,
            'answer' => json_decode($this->answer),
        ];
    }
}
