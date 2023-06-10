<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrEmployeeTabNum extends Model
{
    protected $table = 'pemployeetab';
    protected $fillable = [
        'etabnumber',
        'pid',
        'updated_at',
    ];
    protected $guarded = [];
}
