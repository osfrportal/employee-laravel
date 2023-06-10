<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrEmpApp extends Model
{
    protected $table = 'pempapp';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
