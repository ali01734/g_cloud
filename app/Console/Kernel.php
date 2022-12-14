<?php

namespace nataalam\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \nataalam\Console\Commands\InstallCommand::class,
        \nataalam\Console\Commands\CreateStorageDirs::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $schedule
            ->command('backup:clean')
            ->daily()
            ->at('01:00');

        $schedule
            ->command('backup:run')
            ->daily()
            ->at('02:00');
    }
}
