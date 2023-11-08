<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrEmployeeTabNum extends Model
{
    use SoftDeletes;

    protected $table = 'pemployeetab';
    protected $fillable = [
        'etabnumber',
        'pid',
        'updated_at',
    ];
    protected $guarded = [];
}