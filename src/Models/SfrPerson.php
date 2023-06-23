<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Carbon\Carbon;

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
        return $this->hasMany(SfrPersonDekret::class, 'pid')->orderByDesc('dekretend');
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

    /**
     *
     * @return string
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     *
     * @return string
     */
    public function getFullName()
    {
        return "{$this->psurname} {$this->pname} {$this->pmiddlename}";
    }

    /**
     *
     * @return string
     */
    public function getBirthDate()
    {
        $birthdate = Carbon::parse($this->pbirthdate)->format('d.m.Y');
        return $birthdate;
    }

    /**
     *
     * @return string
     */
    public function getINN()
    {
        return $this->pinn;
    }

    /**
     *
     * @return string
     */
    public function getAppointment()
    {
        return $this->SfrPersonAppointment->first()->aname;
    }

    /**
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->SfrPersonUnit->first()->unitname;
    }

    /**
     *
     * @return string
     */
    public function getTabNum()
    {
        return $this->SfrPersonTabNum->sortByDesc('etcreatedon', SORT_NATURAL)->first()->etabnumber;
    }

    /**
     *
     * @return string
     */
    public function getSNILS()
    {
        if (preg_match('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', $this->psnils, $matches)) {
            $result = $matches[1] . '-' . $matches[2] . '-' . $matches[3] . ' ' . $matches[4];
        } else {
            $result = $this->psnils;
        }
        return $result;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getPersonVacationNow()
    {
        $filtered = $this->SfrPersonVacation()->get(['vacationstart', 'vacationend'])->where('vacationstart', '<=', Carbon::now())->where('vacationend', '>=', Carbon::now())->sortByDesc('vacationend')->first();

        return $filtered;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getPersonDekretNow()
    {
        $filtered = $this->SfrPersonDekret()->get(['dekretstart', 'dekretend'])->where('dekretstart', '<=', Carbon::now())->where('dekretend', '>=', Carbon::now())->sortByDesc('dekretend')->first();

        return $filtered;
    }

    public function getPersonContactData()
    {
        $contactdata = $this->SfrPersonContacts()->get()->first();
        if (!is_null($contactdata)) {
            return $contactdata['contactdata'];
        } else {
            return $contactdata;
        }
    }
}