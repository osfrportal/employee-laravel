<?php

namespace Osfrportal\OsfrportalLaravel\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

use Osfrportal\OsfrportalLaravel\Models\SfrConfig;

use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;
use Osfrportal\OsfrportalLaravel\Services\SFRx509UkepService;
use Osfrportal\OsfrportalLaravel\Services\SFRx509UnepService;
//console commands
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRImapGetCommand;
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRInstallCommand;

use Osfrportal\OsfrportalLaravel\Console\Commands\SFRUnepGetAllCommand;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;


class OsfrportalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Date::use(CarbonImmutable::class);
        $this->registerConfigFromDB();
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/osfrportal'),
            ], 'osfrportal-views');
            $this->publishes([
                __DIR__ . '/../../public' => public_path('osfrportal'),
            ], 'osfrportal-public');



            $this->commands([
                SFRImapGetCommand::class,
                SFRInstallCommand::class,
                SFRUnepGetAllCommand::class,
                //::class,
                //::class,
                //::class,
                //::class,
                //::class,
            ]);


            $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
                $schedule->command('sfr:imapget')->dailyAt(config('osfrportal.shedule_ImapDailyTime', '00:01'));
                //$schedule->command('sfr:importpersons')->dailyAt(config('osfrportal.shedule.PersonsDailyTime', '00:03'));
                //$schedule->command('sfr:importmovements')->dailyAt(config('osfrportal.shedule.MovementsDailyTime', '00:04'));
                //$schedule->command('sfr:importdepartments)->dailyAt(config('osfrportal.shedule.DepartmentsDailyTime', '00:05'));
                //$schedule->command('sfr:importvacation')->dailyAt(config('osfrportal.shedule.VacationDailyTime', '00:06'));
                //$schedule->command('sfr:importdekret')->dailyAt(config('osfrportal.shedule.DekretDailyTime', '00:07'));
                $schedule->command('sfr:unepget')->dailyAt(config('osfrportal.shedule_HSMDailyTime', '00:10'));
            });
        }
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'osfrportal');

        //if (config('osfrportal.enabled', false)) {
        $this->registerRoutes();

        Route::aliasMiddleware('auth.osfrportal', '\Osfrportal\OsfrportalLaravel\Http\Middleware\Authenticate');
        //}

        foreach (glob(__DIR__ . '/../Support/Helpers/*.php') as $file) {
            require_once($file);
        }
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerInterfaces();
        $this->registerStorageConfig();

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
    }

    protected function registerInterfaces()
    {
        //Регистрируем обработчики интерфейсов
        $this->app->when(\Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUkepController::class)
            ->needs(SFRx509Interface::class)
            ->give(SFRx509UkepService::class);
        //->give(function () {
        //    return new SFRx509UkepService();
        //});

        $this->app->when(\Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUnepController::class)
            ->needs(SFRx509Interface::class)
            ->give(SFRx509UnepService::class);
        //->give(function () {
        //    return new SFRx509UnepService();
        //});
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

    protected function registerStorageConfig() {
        $filesystemsDisksConfig = [
            'docsfiles' => [
                'driver' => 'local',
                'root' => storage_path('app/docsfiles'),
                //'url' => '/storage/docs',
                'visibility' => 'public',
                'throw' => false,
            ],
            'imports' => [
                'driver' => 'local',
                'root' => storage_path('app/imports'),
                'visibility' => 'public',
                'throw' => false,
            ],
            'ftp1c' => [
                'driver' => 'ftp',
                'host' => config('osfrportal.ftp1c_host'),
                'username' => config('osfrportal.ftp1c_user'),
                'password' => config('osfrportal.ftp1c_password'),
                'passive' => config('osfrportal.ftp1c_passive'),
                'ssl' => config('osfrportal.ftp1c_ssl'),
            ],
        ];

        $filesystemsLinksConfig = [
            public_path('docsfiles') => storage_path('app/docsfiles'),
        ];
        config([
            'filesystems.disks' => array_merge($filesystemsDisksConfig, config('filesystems.disks', [])),
        ]);

        config([
            'filesystems.links' => array_merge($filesystemsLinksConfig, config('filesystems.links', [])),
        ]);

    }

    private function registerConfigFromDB()
    {
        config([
            'osfrportal' => SfrConfig::all([
                'key',
                'value',
                'crypted'
            ])
                ->keyBy('key') // key every setting by its name
                ->transform(function ($setting) {
                    return $setting->value; // return only the value
                })
                ->toArray() // make it an array
        ]);
        config([
            'mail.mailers.armgs' => [
                'transport' => 'smtp',
                'host' => config('osfrportal.smtp_host'),
                'port' => config('osfrportal.smtp_port'),
                'encryption' => config('osfrportal.smtp_encryption'),
                'username' => config('osfrportal.smtp_username'),
                'password' => config('osfrportal.smtp_password'),
            ]
        ]);
        config([
            'mail.from' => [
                'address' => config('osfrportal.smtp_from'),
                'name' => config('osfrportal.portal_name'),
            ]
        ]);
        config(['mail.default' => 'armgs']);
    }
}
