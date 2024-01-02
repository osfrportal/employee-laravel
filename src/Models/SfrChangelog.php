<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use \DateTimeInterface;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

use Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum;

class SfrChangelog extends Model
{
    use Uuid, SoftDeletes;

    protected $table = 'sfrchangelog';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $casts = [
        'cryptotype' => ChangelogTypesEnum::class,
    ];

    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d-m-Y');
    }
}
