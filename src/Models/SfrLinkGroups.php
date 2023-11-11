<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Models\SfrLinks;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrLinkGroups extends Model
{
    use SoftDeletes;
    protected $table = 'linkgroups';
    protected $primaryKey = 'grlid';
    public $timestamps = true;

    protected $fillable = [
        'grlname',
        'grlsortorder',
        'grlparentid',
        'grlcollapsed',
    ];
    protected $attributes = [
        'grlsortorder' => 9999,
        'grlcollapsed' => false,
    ];
    public function parent()
    {
        return $this->belongsTo(SfrLinkGroups::class, 'grlparentid');
    }

    public function children()
    {
        return $this->hasMany(SfrLinkGroups::class, 'grlparentid')->orderBy('grlname', 'ASC')->orderBy('grlsortorder', 'ASC');
    }

    public function SfrLinks()
    {
        return $this->belongsToMany(SfrLinks::class, 'lgrelation', 'grlid', 'linkid')->withTimestamps();
    }
}