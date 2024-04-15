<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrEmployeeAD extends Model
{
    use SoftDeletes;
    protected $table = 'pemployeeaddata';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
}
