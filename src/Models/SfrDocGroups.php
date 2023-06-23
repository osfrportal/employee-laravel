<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrDocGroups extends Model
{
    use Uuid;
    protected $table = 'sfrdocgroups';
    protected $primaryKey = 'groupid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
}
