<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrAppointment extends Model
{
    protected $table = 'pempunit';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
