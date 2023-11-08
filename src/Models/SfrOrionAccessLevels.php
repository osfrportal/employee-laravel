<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelData;

class SfrOrionAccessLevels extends Model
{
    protected $table = 'orionaccesslevel';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'taccessleveldata' => TAccessLevelData::class,
    ];

    protected $fillable = [
        'levelid',
        'taccessleveldata',
    ];

    protected $guarded = [];

}
