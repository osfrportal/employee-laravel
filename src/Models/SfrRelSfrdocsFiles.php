<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrRelSfrdocsFiles extends Model
{
    use SoftDeletes;
    protected $table = 'rel_sfrdocs_files';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'docid',
        'fileid'
    ];
}