<?php

namespace Osfrportal\OsfrportalLaravel\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Osfrportal\OsfrportalLaravel\Models\SfrPersOrion;
use Osfrportal\OsfrportalLaravel\Data\Orion\TPersonData;

class SfrOrionSyncPersonsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $personData;
    public $pid;
    public $orionPersonId;

    /**
     * Create a new message instance.
     */
    public function __construct(TPersonData $personData, int $orionPersonId, string|null $pid)
    {
        $this->personData = $personData;
        $this->pid = $pid;
        $this->orionPersonId = $orionPersonId;
        $this->onQueue('skud');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SfrPersOrion::updateOrCreate(
            ['orionpersid' => $this->orionPersonId],
            ['tpersondata' => $this->personData, 'pid' => $this->pid]
        );
    }

    public function middleware()
    {
        return [(new WithoutOverlapping($this->personData->Id))->expireAfter(180)];
    }
}
