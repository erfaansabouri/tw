<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\HabitChallenge */
class HabitChallengeResource extends JsonResource {
    public function toArray ( $request ) {
        return [
            'title' => $this->title ,
            'done' => (boolean)$this->done_at ,
        ];
    }
}
