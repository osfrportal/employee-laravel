<?php

namespace Osfrportal\OsfrportalLaravel\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;


//console commands
//use Courier\Console\Commands\InstallCommand;
//use Courier\Console\Commands\NetworkCommand;

class OsfrportalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Date::use (CarbonImmutable::class);
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/osfrportal.php' => config_path('osfrportal.php'),
            ], 'osfrportal-config');
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/osfrportal'),
            ], 'osfrportal-views');
            $this->publishes([
                __DIR__ . '/../../public' => public_path('osfrportal'),
            ], 'osfrportal-public');
            /*
            $this->commands([
            InstallCommand::class,
            NetworkCommand::class,
            ]);
            */
        }
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'osfrportal');

        if (config('osfrportal.enabled', false)) {
            $this->registerRoutes();
            Route::aliasMiddleware('auth.osfrportal', '\Osfrportal\OsfrportalLaravel\Http\Middleware\Authenticate');
        }


    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/osfrportal.php',
            'osfrportal'
        );
    }

    /**
     * Register the package API routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'prefix' => 'api/osfr/v1/osfrportal',
            'namespace' => 'Osfrportal\OsfrportalLaravel\Http\Controllers',
            'as' => 'osfrapi.osfrportal.',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/osfrportal_api_v1.php');
        })->middleware('api');

        Route::group([
            'namespace' => 'Osfrportal\OsfrportalLaravel\Http\Controllers',
	        'middleware' => 'web',
            'as' => 'osfrportal.',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/osfrportal_web.php');
        })->middleware('web');
    }
}
