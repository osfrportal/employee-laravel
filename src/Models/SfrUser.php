<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrUser extends Authenticatable
{
    use Uuid, HasApiTokens, Notifiable, HasRoles, SoftDeletes;
    protected $table = 'sfrusers';
    protected $primaryKey = 'userid';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'pid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];
    protected $with = ['SfrPerson', 'SfrUserSessions'];
    /**
     * Данные пользователя для входа на портал
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SfrPerson()
    {
        $with_relations = [
            'SfrPersonAppointment',
            'SfrPersonVacation',
            'SfrPersonContacts',
            'SfrPersonDekret',
            'SfrPersonTabNum',
            'SfrPersonUnit',
            'SfrPersonCerts',
        ];
        return $this->belongsTo(SfrPerson::class, 'pid', 'pid')->with($with_relations);
    }
    public function SfrUserSessions()
    {
        return $this->hasOne(SfrUserSessions::class, 'user_id', 'userid')->latest('last_activity');
    }

    public function getLastActivity()
    {
        $usessions = $this->SfrUserSessions;
        if (!is_null($usessions)) {
            return Carbon::createFromTimestamp($usessions->last_activity)->format('d.m.Y H:i:s');
        } else {
            return "";
        }
    }

    public function getUnreadNotifications()
    {
        if (!is_null($this->unreadNotifications->count())) {
            return $this->unreadNotifications->count();
        } else {
            return 0;
        }
    }
}