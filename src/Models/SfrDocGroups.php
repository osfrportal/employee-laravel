<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrDocGroups extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'sfrdocgroups';
    protected $primaryKey = 'groupid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'group_name',
        'group_data',
    ];

    public function SfrDocs()
    {
        return $this->hasMany(SfrDocs::class, 'doc_groupid', 'groupid')->with(['docType']);
    }
}