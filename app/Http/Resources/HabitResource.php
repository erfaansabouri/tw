<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/* @mixin \App\Models\Habit */
class HabitResource extends JsonResource {
    public function toArray ( $request ) {
        return [
            'id' => $this->id ,
            'title' => $this->title ,
            'image_url' => "" ,
            // todo
            'followup_type' => $this->followup_type ,
            'followup_value' => $this->followup_value ,
            'current_week' => $this->currentWeek ? HabitWeekResource::make($this->currentWeek) : null ,
            'is_completed' => $this->is_completed ,
            'best_strike_count' => $this->best_strike_count ,
            'done_days_count' => $this->done_days_count ,
            'time_text' => $this->time_text ,
            'location_text' => $this->location_text ,
            'habit_text' => $this->habit_text ,
            'character_text' => $this->character_text ,
            'is_dual' => $this->is_dual ,
            'is_mine' => $this->user_id == Auth::user()->id ,
            'notification_time' => $this->getColumnValueMineOrMyFriend('notification_time') ,
            'current_day' => HabitDayResource::make($this->currentHabitDay())
            ];
    }
}
