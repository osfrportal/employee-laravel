<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrDocTypes extends Model
{
    use Uuid;
    protected $table = 'sfrdoctypes';
    protected $primaryKey = 'typeid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
}