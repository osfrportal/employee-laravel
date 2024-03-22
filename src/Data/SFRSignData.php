<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;


use phpseclib3\File\X509;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Carbon\Carbon;

class SFRSignData extends Data
{
    public function __construct(
        public ?string $signLabel = '',
        public ?string $signCertHash = '',
        public ?string $signCertCN = '',
        public ?string $signCertValidDates = '',
        public ?string $signDateTime = '',
        public ?string $signIssuerCN = '',
    ) {
    }

    public static function fromXML($sign): self
    {
        $xml = @simplexml_load_string(data: $sign->sign_data, options: LIBXML_NOCDATA);
        $x509 = new X509();
        if ($xml) {
            if (!is_null($xml->children('ds', true))) {
                $xmlSignatureKeyInfo = $xml->children('ds', true)->Signature->KeyInfo;
            }
            if (!is_null($xml->Signature->KeyInfo)) {
                $xmlSignatureKeyInfo = $xml->Signature->KeyInfo;
            }
            $cert_509 = $x509->loadX509($xmlSignatureKeyInfo->X509Data->X509Certificate);
            $cert_x509_DN = $x509->getDN(X509::DN_OPENSSL);
            $cert_x509_issuerDN = $x509->getIssuerDN(X509::DN_OPENSSL);
            $notBefore = new Carbon(Arr::get($cert_509, 'tbsCertificate.validity.notBefore.utcTime'));
            $notAfter = new Carbon(Arr::get($cert_509, 'tbsCertificate.validity.notAfter.utcTime'));
            $signCertValidDates = sprintf("с %s по %s", $notBefore->format('d.m.Y'), $notAfter->format('d.m.Y'));

            return new self(
                CertsTypesEnum::from($sign->sign_type)->label,
                Str::upper($cert_509['tbsCertificate']['serialNumber']->toHex()),
                Arr::get($cert_x509_DN, 'CN'),
                $signCertValidDates,
                $sign->created_at->format('d.m.Y H:i:s'),
                Arr::get($cert_x509_issuerDN, 'CN'),
            );
        } else {
            //dump($sign);
            return new self(
                null,
                null,
                null,
                null,
                null,
                null
            );
        }

    }
}