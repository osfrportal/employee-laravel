<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;


class SfrLogsPCAuth extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'logspcauth';
    protected $primaryKey = 'lpcid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected function domainLogin(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::lower($value),
            get: fn(string $value) => Str::lower($value),
        );
    }
}