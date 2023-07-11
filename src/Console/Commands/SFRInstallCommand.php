<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRInstallController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SFRInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install package osfrportal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new SFRInstallController)->install();
        return 0;
    }
}
