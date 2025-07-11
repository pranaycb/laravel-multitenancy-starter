<?php

namespace App\Models\Central;

use App\Observers\Central\TenantObserver;
use Spatie\Multitenancy\Models\Tenant as SpatieTenant;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

#[ObservedBy(TenantObserver::class)]
class Tenant extends SpatieTenant
{
    use UsesLandlordConnection;

    protected $fillable = [
        'uid',
        'name',
        'domain',
        'database',
    ];
}
