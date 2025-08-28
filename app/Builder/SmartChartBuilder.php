<?php

namespace App\Builder;

use App\Models\Habit;
use Carbon\Carbon;
use NumberFormatter;

class SmartChartBuilder
{
    public $habit;
    public $end_date;
    public $start_date;
    public $habit_days;

    public function setHabit(Habit $habit)
    {
        $this->habit = $habit;
        $this->habit_days = $habit->habitDays;
        $this->start_date = $this->habit_days->where('number', 1)->first()->date;
        $this->end_date = $this->habit_days->where('number', 21)->first()->date;
        return $this;
    }


    public function render()
    {
        $chart_days = [];
        $current_date = Carbon::parse($this->start_date);
        $number = 1;
        foreach ($this->habit_days as $habit_day) {
            $day_name = new NumberFormatter("fa", NumberFormatter::SPELLOUT);
            $day_name = "روز " . $day_name->format($habit_day->number) . "م";
            $chart_days[] = [
                'number' => $number++,
                'date' => str_replace('سهم', 'سوم', $day_name),
                'satisfaction_percentage' => $habit_day->satisfaction_percentage,
                'satisfaction_emoji' => $habit_day->satisfaction_emoji,
            ];
            $current_date->addDay();
        }
        return $chart_days;
    }

}
