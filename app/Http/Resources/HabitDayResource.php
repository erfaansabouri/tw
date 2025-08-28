<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
/* @mixin \App\Models\HabitDay */
class HabitDayResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            'title' => $this->day->title,
            'phrase' => $this->day->phrase,
            'date' => $this->date,
            'note' => $this->note,
            'satisfaction_percentage' => $this->satisfaction_percentage,
            'satisfaction_emoji' => $this->satisfaction_emoji,
            'followup_value' => $this->followup_value,
            #
            'friend_note' => $this->friend_note,
            'friend_satisfaction_percentage' => $this->friend_satisfaction_percentage,
            'friend_satisfaction_emoji' => $this->friend_satisfaction_emoji,
            'friend_followup_value' => $this->friend_followup_value,
            #
            'lessons' => DayLessonResource::collection($this->myLessons()),
            'exercises' => $this->beautifyExercises(),
            'done' => (boolean)$this->done_at
        ];
    }
}
