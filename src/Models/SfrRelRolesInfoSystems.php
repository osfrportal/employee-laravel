<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;


class SfrRelRolesInfoSystems extends Model
{
    protected $table = 'relation_sfrinfosystems_roles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'iroleid',
        'isysid'
    ];
}
