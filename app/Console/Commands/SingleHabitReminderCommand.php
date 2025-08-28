<?php

namespace App\Console\Commands;

use App\Models\Habit;
use App\Models\PushNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class SingleHabitReminderCommand extends Command {
    protected $signature   = 'single-habit-reminder';
    protected $description = 'Command description';

    public function handle () {
        $habits = Habit::query()
                       ->where('is_dual' , false)
                       ->whereDoesntHave('pushNotifications' , function ( $q ) {
                           $q->where('sent_at' , '>=' , Carbon::now()
                                                              ->subDays(3))
                             ->where('type' , PushNotification::TYPES[ 'SINGLE_HABIT_REMINDER' ]);
                       })
                       ->where('created_at' , '>=' , Carbon::now()
                                                           ->subDays(21))
                       ->whereHas('user' , function ( $q ) {
                           $q->whereNotNull('firebase_token');
                       })
                       ->get();
        foreach ( $habits as $habit ) {
            $current_day = $habit->habitDays()
                                 ->whereNotNull('done_at')
                                 ->count() + 1;
            $habit_text = $habit->habit_text;
            $text = "روز $current_day عادت {$habit_text} منتظرته ☕️";
            $data = [
                'custom_title' => "بیست و یک روز" ,
                'custom_description' => $text ,
                'click_action' => 'android.intent.action.VIEW' ,
                'image' => asset('landing-assets/img/logo.png') ,
            ];
            $messaging = app('firebase.messaging');
            try {
                PushNotification::query()
                                ->create([
                                             'type' => PushNotification::TYPES[ 'SINGLE_HABIT_REMINDER' ] ,
                                             'user_id' => $habit->user->id ,
                                             'habit_id' => $habit->id ,
                                             'sent_at' => now() ,
                                         ]);
                $message = CloudMessage::withTarget('token' , $habit->user->firebase_token)
                    ->withDefaultSounds()
                                       ->withNotification(Messaging\Notification::create("بیست و یک روز" , $text , asset('landing-assets/img/logo.png')))
                                       ->withData($data);
                $messaging->send($message);
            }
            catch ( Exception $exception ) {
                $this->info($exception->getMessage());
            }
        }
    }
}
