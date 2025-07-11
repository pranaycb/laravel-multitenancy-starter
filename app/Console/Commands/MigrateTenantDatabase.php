<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class MigrateTenantDatabase extends Command
{
    protected $signature = 'tenant:migrate
        {--rollback : Rollback the last batch}
        {--fresh : Drop all tables and re-run all migrations}
        {--seed : Run the database seeders}
        {--step= : The number of steps to rollback}';

    public function handle()
    {
        $rollback = $this->option('rollback');
        $fresh = $this->option('fresh');
        $seed = $this->option('seed');
        $step = $this->option('step');

        $command = 'migrate';

        // Prevent run both fresh and rollback
        if ($fresh && $rollback) {
            $this->error("You can't use both --fresh and --rollback at the same time.");
            return 1;
        }

        if ($rollback) $command .= ':rollback';
        elseif ($fresh) $command .= ':fresh';

        $args = [
            $command,
            "--path=database/migrations/tenant",
            "--database=" . config('multitenancy.tenant_database_connection_name'),
            "--force",
        ];

        if ($step) $args[] = "--step={$step}";

        if ($seed) $args[] = "--seed";

        // Capture the output from tenants:artisan
        $buffer = new BufferedOutput();
        $buffer->setDecorated(true);

        // Run the command across all tenants
        Artisan::call('tenants:artisan', [
            'artisanCommand' => implode(' ', $args),
        ], $buffer);

        $output = $buffer->fetch();
        $this->line($output);
    }
}
