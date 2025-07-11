<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Multitenancy\Models\Tenant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Tenant::checkCurrent()
            ? $this->runTenantSeeders()
            : $this->runCentralSeeders();
    }

    /**
     * Run trenant specific seeders
     */
    public function runTenantSeeders()
    {
        $this->call([
            //
        ]);
    }

    /**
     * Run central specific seeders
     */
    public function runCentralSeeders()
    {
        $this->call([
            //
        ]);
    }
}
