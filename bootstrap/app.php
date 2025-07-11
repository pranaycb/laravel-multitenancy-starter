<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AssetController;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Multitenancy\Exceptions\NoCurrentTenant;
use Spatie\Multitenancy\Http\Middleware\NeedsTenant;
use Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function() {

            // Route to handle assets
            Route::get('/assets/{path?}', AssetController::class)
                ->where('path', '(.*)')->name('global.assets');

            $centralDomains = config('multitenancy.central_domains');

            // central routes
            foreach ($centralDomains as $domain) {
                Route::middleware('web')->domain($domain)->group(base_path('routes/web.php'));
            }

            // Tenant routes
            Route::middleware(['web', 'tenant'])->group(base_path('routes/tenant.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->group('tenant', [
            NeedsTenant::class,
            EnsureValidTenantSession::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(fn (NoCurrentTenant $e) => abort(404));
    })
    ->create();
