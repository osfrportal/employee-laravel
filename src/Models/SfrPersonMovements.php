<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonMovementData;
use Osfrportal\OsfrportalLaravel\Enums\PersonsMovementsEnum;

class SfrPersonMovements extends Model
{
    use Uuid, SoftDeletes;

    protected $table = 'personmovements';
    protected $primaryKey = 'movid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $guarded = [];

    protected $casts = [
        'movementtype' => PersonsMovementsEnum::class,
        'movementdata' => SFRPersonMovementData::class,
        //'movementeventdate' => 'datetime:d-m-Y',
    ];
    /*
        protected function serializeDate(DateTimeInterface $date): string
        {
            return $date->format('d-m-Y');
        }
    */
    /**
     * Данные работника
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function SfrPerson()
    {
        return $this->hasOne(SfrPerson::class, 'pid', 'pid');
    }




}