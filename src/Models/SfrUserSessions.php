<?php
namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SfrUserSessions extends Model
{
    protected $table = 'sessions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'payload',
        'id',
    ];
    protected $guarded = ['*'];

    protected function lastActivity(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Carbon::createFromTimestamp($value)->format('d.m.Y H:i:s'),
        );
    }
}