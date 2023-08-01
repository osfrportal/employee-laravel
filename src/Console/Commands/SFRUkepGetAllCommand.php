<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUkepController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SFRUkepGetAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:ukepget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all UKEP certs from shared folder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SFRUkepController $controller)
    {
        $controller->getAllCertsToDB();
        return 0;
    }
}