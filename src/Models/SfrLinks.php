<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Models\SfrLinkGroups;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrLinks extends Model
{
    use SoftDeletes;

    protected $table = 'links';
    protected $primaryKey = 'linkid';
    public $timestamps = true;

    protected $fillable = [
        'linkname',
        'linkurl',
        'linkshowinleftmenu',
        'linksortorder',
    ];
    protected $guarded = [];

    public function LinkGroup()
    {
        return $this->belongsToMany(SfrLinkGroups::class, 'lgrelation', 'linkid', 'grlid')->withTimestamps();
    }

}