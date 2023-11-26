<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Carbon\Carbon;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrPerson extends Model
{
    use Uuid, SoftDeletes;
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
        return $this->hasOne(SfrUser::class, 'pid')->without('SfrPerson');
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
     * Отсутствия работника (командировки, отпуск за свой счет)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SfrPersonAbsence()
    {
        return $this->hasMany(SfrPersonAbsence::class, 'pid')->orderByDesc('absenceend');
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
     * Сертификаты работника
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SfrPersonCerts()
    {
        return $this->hasMany(SfrCerts::class, 'pid')->orderByDesc('certvalidto');
    }

    /**
     * Металлические печати работника
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SfrPersonStamps()
    {
        return $this->hasMany(SfrStampsJournal::class, 'pid')->whereNull('stampjreturn_at')->orderBy('stampjissue_at')->with('Stamp');
    }

    /**
     * ID работника в системе Орион ПРО
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function SfrPersonOrion()
    {
        return $this->hasOne(SfrPersOrion::class, 'pid', 'pid');
    }
    public function getPersonRfidCards()
    {
        if (!is_null($this->SfrPersonOrion)) {
            return $this->SfrPersonOrion->RfidCards;
        } else {
            return null;
        }
    }
    /**
     * Сертификаты работника действующие на текущий момент времени
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function getValidPersonCerts()
    {
        return $this->SfrPersonCerts()->where('certvalidto', '>=', Carbon::now());
    }

    public function getCertIdUNEP()
    {
        $unepValidCerts = $this->getValidPersonCerts->filter(function ($value, int $key) {
            if (!is_null($value->certdata->certId)) {
                return $value->certdata->certId;
            }
        });
        $unepLastValid = $unepValidCerts->sortByDesc('certvalidto')->first();
        if (!is_null($unepLastValid)) {
            $unepCertID = $unepLastValid->certdata->certId;
        } else {
            $unepCertID = null;
        }
        return $unepCertID;
    }
    public function getCertIdUKEP()
    {
        $ukepValidCerts = $this->getValidPersonCerts->filter(function ($value, int $key) {
            if ($value->certtype == CertsTypesEnum::UKEP()) {
                return $value->certserial;
            }
        });
        $ukepLastValid = $ukepValidCerts->sortByDesc('certvalidto');
        return $ukepLastValid;
    }

    public function SfrPersonSignatures()
    {
            return $this->hasMany(SfrSignatures::class, 'sign_pid', 'pid');
    }


    /**
     *
     * @return string
     */
    public function getPid()
    {
        return $this->pid;
    }

    public function getLastActivity()
    {
        $u = $this->SfrUser;
        if (!is_null($u)) {
            $out = $u->getLastActivity();
        } else {
            $out = null;
        }
        return $out;
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
        $papp = $this->SfrPersonAppointment->first();
        if (!is_null($papp)) {
            return $papp->aname;
        } else {
            return "";
        }
    }

    /**
     *
     * @return string
     */
    public function getUnit()
    {
        $unit = $this->SfrPersonUnit->first();
        if (!is_null($unit)) {
            return $unit->unitname;
        } else {
            return "";
        }
    }

    /**
     *
     * @return string
     */
    public function getTabNum()
    {
        $tabNum = $this->SfrPersonTabNum->sortByDesc('etcreatedon', SORT_NATURAL)->first();
        if (!is_null($tabNum)) {
            return $tabNum->etabnumber;
        } else {
            return "";
        }
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
        $now = Carbon::now()->format('Y-m-d');
        $filtered = $this->SfrPersonVacation()->get(['vacationstart', 'vacationend'])->where('vacationstart', '<=', $now)->where('vacationend', '>=', $now)->sortByDesc('vacationend')->first();

        return $filtered;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getPersonDekretNow()
    {
        $now = Carbon::now()->format('Y-m-d');
        $filtered = $this->SfrPersonDekret()->get(['dekretstart', 'dekretend'])->where('dekretstart', '<=', $now)->where('dekretend', '>=', $now)->sortByDesc('dekretend')->first();

        return $filtered;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getPersonAbsenceNow()
    {
        $now = Carbon::now()->format('Y-m-d');
        $filtered = $this->SfrPersonAbsence()->get(['absencestart', 'absenceend'])->where('absencestart', '<=', $now)->where('absenceend', '>=', $now)->sortByDesc('absenceend')->first();
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