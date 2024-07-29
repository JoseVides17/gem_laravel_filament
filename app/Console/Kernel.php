<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    //protected $middlewareGroups = [
    //    'web' => [
    //        \App\Http\Middleware\UpdateExamStatus::class,
    //    ],
    //];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('examenes:actualizar-estatus')->daily();
        $schedule->command('empleados:actualizar-edad')->daily();
        $schedule->command('examenes:actualizar-dias-restantes')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
