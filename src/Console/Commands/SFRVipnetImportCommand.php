<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Imports\SFRVipnetCUSImportXML;
use Illuminate\Console\Command;

class SFRVipnetImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:syncvipnet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import XML file with network structure from VipNet CUS';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $this->output->title('Starting import from VipNet CUS');

        /**
         * Import persons
         */
        $this->output->info('Starting import');
        (new SFRVipnetCUSImportXML)->import('442_network_report_202312171140.xml', 'imports');
        $this->output->success('Import successful');
    }
}
