<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrInfoSystemsRoles extends Model
{
    use Uuid;
    protected $table = 'sfrinfosystems_roles';
    protected $primaryKey = 'iroleid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'iroleid',
        'irole_name',
        'irole_data'
    ];

    public function infosystem()
    {
        return $this->hasOneThrough(SfrInfoSystems::class, SfrRelRolesInfoSystems::class, 'iroleid','isysid','iroleid','isysid');
    }

    /**
     * Работники имеющие эту роль
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function persons()
    {
        return $this->belongsToMany(SfrPerson::class, 'relation_sfrinfosystems_roles_persons', 'iroleid', 'pid')->withTimestamps();
    }
}
