<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

use Osfrportal\OsfrportalLaravel\Enums\StorageCategoryTypesEnum;
use Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum;
use Osfrportal\OsfrportalLaravel\Models\SfrStorageJounalCheck;

use Carbon\Carbon;


class SfrStorage extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'sfrstorage';
    protected $primaryKey = 'storuuid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $guarded = [];

    protected $casts = [
        'stortype' => StorageTypesEnum::class,
        'stormark' => StorageCategoryTypesEnum::class,
    ];

    protected $appends = [
        'storage_date',
    ];

    //protected $with = ['person', 'journalcheck'];

    public function getStorageDateAttribute()
    {
        return Carbon::parse($this->stordate)->format('d.m.Y');
    }

    public function person()
    {
        return $this->belongsToMany(SfrPerson::class, 'sfrpersonstorage', 'storuuid', 'pid')->select(['ppersons.pid AS personid', 'pname', 'pmiddlename', 'psurname'])->using(SfrPersonStorage::class)->withTimestamps();
    }
    public function journalcheck()
    {
        return $this->hasMany(SfrStorageJounalCheck::class, 'storuuid', 'storuuid')->withTimestamps();
    }
}
