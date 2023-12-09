<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;


class SfrRelPersonsRolesInfoSystems extends Model
{
    protected $table = 'relation_sfrinfosystems_roles_persons';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'iroleid',
        'pid'
    ];
}
