<?php

namespace Osfrportal\OsfrportalLaravel\Models\Ldap;

use LdapRecord\Models\Model;

class SfrADUser extends Model
{
    public static $objectClasses = [
        'top',
        'person',
        'organizationalperson',
        'user',
    ];
    protected $connection = 'sfrAD';
}