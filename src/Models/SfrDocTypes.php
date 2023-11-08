<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrDocTypes extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'sfrdoctypes';
    protected $primaryKey = 'typeid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'type_name',
        'type_data',
    ];
}