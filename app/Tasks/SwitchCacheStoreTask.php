<?php

namespace App\Tasks;

use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

class SwitchCacheStoreTask implements SwitchTenantTask
{
    public function makeCurrent(IsTenant $tenant): void
    {
        config([
            'cache.stores.database.connection' => config('multitenancy.tenant_database_connection_name'),
            'session.connection' => config('multitenancy.tenant_database_connection_name'),
        ]);
    }

    public function forgetCurrent(): void
    {
        config([
            'cache.stores.database.connection' => config('multitenancy.landlord_database_connection_name'),
            'session.connection' => config('multitenancy.landlord_database_connection_name'),
        ]);
    }
}
