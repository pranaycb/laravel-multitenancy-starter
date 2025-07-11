<?php

namespace App\Listeners;

use App\Jobs\CreateTenantDatabase;
use App\Jobs\CreateTenantDirectory;
use App\Jobs\MigrateTenantDatabase;
use App\Events\Central\TenantCreated;

class TenantCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TenantCreated $event): void
    {
        $tenant = $event->tenant;

        CreateTenantDatabase::withChain([
            new MigrateTenantDatabase($tenant->database, $tenant->uid),
            new CreateTenantDirectory("tenant/{$tenant->uid}"),
        ])->dispatch($tenant->database);
    }
}
