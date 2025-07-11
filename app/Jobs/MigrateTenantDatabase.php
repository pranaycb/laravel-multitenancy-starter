<?php

namespace App\Jobs;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MigrateTenantDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $database, public string $uid){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $connection = 'tenant_' . $this->uid;

        // create a temporary connection
        config([
            "database.connections.{$connection}" => array_merge(
                config('database.connections.tenant'),
                ['database' => $this->database]
            ),
        ]);

        try {
            Artisan::call('migrate:fresh', [
                '--path'     => 'database/migrations/tenant',
                '--database' => $connection,
                '--seed'     => true,
                '--force'    => true,
            ]);

            logger()->info("Migration and seed successful for tenant database : {$this->database}");
        }
        finally {
            // close the temporary connection
            DB::purge($connection);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        // Send user notification of failure
    }
}
