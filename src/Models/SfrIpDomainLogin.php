<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrIpDomainLogin extends Model
{
    use SoftDeletes;
    protected $table = 'sfripdomainlogin';
    protected $primaryKey = 'id';
    public $timestamps = true;

}
