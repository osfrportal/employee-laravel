<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrAddresses extends Model
{
    use Uuid;
    protected $table = 'paddresses';
    protected $primaryKey = 'addrid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
