<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Data\Orion\TEntryPointData;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrOrionEntryPoints extends Model
{
    use SoftDeletes;
    protected $table = 'orionentrypoints';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'tentrypointdata' => TEntryPointData::class,
    ];

    protected $fillable = [
        'entrypointid',
        'tentrypointdata',
    ];

    protected $guarded = [];

}