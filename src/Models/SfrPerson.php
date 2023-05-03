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
    public function SfrUser() {
        return $this->hasOne(SfrUser::class, 'pid');
    }
}
