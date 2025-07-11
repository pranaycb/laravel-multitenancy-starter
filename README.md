
# Laravel Multitenancy Starter

A laravel starter application for the multitenant based application development



## Acknowledgements

This starter application is based on `spatie multitenancy` package. Refer to this package for more information

 - [Spatie Multitenancy](https://spatie.be/docs/laravel-multitenancy/v4/introduction)

## Features

- Automatically create, migrate and seed database and create directory for all tenants
- Automatically switch database, caches, sessions and storage path for the specific tenant
- Write code as you always write. No extra configurations needed.


## Get Started

Clone the starter project

```bash
  git clone https://github.com/pranaycb/laravel-multitenancy-starter
```

Go to the project directory

```bash
  cd laravel-multitenancy-starter
```

Install composer dependencies

```bash
  Composer install
```

Install npm dependencies (optional)

```bash
  npm install
```

Start the server

```bash
  php artisan serve
```


## Configurations

All the configurations related with the multitenancy are stored inside the `config/multitenancy.php` file. Please refer to the spatie multitenancy package for more information related to configuring the tenant.
## Central Application

Central application is the application from where all the tenant creation, subscription management are managed.

### Central Routes

Define all your central routes inside the `routes/web.php` directory 

### Central Models

Store all your central model inside `the app/Models/Central` directory. Also add the `Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection` trait inside your model so that the package can identify the model as central model. Here is an example : 

```php

<?php

namespace App\Models\Central;


use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class Example extends Model
{
    use UsesLandlordConnection;

    // properties and method

}

```

### Central Controller

Store all your central controllers inside the app/Controllers/Central directory.

### Central Migration & Seeding

Store all your central application migrations file inside the `database/migratios/central` directory. Run the below command to migrate to central database
```bash
php artisan migrate:fresh --path="database/migration/central" 
```

Optionally you can seed the central database. List all your central database seeder inside the `database/seeder/DatabaseSeeder.php` file's `runCentralSeeders` method and then run the below command:
```bash
php artisan db:seed
```



## Tenant Application

Tenant application is the main application which all the tenant can access from the assigned domain.

### Tenant Routes

Define all your central routes inside the `routes/tenant.php` directory 

### Tenant Models

Store all your central model inside the `app/Models/Tenant` directory. Also add the `Spatie\Multitenancy\Models\Concerns\UsesTenantConnection` trait inside your model so that the package can identify the model as tenant model. Here is an example : 

```php

<?php

namespace App\Models\Tenant;


use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Example extends Model
{
    use UsesTenantConnection;

    // properties and method

}

```

### Tenant Controller

Store all your tenant controllers inside the app/Controllers/Tenant directory.

### Tenant Migration & Seeding

Store all your tenant migrations file inside the `database/migratios/Tenant` directory. Run the below command to migrate to all tenant databases
```bash
php artisan tenant:migrate" 
```

Optionally you can pass --seed flag to seed data to all tenant's database. List all your tenant database seeder inside the `database/seeder/DatabaseSeeder.php` file's `runTenantSeeders` method and then run the below command:
```bash
php artisan tenant:migrate --seed
```

Note: This will migrate and seed to all tenant databases. So migrate and seed data carefully.



## Support

For support, send me an email at pranaycb.ctg@gmail.com.

