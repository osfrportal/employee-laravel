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
    ) {
    }

    public static function fromXML($sign): self
    {
        $xml = @simplexml_load_string(data: $sign->sign_data, options: LIBXML_NOCDATA);
        $x509 = new X509();
        $cert_509 = $x509->loadX509($xml->Signature->KeyInfo->X509Data->X509Certificate);
        $cert_x509_DN = $x509->getDN(X509::DN_OPENSSL);
        $notBefore = new Carbon(Arr::get($cert_509, 'tbsCertificate.validity.notBefore.utcTime'));
        $notAfter = new Carbon(Arr::get($cert_509, 'tbsCertificate.validity.notAfter.utcTime'));
        $signCertValidDates = sprintf("с %s по %s", $notBefore->format('d.m.Y'), $notAfter->format('d.m.Y'));

        return new self(
            CertsTypesEnum::from($sign->sign_type)->label,
            Str::upper($cert_509['tbsCertificate']['serialNumber']->toHex()),
            Arr::get($cert_x509_DN, 'CN'),
            $signCertValidDates,
            $sign->created_at->format('d.m.Y H:i:s'),
        );

    }
}