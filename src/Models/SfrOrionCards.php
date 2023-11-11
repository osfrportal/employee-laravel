<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Data\Orion\TKeyData;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrOrionCards extends Model
{
    use SoftDeletes;
    protected $table = 'orioncards';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'tkeydata' => TKeyData::class,
    ];

    protected $fillable = [
        'orionpersid',
        'accesslevelid',
        'tkeydata',
        'keyid',
    ];

    protected $guarded = [];

    protected $with = ['OrionAccessLevel'];

    public function PersOrion()
    {
        return $this->belongsTo(SfrPersOrion::class, 'orionpersid', 'orionpersid');
    }

    public function OrionAccessLevel()
    {
        return $this->hasOne(SfrOrionAccessLevels::class, 'levelid', 'accesslevelid');
    }
}