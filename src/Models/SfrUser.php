<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class SfrUser extends Authenticatable
{
    use Uuid, HasApiTokens, Notifiable, HasRoles;
    protected $table = 'sfrusers';
    protected $primaryKey = 'userid';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
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
    protected $casts = [

    ];
    protected $with = ['SfrPerson'];
    /**
     * Данные пользователя для входа на портал
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function SfrPerson() {
        return $this->belongsTo(SfrPerson::class, 'pid', 'pid');
    }
}
