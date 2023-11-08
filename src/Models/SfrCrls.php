<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class SfrCrls extends Model
{
    protected $table = 'crls';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'revokeserial',
        'revokedate'
    ];
    protected $guarded = [];

    protected $casts = [
        'revokedate' => 'datetime',
    ];
}
