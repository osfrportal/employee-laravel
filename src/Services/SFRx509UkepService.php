<?php

namespace Osfrportal\OsfrportalLaravel\Services;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Osfrportal\OsfrportalLaravel\Models\SfrCerts;

use Osfrportal\OsfrportalLaravel\Data\SFRCertData;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Osfrportal\OsfrportalLaravel\Interfaces\SFRx509Interface;

use phpseclib3\File\X509;
use Carbon\CarbonImmutable;


class SFRx509UkepService implements SFRx509Interface
{
    private function connectSMB()
    {
        $storageSMB = Storage::disk('UKEPcerts');

        return $storageSMB;
    }

    public function getAllCertsFromStorage(): Collection
    {
        Log::info('UKEP: загрузка сертификатов из хранилища');
        $collection_certs = collect();

        $x509 = new X509();

        $filesystem = $this->connectSMB();
        $files = $filesystem->allFiles('.');

        foreach ($files as $certfile) {
            $cert_509 = $x509->loadX509($filesystem->get($certfile));

            if ($cert_509 !== false) {
                $cert_x509_DN = $x509->getDN(X509::DN_OPENSSL);
                $cert_x509_issuerDN = $x509->getIssuerDN(X509::DN_OPENSSL);


                $certdata_arr = [
                    'notBefore' => new CarbonImmutable($cert_509['tbsCertificate']['validity']['notBefore']['utcTime']),
                    'notAfter' => new CarbonImmutable($cert_509['tbsCertificate']['validity']['notAfter']['utcTime']),
                    'commonName' => Arr::get($cert_x509_DN, 'CN'),
                    'serialNumber' => Str::upper($cert_509['tbsCertificate']['serialNumber']->toHex()),
                    'Inn' => Arr::get($cert_x509_DN, '1.2.643.3.131.1.1'),
                    'Snils' => Arr::get($cert_x509_DN, '1.2.643.100.3'),
                    'Email' => Arr::get($cert_x509_DN, 'emailAddress'),
                    'countryName' => Arr::get($cert_x509_DN, 'C'),
                    'stateOrProvinceName' => Arr::get($cert_x509_DN, 'ST'),
                    'organizationName' => Arr::get($cert_x509_DN, 'O'),
                    'givenName' => Arr::get($cert_x509_DN, 'givenName'),
                    'surname' => Arr::get($cert_x509_DN, 'SN'),
                    'iss_INN' => Arr::get($cert_x509_issuerDN, '1.2.643.100.4'),
                    'iss_OGRN' => Arr::get($cert_x509_issuerDN, '1.2.643.100.1'),
                    'iss_Email' => Arr::get($cert_x509_issuerDN, 'emailAddress'),
                    'iss_countryName' => Arr::get($cert_x509_issuerDN, 'C'),
                    'iss_stateOrProvinceName' => Arr::get($cert_x509_issuerDN, 'ST'),
                    'iss_organizationName' => Arr::get($cert_x509_issuerDN, 'O'),
                    'iss_streetAddress' => Arr::get($cert_x509_issuerDN, 'streetAddress'),
                    'iss_localityName' => Arr::get($cert_x509_issuerDN, 'L'),
                    'iss_commonName' => Arr::get($cert_x509_issuerDN, 'CN'),
                ];
                $collection_certs->push($certdata_arr);
            }
        }


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
        Log::info('UKEP: сертификат сохранен в базе', [
            'certserial' => $certdata->serialNumber,
            'certvalidfrom' => $certdata->notBefore,
            'certvalidto' => $certdata->notAfter,
            'certtype' => CertsTypesEnum::UKEP(),
            'pid' => $pid,
        ]);
        return;
    }

    public function signXML(string $signdata, CertsTypesEnum $certtype, int|null $certid)
    {
        return;
    }
    public function checkSignXML(string $signedData)
    {
        return;
    }

    public function gostHashFile(string $filename)
    {
        return;
    }

    public function gostCheckHashFile(string $filename, string $gostHash)
    {
        return;
    }
}