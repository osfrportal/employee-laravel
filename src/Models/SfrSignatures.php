<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrSignatures extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'sfrsigratures';
    protected $primaryKey = 'signid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'sign_docid',
        'sign_fileid',
        'sign_pid',
        'sign_type',
        'sign_data',

    ];
}