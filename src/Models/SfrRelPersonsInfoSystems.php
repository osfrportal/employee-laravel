<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;

use Osfrportal\OsfrportalLaravel\Data\Infosystem\SFRInfosystemRelData;

class SfrRelPersonsInfoSystems extends Model
{
    protected $table = 'relation_sfrinfosystems_persons';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'reldata' => SFRInfosystemRelData::class,
    ];

}
