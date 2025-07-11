<?php

namespace App\Observers\Central;

use Illuminate\Support\Str;
use App\Models\Central\Tenant;
use App\Events\Central\TenantCreated;
use App\Events\Central\TenantDeleted;

class TenantObserver
{
    /**
     * Handle the Tenant "creating" event.
     */
    public function creating(Tenant $tenant): void
    {
        $tenant->uid = $tenant->uid ?? random_int(1000000, 9999999);;
    }


    /**
     * Handle the Tenant "created" event.
     */
    public function created(Tenant $tenant): void
    {
        event(new TenantCreated($tenant));
    }

    /**
     * Handle the Tenant "deleted" event.
     */
    public function deleted(Tenant $tenant): void
    {
        event(new TenantDeleted($tenant));
    }
}
