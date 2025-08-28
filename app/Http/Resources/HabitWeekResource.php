<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HabitWeekResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            'number_title' => "هفته {$this->number}", // todo
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'note' => $this->note,
            'current_day' => $this->currentDay ? HabitDayResource::make($this->currentDay) : null,
            'week_days' => HabitDayResource::collection($this->habitDays)
        ];
    }
}
