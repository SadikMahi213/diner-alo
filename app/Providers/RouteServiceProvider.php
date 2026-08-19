<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected to their dashboard after authentication.
     */
    public const HOME = '/dashboard';

    /**
     * Define the routes for the application.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->loadMigrationsFrom(database_path('migrations'));

        Route::middleware('web')
            ->namespace($this->app->getNamespace() . 'Http\Controllers')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Configure the rate limitations for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return $request->user()
                ? Limit::perMinute(1000)->by($request->user()->id)
                : Limit::perMinute(60)->by($request->ip());
        });
    }
}
