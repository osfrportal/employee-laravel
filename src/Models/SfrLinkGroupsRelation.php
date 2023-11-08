<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SfrLinkGroupsRelation extends Model
{
    use SoftDeletes;
    protected $table = 'lgrelation';
    protected $primaryKey = 'lgrelid';
    public $timestamps = true;

    protected $fillable = [
        'linkid',
        'grlid',
    ];
    protected $guarded = [];

}