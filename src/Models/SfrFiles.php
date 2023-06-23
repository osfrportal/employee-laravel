<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrFiles extends Model
{
    use Uuid;
    protected $table = 'sfrfiles';
    protected $primaryKey = 'fileid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'file_name',
        'file_path',
        'file_disk',
        'fileid'
    ];
}