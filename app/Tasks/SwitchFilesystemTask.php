<?php

namespace App\Tasks;

use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

class SwitchFilesystemTask implements SwitchTenantTask
{
    public function makeCurrent(IsTenant $tenant): void
    {
        config([
            'filesystems.disks.local.root' => storage_path("tenant/{$tenant->id}/private"),
            'filesystems.disks.public.root' => storage_path("tenant/{$tenant->id}/public"),
        ]);
    }

    public function forgetCurrent(): void
    {
        config([
            'filesystems.disks.local.root' => storage_path('app/private'),
            'filesystems.disks.public.root' => storage_path('app/public'),
        ]);
    }
}
