<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule ( Schedule $schedule ) {
        $schedule->command('dual-habit-reminder')
                 ->everyMinute()
                 ->withoutOverlapping();

        $schedule->command('dual-habit-48-hours-reminder')
                 ->dailyAt('09:00')
                 ->withoutOverlapping();
        // سه روز در میان 9 صبح
        $schedule->command('single-habit-reminder')
                 ->dailyAt('09:00')
                 ->withoutOverlapping();
        // ارسالی یک بار در ساعت ۱۰ صبح، ۵ روز بعد از ساختن عادت توسط کاربر
        $schedule->command('after-5-days')
                 ->dailyAt('10:00')
                 ->withoutOverlapping();

        // وقتی کاربر یک روز برنامه رو باز نکرد؛ در ساعت ۱۱ شب
        $schedule->command('one-day-offline')
                 ->dailyAt('23:00')
                 ->withoutOverlapping();

        // وقتی کاربر سه روز برنامه رو باز نکرد؛
        $schedule->command('three-days-offline')
                 ->dailyAt('21:00')
                 ->withoutOverlapping();

        // وقتی کاربر یک هفته برنامه رو باز نکرد؛
        $schedule->command('seven-days-offline')
                 ->dailyAt('23:00')
                 ->withoutOverlapping();

        $schedule->command('habit-notification')
                 ->everyMinute()
                 ->withoutOverlapping();

        $schedule->command('telescope:prune')->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands () {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
