<?php

namespace App\Console\Commands;

use App\Models\Habit;
use Exception;
use Illuminate\Console\Command;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class DualHabit48HoursNotificationCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dual-habit-48-hours-reminder';
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
                       ->where('is_dual' , true)
                       ->whereBetween('created_at' , [
                           now()->subDays(30) ,
                           now(),
                       ])
                       ->get();
        foreach ( $habits as $habit ) {
            $last_done_at = $habit->habitDays()
                                  ->whereNotNull('done_at')
                                  ->orderByDesc('done_at')
                                  ->first();
            // if last done at not exists or 48 passed from exist
            if ( is_null($last_done_at) || $last_done_at->done_at->diffInHours() >= 48 ) {
                $text = "هم مسیرت رو توی این راه تنها نذار 🥺";
                $data = [
                    'custom_title' => "بیست و یک روز" ,
                    'custom_description' => $text ,
                    'click_action' => 'android.intent.action.VIEW' ,
                    'image' => asset('landing-assets/img/logo.png') ,
                ];
                $messaging = app('firebase.messaging');
                try {
                    if ( $habit->user->firebase_token ) {
                        $message = CloudMessage::withTarget('token' , $habit->user->firebase_token)
                            ->withDefaultSounds()
                                               ->withNotification(Messaging\Notification::create("بیست و یک روز" , $text , asset('landing-assets/img/logo.png')))
                                               ->withData($data);

                        $messaging->send($message);

                    }
                }
                catch ( Exception $exception ) {
                    $this->info($exception->getMessage());
                }
            }

            $friend_last_done_at = $habit->habitDays()
                                         ->whereNotNull('friend_done_at')
                                         ->orderByDesc('friend_done_at')
                                         ->first();

            // if last done at not exists or 48 passed from exist
            if ( is_null($friend_last_done_at) || $friend_last_done_at->friend_done_at->diffInHours() >= 48 ) {
                $text = "هم مسیرت رو توی این راه تنها نذار 🥺";
                $data = [
                    'custom_title' => "بیست و یک روز" ,
                    'custom_description' => $text ,
                    'click_action' => 'android.intent.action.VIEW' ,
                    'image' => asset('landing-assets/img/logo.png') ,
                ];
                $messaging = app('firebase.messaging');
                try {
                    if ( $habit->user->friend() && $habit->user->friend()->firebase_token ) {
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
            }
        }

        return Command::SUCCESS;
    }
}
