<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Carbon\Carbon;

class SfrStampsJournal extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'stamps_journal';
    protected $primaryKey = 'stampjournalid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    protected $casts = [
        'stampjissue_at' => 'date',
        'stampjreturn_at' => 'date',
    ];


    public function Person()
    {
        return $this->hasOne(SfrPerson::class, 'pid', 'pid')->select('pid', 'psurname', 'pname', 'pmiddlename');
    }

    public function Stamp()
    {
        return $this->hasOne(SfrStamps::class, 'stampid', 'stampid');
    }
}
