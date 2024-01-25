<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrPersonDekret extends Model
{
    use SoftDeletes;

    protected $table = 'pemployeedekret';

    //public $incrementing = false;
    public $incrementing = true;
    //protected $keyType = 'string';
    public $timestamps = true;

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
    public function SfrPerson()
    {
        return $this->hasOne(SfrPerson::class, 'pid', 'pid');
    }


}