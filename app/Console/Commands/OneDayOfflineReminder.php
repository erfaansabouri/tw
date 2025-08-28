<?php

namespace App\Console\Commands;

use App\Models\Habit;
use App\Models\PushNotification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class OneDayOfflineReminder extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'one-day-offline';
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
        $users = User::query()
                     ->whereNotNull('firebase_token')
                     ->whereDoesntHave('pushNotifications' , function ( $q ) {
                         $q->where('type' , PushNotification::TYPES[ 'ONE_DAY_OFFLINE' ]);
                     })
                     ->where('was_online_at' , '<' , Carbon::now()
                                                           ->subDay())
                     ->get();
        foreach ( $users as $user ) {
            $text = "یک روزی میشه به عادت های جدیدت سر نزدی 😞 فردا تموم توانت رو بذار برگردی به مسیر 😍";
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
                                             'type' => PushNotification::TYPES[ 'ONE_DAY_OFFLINE' ] ,
                                             'user_id' => $user->id ,
                                             'habit_id' => null ,
                                             'sent_at' => now() ,
                                         ]);
                $message = CloudMessage::withTarget('token' , $user->firebase_token)
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
