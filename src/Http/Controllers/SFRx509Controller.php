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
use Illuminate\Support\Facades\Process;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Spatie\ResponseCache\Facades\ResponseCache;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrCerts;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Osfrportal\OsfrportalLaravel\Data\SFRCertData;

use phpseclib3\File\X509;

use Osfrportal\OsfrportalLaravel\Models\SfrCrls;
use Osfrportal\OsfrportalLaravel\Jobs\SfrCrlsUpdateJob;

class SFRx509Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('doNotCacheResponse');
        set_time_limit(0);
    }

    public function parceX509certs()
    {
        //phpinfo();
/*
        $crlFilesList = [
            '165591A65158C4892C6B515BD285190A01444822.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            '1D8026D28962E704818F1E4AE8AB7292762DDD3D.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            '29BCAFE2A52A511CF2681B677327A19D4573F415.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            '5530F10C9C7743B224DC06592D5C01B671D46436.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            'A70B95286F9FE44B8A5180B2851F894AFCE7F09C.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            'C0D6D60A7D6B7EC98E39BCDA89FAAF942C585A8D.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            'D064966D7240EB587D247FBB205BCFC38E6C7AD4.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
        ];
        foreach ($crlFilesList as $crlFileName => $crlUrl) {
            $crlFullURL = sprintf("%s/%s",$crlUrl, $crlFileName);
            $response = Http::get($crlFullURL);
            if ($response->successful()) {
                $crlBody = $response->body();
                Storage::disk('crls')->put($crlFileName, $crlBody);
            }
        }
        $crlFilesList = Storage::disk('crls')->files();
        foreach ($crlFilesList as $crlFileName) {
            $crlFilePath  = Storage::disk('crls')->path($crlFileName);
            //dump($crlFilePath);
            set_time_limit(0);
            $opensslCrlLoadTextCommand = sprintf("openssl crl -noout -text -inform der -in %s 2>&1", $crlFilePath);
            $result = Process::run($opensslCrlLoadTextCommand);
            $crl_text = $result->output();
            if (!Str::contains($crl_text, 'No Revoked Certificates', true)) {
                //$crl_info = explode("Revoked Certificates:", $crl_text)[0];
                $crl_certificates = explode("Revoked Certificates:", $crl_text)[1];
                $crl_certificates = explode("Serial Number:", $crl_certificates);
                foreach ($crl_certificates as $key => $revoked_certificate) {
                    if (!empty($revoked_certificate) && $revoked_certificate[0] !== "\n") {
                        $revokeCertId = str_replace(" ", "", explode("\n", $revoked_certificate)[0]);
                        $revokeDate = str_replace("        Revocation Date: ", "", explode("\n", $revoked_certificate)[1]);
                        $jobData = [
                            'revokeCertId' => $revokeCertId,
                            'revokeDate' => $revokeDate,
                        ];
                        SfrCrlsUpdateJob::dispatch($jobData);
                        //$revcert[$revokeCertId] = $revokeDate;
                    }
                }
            } else {
                $strMessage = sprintf("No certs in crl file %s", $crlFileName);
                dump($strMessage);
            }
            Storage::disk('crls')->delete($crlFileName);
        }
        //dump($revcert);
        dump('done');
*/
        dump('None');
/*
        $x509crl = new X509();
        $crl3 = $x509crl->loadCRL(Storage::get('ucfk_2023.x509_2'));
        //$crl2 = $x509crl->loadCRL(Storage::get('ucfk_2023.x509_2'));
        $crl2 = "";
        dump([$crl3, $crl2]);

        //$cert = Storage::get('Опарина Светлана Юрьевна.cer');
        $cert = Storage::disk('UKEPcerts')->get('ГОСУДАРСТВЕННОЕ УЧРЕЖДЕНИЕ - ОТДЕЛЕНИЕ ПЕНСИОННОГО ФОНДА РОССИЙСКОЙ ФЕДЕРАЦИИ ПО ЛИПЕЦКОЙ ОБЛАСТИ (3).cer');
        $x509 = new X509();


        $cert_509 = $x509->loadX509($cert);
        $cert_x509_DN = $x509->getDN(X509::DN_OPENSSL);
        $cert_x509_issuerDN = $x509->getIssuerDN(X509::DN_OPENSSL);

        //dump($cert_509);
        //dump($x509->validateSignature(false));

        $person = SfrPerson::where('psnils', Arr::get($cert_x509_DN, '1.2.643.100.3'))->firstOr(function () {
            $person['pid'] = null;
        });
        $certdata_arr = [
            'notBefore' => new CarbonImmutable($cert_509['tbsCertificate']['validity']['notBefore']['utcTime']),
            'notAfter' => new CarbonImmutable($cert_509['tbsCertificate']['validity']['notAfter']['utcTime']),
            'commonName' => Arr::get($cert_x509_DN, 'CN'),
            'serialNumber' => Str::upper($cert_509['tbsCertificate']['serialNumber']->toHex()),
            'Inn' => Arr::get($cert_x509_DN, '1.2.643.3.131.1.1'),
            'Innle' => Arr::get($cert_x509_DN, '1.2.643.100.4'),
            'Ogrn' => Arr::get($cert_x509_DN, '1.2.643.100.1'),
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
*/
    }
}
