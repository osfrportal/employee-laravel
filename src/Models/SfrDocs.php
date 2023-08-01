<?php

namespace Osfrportal\OsfrportalLaravel\Models;
use Illuminate\Support\Facades\Auth;

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
    /**
     * Eager Loading By Default
     * @var array
     */
    protected $with = ['SfrDocsFiles'];

    /**
     * Файлы
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function SfrDocsFiles()
    {
        return $this->belongsToMany(SfrFiles::class, 'rel_sfrdocs_files', 'docid', 'fileid')->withTimestamps();
    }

    public function SfrDocsUserSigns() {
        return $this->hasMany(SfrSignatures::class, 'sign_docid', 'docid')->where('sign_pid', Auth::user()->SfrPerson->getPid());
    }
}
