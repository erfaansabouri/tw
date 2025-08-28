<?php

namespace App\Console\Commands;

use App\Models\Habit;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class HabitNotificationCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'habit-notification';
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
                       ->where('is_dual', false)
                       ->whereNotNull('notification_time')
                       ->whereHas('user' , function ( $q ) {
                           $q->whereNotNull('firebase_token');
                       })
                       ->get();
        $count = count($habits);
        foreach ( $habits as $habit ) {
            if ($habit->shouldReceivePushNotification()){
                $this->info("Sending to Habit ID: {$habit->id}");

                $text = "عادت {$habit->title} منتظرته، برو سراغش و توی سبک زندگیت همیشگی‌ش کن 🌱";
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
        }

        return Command::SUCCESS;
    }
}
