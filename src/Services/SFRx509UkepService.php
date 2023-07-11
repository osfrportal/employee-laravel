<?php

namespace Osfrportal\OsfrportalLaravel\Services;

use Illuminate\Support\Collection;
use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Osfrportal\OsfrportalLaravel\Data\SFRCertData;

use Osfrportal\OsfrportalLaravel\Models\SfrCerts;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;

class SFRx509UkepService implements SFRx509Interface
{

    public function getAllCertsFromStorage(): Collection
    {
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
