<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrAddresses extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'paddresses';
    protected $primaryKey = 'addrid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}