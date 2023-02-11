<?php

namespace App\Jobs;

use App\Handlers\DownloadHandler;
use App\Models\Download;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Download $download)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $download_handler = new DownloadHandler();
        $response = $download_handler->handle($this->download->url);

        $this->download->responses()->firstOrCreate([
            'status_code' => $response['status_code'],
            'contents' => $response['contents'],
        ], [
            'method' => $response['method'],
            'url' => $response['uri'],
            'payload' => $response['payload'],
            'status_text' => $response['status_text'],
        ]);
    }
}
