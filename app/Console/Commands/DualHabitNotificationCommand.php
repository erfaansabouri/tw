<?php

namespace App\Console\Commands;

use App\Models\Habit;
use Exception;
use Illuminate\Console\Command;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class DualHabitNotificationCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dual-habit-reminder';
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
                       ->where('is_dual', true)
                       ->whereNotNull('notification_time')
                       ->whereHas('user' , function ( $q ) {
                           $q->whereNotNull('firebase_token');
                       })
                       ->get();
        foreach ( $habits as $habit ) {
            if ($habit->shouldReceivePushNotification()){
                $this->info("Sending to Habit ID: {$habit->id}");

                $text = "عادت {$habit->title} منتظرتونه، برید سراغش و بذاریدش توی روتین زندگی‌تون 🤍🌱";
                $data = [
                    'custom_title' => "بیست و یک روز" ,
                    'custom_description' =>  $text,
                    'click_action' => 'android.intent.action.VIEW' ,
                    'image' => asset('landing-assets/img/logo.png') ,
                ];
                $messaging = app('firebase.messaging');
                try {
                    $message = CloudMessage::withTarget('token' , $habit->user->firebase_token)
                        ->withDefaultSounds()
                                           ->withNotification(Messaging\Notification::create("بیست و یک روز" , $text , asset('landing-assets/img/logo.png')))
                                           ->withData($data);
                    $messaging->send($message);
                }
                catch ( Exception $exception ) {
                    $this->info($exception->getMessage());
                }
                $habit->notification_sent_at = now();
                $habit->saveQuietly();
            }
            if ($habit->friendShouldReceivePushNotification()){
                $this->info("Sending to Habit ID: {$habit->id}");

                $text = "عادت {$habit->title} منتظرتونه، برید سراغش و بذاریدش توی روتین زندگی‌تون 🤍🌱";
                $data = [
                    'custom_title' => "بیست و یک روز" ,
                    'custom_description' =>  $text,
                    'click_action' => 'android.intent.action.VIEW' ,
                    'image' => asset('landing-assets/img/logo.png') ,
                ];
                $messaging = app('firebase.messaging');
                try {
                    if ($habit->user->friend() && $habit->user->friend()->firebase_token){
                        $message = CloudMessage::withTarget('token' , $habit->user->friend()->firebase_token)
                            ->withDefaultSounds()
                                               ->withNotification(Messaging\Notification::create("بیست و یک روز" , $text , asset('landing-assets/img/logo.png')))
                                               ->withData($data);
                        $messaging->send($message);
                    }
                }
                catch ( Exception $exception ) {
                    $this->info($exception->getMessage());
                }
                $habit->friend_notification_sent_at = now();
                $habit->saveQuietly();
            }
        }


        return Command::SUCCESS;
    }
}
