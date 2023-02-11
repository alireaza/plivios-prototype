<?php

namespace App\Handlers;

use App\Jobs\DownloadJob;
use App\Models\Download;

class DownloadJobHandler
{
    public function handle(Download $download): void
    {
        DownloadJob::dispatch($download)->onQueue('download');
    }
}
