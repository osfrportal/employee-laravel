<?php

namespace Osfrportal\OsfrportalLaravel\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

//console commands
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRImapGetCommand;

//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;


class OsfrportalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Date::use(CarbonImmutable::class);
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/osfrportal.php' => config_path('osfrportal.php'),
                __DIR__ . '/../../config/osfrportal_filesystems.php' => config_path('osfrportal_filesystems.php'),
            ], 'osfrportal-config');
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/osfrportal'),
            ], 'osfrportal-views');
            $this->publishes([
                __DIR__ . '/../../public' => public_path('osfrportal'),
            ], 'osfrportal-public');

            $this->commands([
                SFRImapGetCommand::class,
                //::class,
                //::class,
                //::class,
                //::class,
                //::class,
            ]);
            $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
                $schedule->command('sfr:imapget')->dailyAt(config('osfrportal.shedule.ImapDailyTime', '00:01'));
                //$schedule->command('sfr:importpersons')->dailyAt(config('osfrportal.shedule.PersonsDailyTime', '00:03'));
                //$schedule->command('sfr:importmovements')->dailyAt(config('osfrportal.shedule.MovementsDailyTime', '00:04'));
                //$schedule->command('sfr:importdepartments)->dailyAt(config('osfrportal.shedule.DepatrmentsDailyTime', '00:05'));
                //$schedule->command('sfr:importvacation')->dailyAt(config('osfrportal.shedule.VacationDailyTime', '00:06'));
                //$schedule->command('sfr:importdekret')->dailyAt(config('osfrportal.shedule.DekretDailyTime', '00:07'));
            });
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
        config([
            'auth.guards.web' => [
                'driver' => 'session',
                'provider' => 'sfrusers',
            ]
        ]);
        config([
            'auth.defaults' => [
                'guard' => 'web',
                'passwords' => 'sfrusers',
            ]
        ]);
        config([
            'auth.providers' => array_merge([
                'sfrusers' => [
                    'driver' => 'eloquent',
                    'model' => \Osfrportal\OsfrportalLaravel\Models\SfrUser::class,
                ],
            ], config('auth.providers', [])),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/osfrportal.php',
            'osfrportal'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/osfrportal_filesystems.php',
            'filesystems.disks'
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
