<?php

namespace App\Listeners;

use App\Jobs\DeleteTenantDatabase;
use App\Jobs\DeleteTenantDirectory;
use App\Events\Central\TenantDeleted;

class TenantDeletedListener
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
    public function handle(TenantDeleted $event): void
    {
        $tenant = $event->tenant;

        DeleteTenantDatabase::withChain([
            new DeleteTenantDirectory("tenant/{$tenant->uid}")
        ])->dispatch($tenant->database);
    }
}
