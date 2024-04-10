<?php

namespace Osfrportal\OsfrportalLaravel\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Carbon\CarbonImmutable;
use Livewire\Livewire;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;

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
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRUkepGetAllCommand;
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRCrlsLoadCommand;
use Osfrportal\OsfrportalLaravel\Console\Commands\SFROrionSyncCommand;
use Osfrportal\OsfrportalLaravel\Console\Commands\SFR1cImportCommand;
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRRcaImportCommand;
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRADOCSyncCommand;
use Osfrportal\OsfrportalLaravel\Console\Commands\SFRVipnetImportCommand;

//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;
//use Osfrportal\OsfrportalLaravel\Console\Commands\;


class OsfrportalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Date::use(CarbonImmutable::class);
        if (\Schema::hasTable('sfrconfig')) {
            $this->registerConfigFromDB();
            $this->registerStorageConfig();
            //$this->registerADConfig();
            $this->registerMSSQLDatabases();
        }
        Gate::after(function ($user, $ability) {
            return $user->hasRole('SuperAdmin'); // note this returns boolean
        });
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
                SFRUkepGetAllCommand::class,
                SFRCrlsLoadCommand::class,
                SFROrionSyncCommand::class,
                SFR1cImportCommand::class,
                SFRRcaImportCommand::class,
                SFRADOCSyncCommand::class,
                SFRVipnetImportCommand::class,
                //::class,
            ]);


            $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
                $schedule->command('queue:prune-batches')->daily();
                $schedule->command('sfr:adocsync')->dailyAt('10:30');
                $schedule->command('sfr:syncrca')->everyTenMinutes()->between('7:00', '17:30');
                $schedule->command('sfr:imapget')->everyTenMinutes()->between('8:30', '17:30');
                $schedule->command('sfr:sync1c')->dailyAt(config('osfrportal.shedule_Sync1CDailyTime', '00:10'));
                $schedule->command('sfr:unepget')->dailyAt(config('osfrportal.shedule_HSMDailyTime', '00:50'));
                $schedule->command('sfr:ukepget')->dailyAt(config('osfrportal.shedule_UKEPDailyTime', '01:20'));
                $schedule->command('sfr:orionsync')->dailyAt(config('osfrportal.shedule_SKUDDailyTime', '02:10'));
                $schedule->command('sfr:crlsload')->weeklyOn(7, config('osfrportal.shedule_CRLWeeklyTime', '02:10'));
            });
        }
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'osfrportal');

        //if (config('osfrportal.enabled', false)) {
        $this->registerRoutes();
        Route::pushMiddlewareToGroup('web', '\Osfrportal\OsfrportalLaravel\Http\Middleware\LogUserActivity');

        Route::aliasMiddleware('auth.osfrportal', '\Osfrportal\OsfrportalLaravel\Http\Middleware\Authenticate');

        //}

        foreach (glob(__DIR__ . '/../Support/Helpers/*.php') as $file) {
            require_once ($file);
        }
        $this->registerLiwevireComponents();
        $this->registerBladeDirectives();
        //шаблон paginator по умолчанию на bootstrap-5
        Paginator::useBootstrapFive();
        //отключить обертывание самого верхнего ресурса
        //https://laravel.su/docs/8.x/eloquent-resources
        JsonResource::withoutWrapping();

    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->register('\Osfrportal\OsfrportalLaravel\Providers\OsfrportalServiceProvider');
        $this->registerInterfaces();


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
        $this->registerLogToDBoptions();
        $this->registerBreadCrumbsConfig();
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('docsfileurl', function ($expression) {
            return "<?php echo Storage::disk('docsfiles')->url($expression); ?>";
        });
    }
    protected function registerLiwevireComponents()
    {
        config([
            'livewire.temporary_file_upload.rules' => ['required', 'file', 'max:100000']
        ]);
        //Livewire::component('packagename::counter', YourPackage/Counter::class);
        Livewire::component('osfrportal::liveusers-count', \Osfrportal\OsfrportalLaravel\Livewire\Admin\LiveUsers::class);
        Livewire::component('osfrportal::mainterance-messages', \Osfrportal\OsfrportalLaravel\Livewire\Admin\RedisSubscribeMainterance::class);


        Livewire::component('osfrportal::docsnotsigned-count', \Osfrportal\OsfrportalLaravel\Livewire\DocsNotSigned::class);
        Livewire::component('osfrportal::uploaddocsfiles', \Osfrportal\OsfrportalLaravel\Livewire\Admin\UploadDocsFiles::class);
        Livewire::component('osfrportal::notifications-count', \Osfrportal\OsfrportalLaravel\Livewire\NotificationsCount::class);
        Livewire::component('osfrportal::notifications-list', \Osfrportal\OsfrportalLaravel\Livewire\NotificationsList::class);
        Livewire::component('osfrportal::leftmenuLinks', \Osfrportal\OsfrportalLaravel\Livewire\LinksLeftMenu::class);
        Livewire::component('osfrportal::mainPageLinks', \Osfrportal\OsfrportalLaravel\Livewire\LinksMainPage::class);
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
            'middleware' => 'web',
            'namespace' => 'Osfrportal\OsfrportalLaravel\Http\Controllers',
            'as' => 'osfrportalip.',
            'domain' => 'ip.0058.pfr.ru',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/osfrportal_ip.php');
        })->middleware('web');

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
    protected function registerBreadCrumbsConfig()
    {
        $breadcrumbsConfig = [
            'unnamed-route-exception' => false,
            'missing-route-bound-breadcrumb-exception' => false,
            'invalid-named-breadcrumb-exception' => false,
            'files' => __DIR__ . '/../../routes/osfrportal_breadcrumbs.php',
            'view' => 'osfrportal::layout.breadcrumbs.breadcrumbs',
        ];
        config([
            'breadcrumbs' => array_merge($breadcrumbsConfig, config('breadcrumbs', [])),
        ]);
    }
    protected function registerADConfig()
    {
        $sfrad = [
            'hosts' => [config('osfrportal.ldap_host')],
            'username' => config('osfrportal.ldap_username'),
            'password' => config('osfrportal.ldap_password'),
            'port' => (int) config('osfrportal.ldap_port'),
            'base_dn' => config('osfrportal.ldap_basedn'),
            'timeout' => config('osfrportal.ldap_timeout'),
            'use_ssl' => false,
            'use_tls' => (bool) config('osfrportal.ldap_tls'),
            'use_sasl' => false,
            'sasl_options' => [],
        ];
        //$fssad = [];
        //$adConnections = ['sfrAD' => $sfrad, 'fssAD' => $fssad];
        $adConnections = ['sfrAD' => $sfrad];
        /*
        config([
            'ldap.connections' => $adConnections,
        ]);

        config([
            'ldap.default' => 'sfrAD',
        ]);
        */
    }
    protected function registerStorageConfig()
    {
        $filesystemsDisksConfig = [
            'docsfiles' => [
                'driver' => 'local',
                'root' => storage_path('app/docsfiles'),
                'url' => '/docsfiles',
                'visibility' => 'public',
                'throw' => false,
            ],
            'imports' => [
                'driver' => 'local',
                'root' => storage_path('app/imports'),
                'visibility' => 'public',
                'throw' => false,
            ],
            'crls' => [
                'driver' => 'local',
                'root' => storage_path('app/crls'),
                'visibility' => 'public',
                'throw' => false,
            ],
            'ftp1c' => [
                'driver' => 'ftp',
                'host' => config('osfrportal.ftp1c_host'),
                'username' => config('osfrportal.ftp1c_user'),
                'password' => config('osfrportal.ftp1c_password'),
                'passive' => (bool) config('osfrportal.ftp1c_passive'),
                'ssl' => (bool) config('osfrportal.ftp1c_ssl'),
            ],
            'UKEPcerts' => [
                'driver' => 'local',
                'root' => config('osfrportal.ukep_folder'),
                'read-only' => true,
                'throw' => false,
            ],
            'RCAimportRO' => [
                'driver' => 'local',
                'root' => '/mnt/rca',
                'read-only' => true,
                'throw' => false,
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
        config(['queue.default' => 'redis']);
        config(['database.redis.client' => 'predis']);
    }

    private function registerMSSQLDatabases()
    {
        $mssqlDatabases = [
            'ADOCsqlsrv' => [
                'driver' => 'sqlsrv',
                'url' => env('ADOC_DATABASE_URL'),
                'host' => env('ADOC_DB_HOST', 'localhost'),
                'port' => env('ADOC_DB_PORT', '1433'),
                'database' => env('ADOC_DB_DATABASE', 'forge'),
                'username' => env('ADOC_DB_USERNAME', 'forge'),
                'password' => env('ADOC_DB_PASSWORD', ''),
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'trust_server_certificate' => env('ADOC_DB_TRUST_SERVER_CERTIFICATE', 'false'),
            ],
            'otrspgsql' => [
                'driver' => 'pgsql',
                'host' => env('OTRS_DB_HOST', 'localhost'),
                'port' => env('OTRS_DB_PORT', '5432'),
                'database' => env('OTRS_DB_DATABASE', 'forge'),
                'username' => env('OTRS_DB_USERNAME', 'forge'),
                'password' => env('OTRS_DB_PASSWORD', ''),
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
            ],
        ];

        config([
            'database.connections' => array_merge($mssqlDatabases, config('database.connections', [])),
        ]);
    }

    private function registerLogToDBoptions()
    {
        $optionsLogToDB = [
            'connection' => 'pgsql',
            'collection' => 'sfrlogs',
            'detailed' => true,
            'model' => false,
            'queue' => true,
            'queue_name' => 'logs',
            'queue_connection' => 'redis',
            'max_records' => false,
            'max_hours' => false,
            'datetime_format' => 'Y-m-d H:i:s:ms',
        ];
        config([
            'logtodb' => array_merge($optionsLogToDB, config('logtodb', [])),
        ]);

        $optionsLoggingChannel = [
            'sfrlogs' => [
                'driver' => 'custom',
                'via' => \danielme85\LaravelLogToDB\LogToDbHandler::class,
                'name' => 'Basic DB Logging',
                'processors' => [
                    \Monolog\Processor\WebProcessor::class,
                    \Osfrportal\OsfrportalLaravel\LogsProcessorsCustom\AuthenticatedUserProcessor::class,
                ],
            ],
        ];
        config([
            'logging.channels' => array_merge($optionsLoggingChannel, config('logging.channels', [])),
        ]);
        $optionsLoggingStack = [
            'single',
            'sfrlogs',
        ];
        config([
            'logging.channels.stack.channels' => $optionsLoggingStack,
        ]);
    }
}
