<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    protected $guarded = [];

    public function getIsPremiumAttribute()
    {
        if ($this->premium_expired_at === null) {
            // The user has an unlimited premium plan
            return true;
        } elseif (Carbon::parse($this->premium_expired_at)->isPast()) {
            // The premium plan has expired
            return false;
        } else {
            return true;
        }
    }

    public function getPremiumRemainingDaysAttribute()
    {
        if ($this->premium_expired_at === null) {
            return 'unlimited';
        } elseif (Carbon::parse($this->premium_expired_at)->isPast()) {
            return 0;
        } else {
            return Carbon::now()->diffInDays($this->premium_expired_at) + 1;
        }
    }

    public function getRegisterCompletedAttribute()
    {
        return (bool) $this->register_completed_at;
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    public function goals()
    {
        return $this->belongsToMany(Goal::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function pushNotifications()
    {
        return $this->hasMany(PushNotification::class);
    }

    public function activeHabitsCount(){
        $habits = Habit::query()
            ->where('user_id', $this->id)
            ->get();
        $count = 0;
        foreach ($habits as $habit){
            $habit_end_date = Carbon::parse($habit->created_at)->addDays(21);
            if (Carbon::now() < $habit_end_date){
                $count++;
            }
        }
        return $count;
    }

    public function maxAllowedHabitsCount(){
        $count = 0;
        if (PlanUser::where('plan_id', 1)->where('user_id', $this->id)->first()){
            $count += 4;
        }
        if (PlanUser::where('plan_id', 2)->where('user_id', $this->id)->first()){
            $count += 8;
        }
        if ($this->premium_expired_at == null || PlanUser::where('plan_id', 3)->where('user_id', $this->id)->first()){
            $count += 1000000;
        }
        if ($this->premium_expired_at > now()){
            $count += 8;
        }
        return $count;
    }

    public function addCredit(Plan $plan){
        $this->plans()->attach($plan->id);

        if ($plan->is_unlimited){
            $this->premium_expired_at = null;
            $this->save();
        }else{
            if ($this->premium_expired_at === null){
                return;
            }
            else{
                if (Carbon::parse($this->premium_expired_at)->isPast()){
                    $this->premium_expired_at = Carbon::now()->addDays($plan->days);
                    $this->save();
                }else{
                    $this->premium_expired_at = Carbon::parse($this->premium_expired_at)->addDays($plan->days);
                    $this->save();
                }
            }
        }
    }

    public function transactions (): HasMany {
        return $this->hasMany(Transaction::class , 'user_id');
    }

    public function lastPaidTransactionPlanTitle(){
        $transaction = Transaction::query()
            ->where('user_id', $this->id)
            ->whereNotNull('verified_at')
            ->orderBy('verified_at', 'desc')
            ->first();
        if ($transaction){
            return $transaction->plan->title;
        }else{
            return "بدون خرید";
        }
    }

    public function friend () {
        return User::query()
            ->where('friend_user_id', $this->id)
            ->first();
    }
}
