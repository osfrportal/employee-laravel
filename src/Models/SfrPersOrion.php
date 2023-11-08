<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Osfrportal\OsfrportalLaravel\Data\Orion\TPersonData;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrPersOrion extends Model
{
    use SoftDeletes;

    protected $table = 'ppersorion';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'tpersondata' => TPersonData::class,
    ];

    protected $fillable = [
        'orionpersid',
        'tpersondata',
        'pid',
    ];

    protected $guarded = [];

    //protected $with = ['RfidCards'];

    /**
     * Карты работника
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function RfidCards()
    {
        return $this->hasMany(SfrOrionCards::class, 'orionpersid', 'orionpersid');
    }
}