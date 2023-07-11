<?php

namespace Osfrportal\OsfrportalLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Osfrportal\OsfrportalLaravel\Traits\Uuid;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SfrConfig extends Model
{
    use Uuid;
    protected $table = 'sfrconfig';
    protected $primaryKey = 'configid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    /**
     * Требуется ли шифрование
     * @return bool
     */
    public function isCrypted(): bool
    {
        if ($this->crypted === true) {
            return true;
        }

        return false;
    }

    public function getValueAttribute($value)
    {
        if (($this->isCrypted()) && (!is_null($value))) {
            try {
                return Crypt::decryptString($value);
            } catch (DecryptException $e) {
                //dd($e);
                return $value;
            }
        } else {
            return $value;
        }
    }
    public function setValueAttribute($value)
    {
        if ($this->isCrypted() && !is_null($value)) {
            try {
                $this->attributes['value'] = Crypt::encryptString($value);
            } catch (DecryptException $e) {
                $this->attributes['value'] = $value;
            }
        } else {
            $this->attributes['value'] = $value;
        }
    }
}
