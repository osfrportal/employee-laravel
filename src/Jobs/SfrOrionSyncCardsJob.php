<?php

namespace Osfrportal\OsfrportalLaravel\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionCards;
use Osfrportal\OsfrportalLaravel\Data\Orion\TKeyData;

class SfrOrionSyncCardsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $keyData;
    public $orionPersId;
    public $keyId;
    public $accessLevelId;

    /**
     * Create a new message instance.
     */
    public function __construct(TKeyData $keyData, int|null $orionPersId, int|null $keyId, int|null $accessLevelId)
    {
        $this->keyData = $keyData;
        $this->orionPersId = $orionPersId;
        $this->keyId = $keyId;
        $this->accessLevelId = $accessLevelId;
        $this->onQueue('skud');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SfrOrionCards::updateOrCreate(
            ['keyid' => $this->keyId],
            ['tkeydata' => $this->keyData, 'orionpersid' => $this->orionPersId, 'accesslevelid' => $this->accessLevelId]
        );
    }

    public function middleware()
    {
        return [(new WithoutOverlapping($this->keyId))->expireAfter(180)];
    }
}
