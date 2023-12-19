<?php

namespace Osfrportal\OsfrportalLaravel\Data\Crypto;


use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonCrypto;

class SFRCryptoData extends Data
{
    public function __construct(
        public int|CryptoTypesEnum $cryptoType,
        public ?string $cryptoId = null,
        public ?string $cryptoName = null,
        public ?string $cryptoUserName = null,
        public ?string $cryptoPurpose = null,
        public ?string $wsId = null,
        public ?string $cryptoLicenseNumber = null,
        public ?string $pid,
    ) {}

    public static function defValues(): SFRCryptoData
    {
        return new self(
            CryptoTypesEnum::NONE(),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
        );
    }

    public static function getFull(SfrPersonCrypto $crypto): self
    {
        $pid = null;
        if (!is_null($crypto->SfrPerson)) {
            $pid = $crypto->SfrPerson->getPid();
        }
        return new self(
            new CryptoTypesEnum($crypto->cryptodata->cryptoType),
            $crypto->cryptodata->cryptoId,
            $crypto->cryptodata->cryptoName,
            $crypto->cryptodata->cryptoUserName,
            $crypto->cryptodata->cryptoPurpose,
            $crypto->cryptodata->wsId,
            $crypto->cryptodata->cryptoLicenseNumber,
            $pid,
        );
    }

}
