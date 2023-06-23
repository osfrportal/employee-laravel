<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class SfrRelSfrdocsFiles extends Model
{
    protected $table = 'rel_sfrdocs_files';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'docid',
        'fileid'
    ];
}