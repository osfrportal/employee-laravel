<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrEmpUnit extends Model
{
    use SoftDeletes;
    protected $table = 'pempunit';
    protected $primaryKey = 'id';
    public $timestamps = true;
}