<?php

namespace App\Builder;

use App\Models\Habit;
use App\Models\HabitDay;
use Carbon\Carbon;

class CalendarBuilder {
    public Habit $habit;
    public       $from_date;
    public       $end_date;
    public       $done_dates;
    public       $days_color;

    public static function make ( Habit $habit ) {
        $instance = ( new self() );
        $instance->habit = $habit;

        return $instance;
    }

    public function getDates(){
        $this->determinceFromDate()
            ->determineEndDate()
            ->determineDoneDates()
            ->determineDaysColor();

        return $this->days_color;
    }

    private function determinceFromDate () {
        $this->from_date = $this->habit->created_at->format('Y-m-d');

        return $this;
    }

    private function determineEndDate () {
        $this->end_date = Carbon::now()
                                ->format('Y-m-d');

        return $this;
    }

    private function determineDaysColor () {
        $current_date = Carbon::parse($this->from_date);
        while ( $current_date->lte(Carbon::parse($this->end_date)) ) {
            $habit_day = $this->habit->habitDays()->whereDate('done_at', $current_date)->first();
            $color = ( in_array($current_date->format('Y-m-d') , $this->done_dates) ) ? '#F0CA45' : '#CCCCCC';
            $this->days_color[] = [
                'date' => $current_date->format('Y-m-d') ,
                'color' => $color,
                'satisfaction_emoji' => $habit_day ? $habit_day->satisfaction_emoji : null,
                'friend_satisfaction_emoji' => $habit_day ? $habit_day->friend_satisfaction_emoji : null,
            ];
            $current_date->addDay();
        }
    }

    private function determineDoneDates() {
        $this->done_dates = $this->habit->habitDays()
                                        ->whereNotNull('done_at')
                                        ->get()
                                        ->pluck('done_at')
                                        ->map(function ($date) {
                                            return Carbon::parse($date)->format('Y-m-d');
                                        })
                                        ->toArray();

        return $this;
    }
}
