<?php

namespace App\Models;

use Carbon\Carbon;

class HabitWeek extends Model {
    const DAYS_COUNT = 7;

    protected static function booted () {
        static::created(function ( HabitWeek $habitWeek ) {
            self::createDays($habitWeek);
        });
    }

    public static function createDays ( HabitWeek $habitWeek ) {
        for ( $i = 1 ; $i <= self::DAYS_COUNT ; $i++ ) {
            $habitWeek->habitDays()
                      ->updateOrCreate([
                                           'number' => $i + ( ( $habitWeek->number - 1 ) * 7 ) ,
                                       ] , [
                                           'date' => Carbon::parse($habitWeek->start_date)
                                                           ->addDays($i - 1)
                                                           ->startOfDay() ,
                                       ]);
        }
    }

    public function habit () {
        return $this->belongsTo(Habit::class);
    }

    public function habitDays () {
        return $this->hasMany(HabitDay::class);
    }

    public function currentDay () {
        if ( $this->habit && $this->habit->isMine() ) {
            return $this->hasOne(HabitDay::class)
                        ->orderBy('date')
                        ->whereNull('satisfaction_emoji');
        }
        else {
            return $this->hasOne(HabitDay::class)
                        ->orderBy('date')
                        ->whereNull('friend_satisfaction_emoji');
        }
    }
}
