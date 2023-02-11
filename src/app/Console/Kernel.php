<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Download;
use App\Handlers\DownloadJobHandler;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function (): void {
            $this->downloads();
        })->everyMinute();
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

    private function downloads(): void
    {
        $download_job_handler = new DownloadJobHandler();
        $downloads = Download::lazy();

        foreach ($downloads as $download) {
            $frequency = $download->frequency;
            $last_run_at = $download->last_run_at;

            if (is_null($last_run_at) || $last_run_at->addMinutes($frequency)->isPast()) {
                $download_job_handler->handle($download);

                $download->update(['last_run_at' => Carbon::now()->setSecond(0)]);
            }
        }
    }
}
