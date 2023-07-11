<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Spatie\ResponseCache\Facades\ResponseCache;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrCerts;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Osfrportal\OsfrportalLaravel\Data\SFRCertData;

use phpseclib3\File\X509;


class SFRx509Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('doNotCacheResponse');
    }

    public function parceX509certs()
    {

        $cert = Storage::get('Опарина Светлана Юрьевна.cer');
        $x509 = new X509();

        $cert_509 = $x509->loadX509($cert);
        $cert_x509_DN = $x509->getDN(X509::DN_OPENSSL);
        $cert_x509_issuerDN = $x509->getIssuerDN(X509::DN_OPENSSL);

        //dump($cert_509);


        $person = SfrPerson::where('psnils', Arr::get($cert_x509_DN, '1.2.643.100.3'))->firstOr(function () {
            $person['pid'] = null;
        });

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
        $certdata = SFRCertData::from($certdata_arr);
        dump($certdata);

        $to_db = SfrCerts::updateOrCreate(
            [
                'certserial' => Str::upper($cert_509['tbsCertificate']['serialNumber']->toHex()),
            ],
            [
                'certvalidfrom' => $cert_509['tbsCertificate']['validity']['notBefore']['utcTime'],
                'certvalidto' => $cert_509['tbsCertificate']['validity']['notAfter']['utcTime'],
                'certdata' => $certdata,
                'certtype' => CertsTypesEnum::UKEP(),
                'pid' => $person['pid'],
            ]
        );

        //-------------------------------------------------------------------------------------------
        $x509_crl = new X509();
        $crl = $x509_crl->loadCRL(Storage::get('ucfk_2023.x509'));
        $crl_list_date = $crl['tbsCertList']['thisUpdate']['utcTime'];
        $crl_list_date_next = $crl['tbsCertList']['nextUpdate']['utcTime'];
        $crl_list_certs = $crl['tbsCertList']['revokedCertificates'];
        //dump($crl_list_date);
        //dump($crl_list_date_next);
        //dump($crl_list_certs[1000]);
        //dump($crl);
        //-------------------------------------------------------------------------------------------
    }
}
