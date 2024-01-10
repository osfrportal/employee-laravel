<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SfrStorageJounalCheck extends Model
{
    use SoftDeletes;
    protected $table = 'sfrstoragejournalcheck';
    protected $primaryKey = 'id';
    public $timestamps = true;


    public function storage()
    {
        return $this->belongsTo(SfrStorage::class, 'storuuid', 'storuuid')->withTimestamps();
    }
}
