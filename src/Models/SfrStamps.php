<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Carbon\Carbon;

class SfrStamps extends Model
{
    use Uuid, SoftDeletes;
    protected $table = 'stamps';
    protected $primaryKey = 'stampid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    public function StampJournal()
    {
        return $this->hasMany(SfrStampsJournal::class, 'stampid', 'stampid')->orderBy('stampjissue_at');
    }

    public function StampJournalIssued()
    {
        return $this->StampJournal()->whereNull('stampjreturn_at')->whereNotNull('stampjissue_at')->orderByDesc('stampjissue_at')->with(['Person']);
    }
}
