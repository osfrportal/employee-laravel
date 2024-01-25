<?php

namespace Osfrportal\OsfrportalLaravel\Models\Ldap;

use LdapRecord\Models\Model;

class SfrADUser extends Model
{
    public static array $objectClasses = [
        'top',
        'person',
        'organizationalperson',
        'user',
    ];
    protected ?string $connection = 'sfrAD';
}