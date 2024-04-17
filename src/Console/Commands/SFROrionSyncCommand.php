<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Http\Controllers\SFROrionController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SFROrionSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:orionsync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data from OrionPro SKUD';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SFROrionController $orionController): void
    {

        $this->output->title('Starting sync with Orion');

        $this->output->info('Starting entry points import');
        $orionController->syncEntryPointsToDB();
        $this->output->success('Import entry points successful');

        $this->output->info('Starting access levels import');
        $orionController->syncAccessLevelsToDB();
        $this->output->success('Import access levels successful');

        $this->output->info('Starting persons sync');
        $orionController->syncNewPersonsToOrion();
        $this->output->success('Create new persons into orion successful');
        $orionController->syncAllOrionPersonsToDB();
        $this->output->success('Import persons from orion successful');


    }
}
