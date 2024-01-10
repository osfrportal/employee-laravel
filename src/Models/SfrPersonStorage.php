<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SfrPersonStorage extends Pivot
{
    use SoftDeletes;
    protected $table = 'sfrpersonstorage';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
