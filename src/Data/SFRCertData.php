<?php

namespace Osfrportal\OsfrportalLaravel\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;

use Carbon\CarbonImmutable;

class SFRCertData extends Data
{
    public function __construct(
    #[MapInputName('not_before')] public ?CarbonImmutable $notBefore, #[MapInputName('not_after')] public ?CarbonImmutable $notAfter, #[MapInputName('commonName')] public ?string $commonName = null, #[MapInputName('ser_num')] public ?string $serialNumber = null, #[MapInputName('cert_id')] public ?int $certId = null, public ?string $keyType = null, #[MapInputName('INN')] public ?string $Inn = null, #[MapInputName('INNLE')] public ?string $Innle = null, #[MapInputName('OGRN')] public ?string $Ogrn = null, #[MapInputName('SNILS')] public ?string $Snils = null, #[MapInputName('E_mail')] public ?string $Email = null, #[MapInputName('countryName')] public ?string $countryName = null, #[MapInputName('stateOrProvinceName')] public ?string $stateOrProvinceName = null, #[MapInputName('organizationName')] public ?string $organizationName = null, #[MapInputName('givenName')] public ?string $givenName = null, #[MapInputName('surname')] public ?string $surname = null, #[MapInputName('iss_INN')] public ?string $iss_INN = null, #[MapInputName('iss_OGRN')] public ?string $iss_OGRN = null, #[MapInputName('iss_E_mail')] public ?string $iss_Email = null, #[MapInputName('iss_countryName')] public ?string $iss_countryName = null, #[MapInputName('iss_stateOrProvinceName')] public ?string $iss_stateOrProvinceName = null, #[MapInputName('iss_organizationName')] public ?string $iss_organizationName = null, #[MapInputName('iss_streetAddress')] public ?string $iss_streetAddress = null, #[MapInputName('iss_localityName')] public ?string $iss_localityName = null, #[MapInputName('iss_commonName')] public ?string $iss_commonName = null, )
    {
    }
    public static function defValues(): SFRCertData
    {
        return new self(
            notBefore: null,
            notAfter: null,
            commonName: null,
            serialNumber: null,
            certId: null,
            keyType: null,
            Inn: null,
            Innle: null,
            Ogrn: null,
            Snils: null,
            Email: null,
            countryName: null,
            stateOrProvinceName: null,
            organizationName: null,
            givenName: null,
            surname: null,
            iss_INN: null,
            iss_OGRN: null,
            iss_Email: null,
            iss_countryName: null,
            iss_stateOrProvinceName: null,
            iss_organizationName: null,
            iss_streetAddress: null,
            iss_localityName: null,
            iss_commonName: null
        );
    }
}
