<?php

namespace Osfrportal\OsfrportalLaravel\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionEntryPoints;
use Osfrportal\OsfrportalLaravel\Data\Orion\TEntryPointData;

class SfrOrionSyncEntryPointsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $entryPointData;

    /**
     * Create a new message instance.
     */
    public function __construct(TEntryPointData $entryPointData)
    {
        $this->entryPointData = $entryPointData;
        $this->onQueue('skud');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SfrOrionEntryPoints::updateOrCreate(
            ['entrypointid' => $this->entryPointData->Id],
            ['tentrypointdata' => $this->entryPointData]
        );
    }

    public function middleware()
    {
        return [(new WithoutOverlapping($this->entryPointData->Id))->expireAfter(180)];
    }
}
