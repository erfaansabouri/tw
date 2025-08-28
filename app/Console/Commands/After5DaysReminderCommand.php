<?php

namespace App\Console\Commands;

use App\Models\Habit;
use App\Models\PushNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class After5DaysReminderCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'after-5-days';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle () {
        $habits = Habit::query()
                       ->whereDoesntHave('pushNotifications' , function ( $q ) {
                           $q->where('type' , PushNotification::TYPES[ 'AFTER_5_DAYS_AT_10' ]);
                       })
                       ->whereDate('created_at' , '=' , Carbon::now()
                                                          ->subDays(5)->format('Y-m-d')) // 5 days old
                       ->whereHas('user' , function ( $q ) {
                           $q->whereNotNull('firebase_token');
                       })
                       ->get();
        foreach ( $habits as $habit ) {
            $text = "از عادت {$habit->title} چه خبر؟ باهاش خوش می‌گذره؟";
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
                                             'type' => PushNotification::TYPES[ 'AFTER_5_DAYS_AT_10' ] ,
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
