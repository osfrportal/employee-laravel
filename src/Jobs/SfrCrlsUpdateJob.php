<?php

namespace Osfrportal\OsfrportalLaravel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Osfrportal\OsfrportalLaravel\Models\SfrCrls;

class SfrCrlsUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->onQueue('crls');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SfrCrls::updateOrCreate(
            ['revokeserial' => $this->data['revokeCertId']],
            ['revokedate' => $this->data['revokeDate']]
        );
    }

    public function middleware()
    {
        return [(new WithoutOverlapping($this->data['revokeCertId']))->expireAfter(180)];
    }
}
