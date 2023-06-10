<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrPerson extends Model
{
    use Uuid;
    protected $table = 'ppersons';
    protected $primaryKey = 'pid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * Атрибуты, для которых НЕ разрешено массовое присвоение значений.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * Eager Loading By Default
     * @var array
     */
    //protected $with = ['SfrUser'];

    /**
     * Данные пользователя для входа на портал
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function SfrUser()
    {
        return $this->hasOne(SfrUser::class, 'pid');
    }

    /**
     * Контактная информация работника
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function SfrPersonContacts()
    {
        return $this->hasOne(SfrPersonContacts::class, 'pid', 'pid');
    }

    /**
     * Отпуска работника
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SfrPersonVacation()
    {
        return $this->hasMany(SfrPersonVacation::class, 'pid')->orderByDesc('vacationend');
    }

    /**
     * Декретные отпуска работника
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SfrPersonDekret()
    {
        return $this->hasMany(SfrPersonDekret::class, 'pid')->orderByDesc('updated_at');
    }

    /**
     * Табельный номер работника
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SfrPersonTabNum()
    {
        return $this->hasMany(SfrEmployeeTabNum::class, 'pid')->latest('updated_at');
    }

    /**
     * Должность работника
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function SfrPersonAppointment()
    {
        return $this->belongsToMany(SfrAppointment::class, 'pempapp', 'pid', 'aid')->withTimestamps();
    }

    /**
     * Подразделение работника
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function SfrPersonUnit()
    {
        return $this->belongsToMany(SfrUnits::class, 'pempunit', 'pid', 'unitid')->withTimestamps();
    }
}
