<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrDialplan extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'pdialplan';
    protected $keyType = 'string';
    protected $primaryKey = 'dpid';
    public $incrementing = false;

    protected $fillable = [
        'dpnumstart',
        'dpnumend',
        'addrid',
        'dpid'
    ];
    protected $guarded = [];

    public function addressFull()
    {
        return $this->hasOne(SfrAddresses::class, 'addrid', 'addrid');
    }
}