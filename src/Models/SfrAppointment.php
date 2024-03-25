<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrAppointment extends Model
{
    use Uuid, SoftDeletes;

    protected $table = 'pappointment';
    protected $primaryKey = 'aid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'aname',
    ];

    public function SfrPersons()
    {
        return $this->belongsToMany(SfrPerson::class, 'pempapp', 'aid', 'pid')->withTimestamps();
    }
}