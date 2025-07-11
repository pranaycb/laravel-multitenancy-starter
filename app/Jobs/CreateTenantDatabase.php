<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTenantDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $database){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::statement("CREATE DATABASE IF NOT EXISTS `{$this->database}` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`");
    }
}
