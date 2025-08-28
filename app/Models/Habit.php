<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class Habit extends Model {
    use SoftDeletes;

    const FOLLOWUP_TYPES = [
        'time' => 'time' ,
        'repeat' => 'repeat' ,
    ];
    const WEEKS_COUNT    = 3;
    protected $casts = [
        'is_dual' => 'boolean' ,
    ];

    protected static function booted () {
        static::created(function ( Habit $habit ) {
            self::createWeeks($habit);
        });
    }

    public static function createWeeks ( Habit $habit ) {
        for ( $i = 1 ; $i <= self::WEEKS_COUNT ; $i++ ) {
            $habit->habitWeeks()
                  ->updateOrCreate([
                                       'number' => $i ,
                                   ] , [
                                       'start_date' => Carbon::now()
                                                             ->addWeeks($i - 1)
                                                             ->startOfDay() ,
                                       'end_date' => Carbon::now()
                                                           ->addWeeks($i - 1)
                                                           ->addDays(6)
                                                           ->endOfDay() ,
                                   ]);
        }
    }

    public function habitWeeks () {
        return $this->hasMany(HabitWeek::class);
    }

    public function pushNotifications () {
        return $this->hasMany(PushNotification::class);
    }

    public function currentWeek () {
        return $this->hasOne(HabitWeek::class)
                    ->whereDate('start_date' , '<=' , Carbon::now()
                                                            ->format('Y-m-d'))
                    ->whereDate('end_date' , '>=' , Carbon::now()
                                                          ->format('Y-m-d'));
    }

    public function getIsCompletedAttribute (): bool {
        return $this->habitDays()
                    ->whereNotNull('satisfaction_percentage')
                    ->count() == 21 || $this->habitDays()
                                            ->whereNotNull('satisfaction_emoji')
                                            ->count() == 21;
    }

    public function habitDays () {
        return $this->hasManyThrough(HabitDay::class , HabitWeek::class);
    }

    public function getBestStrikeCountAttribute () {
        $habit_days = $this->habitDays()
                           ->whereNotNull('done_at')
                           ->get()
                           ->pluck('done_at')
                           ->toArray();
        if ( count($habit_days) == 0 ) {
            return 0;
        }
        // Sort the array to ensure dates are in ascending order
        sort($habit_days);
        // Initialize variables
        $consecutiveDays = 1;
        $maxConsecutiveDays = 1;
        // Iterate through the array starting from the second date
        for ( $i = 1 ; $i < count($habit_days) ; $i++ ) {
            // Convert dates to Carbon objects for comparison
            $currentDate = Carbon::parse($habit_days[ $i ]);
            $previousDate = Carbon::parse($habit_days[ $i - 1 ]);
            // Check if the difference is 1 day
            if ( $currentDate->diffInDays($previousDate) == 1 ) {
                $consecutiveDays++;
                // Update the maximum consecutive days if needed
                $maxConsecutiveDays = max($maxConsecutiveDays , $consecutiveDays);
            }
            else {
                // Reset consecutiveDays if there's a gap
                $consecutiveDays = 1;
            }
        }

        // Output the result
        return $maxConsecutiveDays;
    }

    public function hasMoreThan2DaysGap () {
        if ( Carbon::parse($this->created_at)
                   ->diffInDays(now()) < 21 ) {
            return true;
        }
        // Your array of timestamps
        $timestamps = $this->habitDays()
                           ->whereNotNull('done_at')
                           ->get()
                           ->pluck('done_at')
                           ->toArray();
        if ( count($timestamps) == 0 ) {
            return true;
        }
        // Convert timestamps to Carbon instances and sort them
        $dates = array_map(function ( $timestamp ) {
            return Carbon::createFromFormat('Y-m-d H:i:s' , $timestamp);
        } , $timestamps);
        // Sort dates in ascending order
        usort($dates , function ( $a , $b ) {
            return $a->gt($b) ? 1 : -1;
        });
        // Check if there is a 2-day gap between timestamps
        $hasGap = false;
        for ( $i = 0 ; $i < count($dates) - 1 ; $i++ ) {
            if ( $dates[ $i ]->diffInDays($dates[ $i + 1 ]) >= 2 ) {
                $hasGap = true;
                break;
            }
        }

        return $hasGap;
    }

    public function getDoneDaysCountAttribute () {
        return $this->habitDays()
                    ->whereNotNull('done_at')
                    ->count();
    }

    public function shouldReceivePushNotification () {
        if ( !$this->notification_time ) {
            return false;
        }
        if ( $this->notification_sent_at && Carbon::parse($this->notification_sent_at)
                                                  ->isToday() ) {
            return false;
        }
        $now = Carbon::now();
        $notification_time = Carbon::parse($this->notification_time);
        // if at most 10 minutes passed from now return true else return false
        if ( $notification_time->lt($now) && $now->diffInMinutes($notification_time) <= 10 ) {
            return true;
        }

        return false;
    }

    public function friendShouldReceivePushNotification () {
        if ( !$this->friend_notification_time ) {
            return false;
        }
        if ( $this->friend_notification_sent_at && Carbon::parse($this->friend_notification_sent_at)
                                                         ->isToday() ) {
            return false;
        }
        $now = Carbon::now();
        $notification_time = Carbon::parse($this->friend_notification_time);
        // if at most 10 minutes passed from now return true else return false
        if ( $notification_time->lt($now) && $now->diffInMinutes($notification_time) <= 10 ) {
            return true;
        }

        return false;
    }

    public function scopeMineOrMyFriend ( Builder $query ): Builder {
        $my_id = Auth::user()->id;
        $friend = User::query()
                      ->where('friend_user_id' , $my_id)
                      ->first();
        if ( $friend ) {
            return $query->where(function ( Builder $query ) use ( $my_id , $friend ) {
                $query->where('user_id' , $my_id)
                      ->orWhere(function ( Builder $query ) use ( $friend ) {
                          $query->where('user_id' , $friend->id)
                                ->where('is_dual' , true);
                      });
            });
        }
        else {
            return $query->where('user_id' , $my_id);
        }
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function currentHabitDay () {
        if ($this->isMine()){
            return $this->habitDays()
                           ->whereNull('satisfaction_emoji')
                           ->orderBy('date')
                           ->first();
        }else{
            return $this->habitDays()
                           ->whereNull('friend_satisfaction_emoji')
                           ->orderBy('date')
                           ->first();
        }

    }

    public function getColumnValueMineOrMyFriend ( $column_name ) {
        if ( Auth::user()->id == $this->user_id ) {
            return $this->$column_name;
        }
        else {
            $friend_column = 'friend_' . $column_name;

            return $this->$friend_column;
        }
    }

    public function setColumnValueMineOrMyFriend ( $column_name , $value ) {
        if ( Auth::user()->id == $this->user_id ) {
            $this->$column_name = $value;
        }
        else {
            $friend_column = 'friend_' . $column_name;
            $this->$friend_column = $value;
        }
    }

    public function isMine () {
        if ( Auth::user()->id == $this->user_id ) {
            return true;
        }

        return false;
    }

    public function sendFcmToOwner ( $text ) {
        $user = $this->user;
        if ( $user->firebase_token ) {
            try {
                $data = [
                    'custom_title' => "بیست و یک روز" ,
                    'custom_description' => $text ,
                    'click_action' => 'android.intent.action.VIEW' ,
                    'image' => asset('landing-assets/img/logo.png') ,
                ];
                $messaging = app('firebase.messaging');
                $message = CloudMessage::withTarget('token' , $user->firebase_token)
                    ->withDefaultSounds()
                                       ->withNotification(Messaging\Notification::create("بیست و یک روز" , $text , asset('landing-assets/img/logo.png')))
                                       ->withData($data);
                $messaging->send($message);
            }
            catch ( Exception $exception ) {

            }
        }
    }

    public function sendFcmToFriend ( $text ) {
        $friend = $this->user->friend();
        if ( $friend && $friend->firebase_token ) {
            try {
                $data = [
                    'custom_title' => "بیست و یک روز" ,
                    'custom_description' => $text ,
                    'click_action' => 'android.intent.action.VIEW' ,
                    'image' => asset('landing-assets/img/logo.png') ,
                ];
                $messaging = app('firebase.messaging');
                $message = CloudMessage::withTarget('token' , $friend->firebase_token)
                                       ->withDefaultSounds()
                                       ->withNotification(Messaging\Notification::create("بیست و یک روز" , $text , asset('landing-assets/img/logo.png')))
                                       ->withData($data);
                $messaging->send($message);
            }
            catch ( Exception $exception ) {

            }
        }
    }
}
