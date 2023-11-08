<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrUnits extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'punits';
    protected $primaryKey = 'unitid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'unitname',
        'unitcode',
        'unitparentid'
    ];
    /**
     * Дочерние подразделения
     */
    public function children()
    {
        return $this->hasMany(SfrUnits::class, 'unitparentid')->orderBy('unitname', 'ASC')->orderBy('unitsortorder', 'ASC');
    }
    /**
     * Родительское подразделение
     */
    public function parent()
    {
        return $this->belongsTo(SfrUnits::class, 'unitparentid');
    }
    /**
     * Работники подразделения
     */
    public function SfrPersons()
    {
        $with_relations = [
            'SfrPersonAppointment',
            'SfrPersonVacation',
            'SfrPersonContacts',
            'SfrPersonDekret',
            'SfrPersonTabNum',
            'SfrPersonUnit',
        ];
        return $this->hasManyThrough(SfrPerson::class, SfrEmpUnit::class, 'unitid', 'pid', 'unitid', 'pid')->with($with_relations);
    }
}