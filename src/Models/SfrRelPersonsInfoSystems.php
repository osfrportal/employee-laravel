<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;


class SfrRelPersonsInfoSystems extends Model
{
    protected $table = 'relation_sfrinfosystems_persons';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
