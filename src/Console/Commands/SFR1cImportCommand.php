<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Http\Controllers\SFR1cImportController;
use Illuminate\Console\Command;

class SFR1cImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:sync1c';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CSV files exported from 1C PFR';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SFR1cImportController $Sfr1cImportController): void
    {
        $this->output->title('Starting import from 1C');

        /**
         * Import persons
         */
        $this->output->info('Starting persons import');
        $Sfr1cImportController->SFRPersonsImportFromCSV(true);
        $this->output->success('Import persons successful');
        /**
         * Import persons movements
         */
        $this->output->info('Starting persons movements import');
        //$Sfr1cImportController->SFRPersonsMovementsImportFromCSV(true);
        $this->output->success('Import persons movements successful');
        /**
         * Import departments
         */
        $this->output->info('Starting persons departments import');
        $Sfr1cImportController->SFRDepatmentsImportFromCSV(true);
        $this->output->success('Import persons departments successful');
        /**
         * Import vacation
         */
        $this->output->info('Starting vacation import');
        $Sfr1cImportController->SFRVacationsImportFromCSV(true);
        $this->output->success('Import vacation successful');
        /**
         * Import dekret
         */
        $this->output->info('Starting dekret import');
        $Sfr1cImportController->SFRDekretImportFromCSV(true);
        $this->output->success('Import dekret successful');
        /**
         * Import absence
         */
        $this->output->info('Starting absence import');
        $Sfr1cImportController->SFRAbsenceImportFromCSV(true);
        $this->output->success('Import absence successful');
    }
}
