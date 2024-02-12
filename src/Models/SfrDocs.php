<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrDocs extends Model
{
    use Uuid, SoftDeletes;
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

    public function SfrDocsUserSigns($personid = null)
    {
        if (empty($personid)) {
            $userPid = Auth::user()->SfrPerson->getPid();
        } else {
            $userPid = $personid;
        }
        return $this->hasMany(SfrSignatures::class, 'sign_docid', 'docid')->where('sign_pid', $userPid);
    }

    public function docGroup()
    {
        return $this->hasOne(SfrDocGroups::class, 'groupid', 'doc_groupid');
    }
    public function docType()
    {
        return $this->hasOne(SfrDocTypes::class, 'typeid', 'doc_typeid');
    }
    /**
     * Файлы
     * @return boolean
     */
    public function isEditable()
    {
        $countSigns = $this->hasMany(SfrSignatures::class, 'sign_docid', 'docid')->count();
        if ($countSigns > 0) {
            return false;
        } else {
            return true;
        }
    }

}
