<?php

namespace App\Console\Commands;

use App\Jobs\DataFileDownloaderJob;
use Illuminate\Console\Command;

class DispatchDataDownLoaderJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:source';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command dispatches data file downloader job';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        DataFileDownloaderJob::dispatch();
    }
}
