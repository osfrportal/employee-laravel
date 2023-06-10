<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrAppointment extends Model
{
    use Uuid;

    protected $table = 'pappointment';
    protected $primaryKey = 'aid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'aname',
    ];
}
