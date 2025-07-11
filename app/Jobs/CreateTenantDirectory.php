<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTenantDirectory implements ShouldQueue
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
        /**
         * Create assets directory for the tenant
         */

        $tenantId = $this->directory;

        $paths = [
            storage_path($tenantId),
            storage_path("{$tenantId}/public"),
            storage_path("{$tenantId}/private")
        ];

        $skeleton =  storage_path('app/private/skeleton');

        foreach ($paths as $path) {
            if (!File::exists($path)) {
                File::makeDirectory($path, recursive: true, force: true);
            }
        }
        // File::copyDirectory($skeleton, $paths[1]);
    }
}
