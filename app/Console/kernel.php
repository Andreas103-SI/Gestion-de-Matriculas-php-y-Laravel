<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendNotifications::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Puedes agregar tareas programadas aquí
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
