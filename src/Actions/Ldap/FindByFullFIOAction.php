<?php
namespace Osfrportal\OsfrportalLaravel\Actions\Ldap;

use Lorisleiva\Actions\Concerns\AsAction;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\Ldap\SfrADUser;


class FindByFullFIOAction
{
    use AsAction;
    public function handle(SfrPerson $sfrperson)
    {
        $fullname = $sfrperson->getFullName();

        //$usersAD = SfrADUser::where('cn', '=', $fullname)->get();
        $usersAD = SfrADUser::findBy('cn', $fullname);
        dump($usersAD);
        return $usersAD;
        /*
        foreach ($usersAD as $userAD) {
            dump($userAD);
        }
        */
    }
}
