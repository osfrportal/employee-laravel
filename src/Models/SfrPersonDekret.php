<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrPersonDekret extends Model
{
    use Uuid;
    protected $table = 'pemployeedekret';

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
     * Данные работника
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function SfrPerson() {
        return $this->hasOne(SfrPerson::class, 'pid', 'pid');
    }


}
