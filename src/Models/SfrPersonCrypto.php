<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

use Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;

class SfrPersonCrypto extends Model
{
    use Uuid, SoftDeletes;

    protected $table = 'sfrpersoncrypto';
    protected $primaryKey = 'cryptouuid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $casts = [
        //'cryptotype' => CryptoTypesEnum::class,
        'cryptodata' => SFRCryptoData::class,
    ];

    protected $guarded = [];

    public function SfrPerson()
    {
        return $this->hasOne(SfrPerson::class, 'pid', 'pid');
    }
}
