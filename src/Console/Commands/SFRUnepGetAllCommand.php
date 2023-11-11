<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUnepController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SFRUnepGetAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:unepget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all certs from VipNet HSM';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SFRUnepController $controller)
    {
        //$controller = App::make(SFRUnepController::class);
        $controller->getAllCertsToDB();
        return 0;
    }
}
