<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRRcaImportController;
use Illuminate\Console\Command;

class SFRRcaImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:syncrca';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import XML files exported from 1C PFR to RCA';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SFRRcaImportController $SfrRcaImportController): void
    {
        $this->output->title('Starting import from RCA files');

        /**
         * Import persons
         */
        $this->output->info('Starting RCA files import');
        $SfrRcaImportController->runRcaFilesGet();
        $this->output->success('Import RCA files end');
    }
}
