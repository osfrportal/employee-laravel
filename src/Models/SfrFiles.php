<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrFiles extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'sfrfiles';
    protected $primaryKey = 'fileid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'file_name',
        'file_description',
        'file_gosthash',
        'file_disk',
        'file_enabled',
        'fileid'
    ];
    //protected $with = ['SfrFilesSigns'];

    public function SfrFilesSigns()
    {
        $this->hasMany(SfrSignatures::class, 'fileid', 'sign_fileid');
    }
}