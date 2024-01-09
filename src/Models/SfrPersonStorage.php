<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrPersonStorage extends Model
{
    use SoftDeletes;
    protected $table = 'sfrpersonstorage';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
