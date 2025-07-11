<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteTenantDirectory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $directory){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = storage_path($this->directory);

        if(File::isDirectory($path)) {
            File::deleteDirectory($path);
        }
    }
}
