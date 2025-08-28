<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model {
    protected $guarded = [];
    const TYPES = [
        'SINGLE_HABIT_REMINDER' => 'SINGLE_HABIT_REMINDER' ,
        'AFTER_5_DAYS_AT_10' => 'AFTER_5_DAYS_AT_10' ,
        'ONE_DAY_OFFLINE' => 'ONE_DAY_OFFLINE' ,
        'THREE_DAYS_OFFLINE' => 'THREE_DAYS_OFFLINE' ,
        'SEVEN_DAYS_OFFLINE' => 'SEVEN_DAYS_OFFLINE' ,
    ];
}
