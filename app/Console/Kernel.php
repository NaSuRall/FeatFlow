<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:check-for-survey-to-close')->hourlyAt(55);

        \Log::info('Check for survey executed at ' . now());
        $this->info('Check for survey executed at ' . now());

    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
