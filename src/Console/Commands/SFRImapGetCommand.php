<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRImapReaderController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SFRImapGetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:imapget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get CSV files exported from 1C PFR from IMAP mailbox';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new SFRImapReaderController)->put1CFilesToFTP();
        return 0;
    }
}
