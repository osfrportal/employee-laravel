<?php

namespace Osfrportal\OsfrportalLaravel\Services;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Osfrportal\OsfrportalLaravel\Models\SfrCerts;

use Osfrportal\OsfrportalLaravel\Data\SFRCertData;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;

class SFRx509UkepService implements SFRx509Interface
{
    private function connectSMB()
    {
        $storageSMB = Storage::build([
            'driver' => 'smb',
            'workgroup' => '0058PFRRU',
            //'host' => 'poib058nas.0058.pfr.ru',
            'host' => 'poib058jms.0058.pfr.ru',
            //'path' => 'OZI',
            'path' => 'test',
            'username' => 'ozi',
            'password' => '6t0VrJ9a',
            'timeout' => 50,
        ]);

        return $storageSMB;
    }

    public function getAllCertsFromStorage(): Collection
    {

        $filesystem = $this->connectSMB();
        $files = $filesystem->directories('/');
        dump($files);

        $collection_certs = collect();
        return $collection_certs;
    }
    public function parceCertToDTO(array $certdata)
    {
        return SFRCertData::from($certdata);
    }
    public function saveCertToDB(SFRCertData $certdata, string|null $pid)
    {
        $to_db = SfrCerts::updateOrCreate(
            [
                'certserial' => $certdata->serialNumber,
            ],
            [
                'certvalidfrom' => $certdata->notBefore,
                'certvalidto' => $certdata->notAfter,
                'certdata' => $certdata,
                'certtype' => CertsTypesEnum::UKEP(),
                'pid' => $pid,
            ]
        );
        return;
    }

    public function signXML(string $signdata, CertsTypesEnum $certtype, int|null $certid)
    {
        return;
    }
}
