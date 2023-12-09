<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrInfoSystems extends Model
{
    use Uuid;
    protected $table = 'sfrinfosystems';
    protected $primaryKey = 'isysid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'isysid',
        'parent_isysid',
        'isys_name',
        'isys_data',
        'roles'
    ];
    //protected $withCount = ['children'];

    public function children()
    {
        return $this->hasMany(SfrInfoSystems::class, 'parent_isysid')->orderBy('isys_name', 'ASC');
    }

    public function parent()
    {
        return $this->belongsTo(SfrInfoSystems::class, 'parent_isysid');
    }
    public function roles() {
        return $this->belongsToMany(SfrInfoSystemsRoles::class, 'relation_sfrinfosystems_roles', 'isysid', 'iroleid')->withTimestamps();
    }
    public function persons() {
        $cols_to_get = [
            'psurname',
            'pname',
            'pmiddlename',
        ];
        //return $this->belongsToMany(PFRPerson::class, 'relation_sfrinfosystems_persons', 'isysid', 'pid')->select($cols_to_get)->withTimestamps();
        return $this->belongsToMany(SfrPerson::class, 'relation_sfrinfosystems_persons', 'isysid', 'pid')->withTimestamps();
    }
}
