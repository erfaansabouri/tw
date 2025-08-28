<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HabitDayChartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            //'title' => $this->day->title,
            'date' => verta(Carbon::parse($this->date))->format('%B %d'),
            'satisfaction_percentage' => $this->satisfaction_percentage,
            'satisfaction_emoji' => $this->satisfaction_emoji,
            'followup_value' => $this->followup_value,
        ];
    }
}
