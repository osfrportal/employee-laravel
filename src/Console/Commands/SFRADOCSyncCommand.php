<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRSyncToADOCController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SFRADOCSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:adocsync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data to ADOC';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SFRSyncToADOCController $adocController): void
    {
        $this->output->title('Starting sync to ADOC');
        $adocController->synctoadoc(true);
        $this->output->info('Sync to ADOC ended');
    }
}
