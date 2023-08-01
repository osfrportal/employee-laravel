<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrSignatures extends Model
{
    use Uuid;
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
