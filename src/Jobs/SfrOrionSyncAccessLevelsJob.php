<?php

namespace Osfrportal\OsfrportalLaravel\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionAccessLevels;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelData;

class SfrOrionSyncAccessLevelsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $accessLevelData;

    /**
     * Create a new message instance.
     */
    public function __construct(TAccessLevelData $accessLevelData)
    {
        $this->accessLevelData = $accessLevelData;
        $this->onQueue('skud');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SfrOrionAccessLevels::updateOrCreate(
            ['levelid' => $this->accessLevelData->Id],
            ['taccessleveldata' => $this->accessLevelData]
        );
    }

    public function middleware()
    {
        return [(new WithoutOverlapping($this->accessLevelData->Id))->expireAfter(180)];
    }
}
