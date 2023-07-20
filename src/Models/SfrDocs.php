<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;

class SfrDocs extends Model
{
    use Uuid;
    protected $table = 'sfrdocs';
    protected $primaryKey = 'docid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'doc_name',
        'doc_date',
        'doc_number',
        'doc_typeid',
        'doc_groupid',
        'doc_data',
    ];
}
