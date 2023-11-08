<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

use Osfrportal\OsfrportalLaravel\Data\SFRCertData;

class SfrCerts extends Model
{
    use Uuid, SoftDeletes;

    protected $table = 'sfrcerts';
    protected $primaryKey = 'certuuid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $appends = ['revoked', 'revokedate'];

    protected $casts = [
        'certvalidfrom' => 'datetime:H:i:s d-m-Y',
        'certvalidto' => 'datetime:H:i:s d-m-Y',
        'certtype' => CertsTypesEnum::class,
        'certdata' => SFRCertData::class,
    ];

    protected $guarded = [];

    protected function certSerial(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::upper($value),
            get: fn(string $value) => Str::upper($value),
        );
    }

    public function isRevoked(): bool
    {
        $revoked = $this->hasOne(SfrCrls::class, 'revokeserial', 'certserial')->first();
        if (!is_null($revoked)) {
            return true;
        }
        return false;
    }

    public function getRevokedAttribute()
    {
        return $this->isRevoked();
    }
    public function getRevokeDateAttribute()
    {
        if ($this->isRevoked()) {
            $revoked = $this->hasOne(SfrCrls::class, 'revokeserial', 'certserial')->first();
            return $revoked->revokedate;
        }
    }

    public function SfrPerson()
    {
        return $this->hasOne(SfrPerson::class, 'pid', 'pid');
    }
}