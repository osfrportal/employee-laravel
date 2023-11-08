<?php

namespace Osfrportal\OsfrportalLaravel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;

use Osfrportal\OsfrportalLaravel\Models\SfrCerts;
use Osfrportal\OsfrportalLaravel\Data\SFRCertData;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;

use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

class SfrSaveCertToDBJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $certdata;
    public $pid;
    public $certtype;

    /**
     * Create a new message instance.
     */
    public function __construct(SFRCertData $certdata, string|null $pid, CertsTypesEnum $certtype)
    {
        $this->certdata = $certdata;
        $this->pid = $pid;
        $this->certtype = $certtype;
        $this->onQueue('certs');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $result = SfrCerts::updateOrCreate(
            [
                'certserial' => $this->certdata->serialNumber,
            ],
            [
                'certvalidfrom' => $this->certdata->notBefore,
                'certvalidto' => $this->certdata->notAfter,
                'certdata' => $this->certdata,
                'certtype' => $this->certtype,
                'pid' => $this->pid,
            ]
        );
        if ($result->wasRecentlyCreated) {
            Log::withContext([
                'action' => LogActionsEnum::LOG_SYNC_CERTS(),
                'pid' => $this->pid,
                'certtype' => $this->certtype,
            ]);
            Log::info('CERTS: сертификат добавлен в базу', [
                'certserial' => $this->certdata->serialNumber,
                'certvalidfrom' => $this->certdata->notBefore,
                'certvalidto' => $this->certdata->notAfter,
            ]);
        }
    }

    public function middleware()
    {
        return [(new WithoutOverlapping($this->certdata->serialNumber))->expireAfter(580)];
    }
}