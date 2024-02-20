<?php
namespace Osfrportal\OsfrportalLaravel\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;

class GeneratePersonLoginPassAction
{
    use AsAction;

    public function handle(SfrPerson $sfrperson, $personpasswordnew = null)
    {

        $SFRPersonData = SFRPersonData::from($sfrperson);
        $SFRUserData = $sfrperson->SfrUser;
        if (is_null($SFRUserData)) {
            if (is_null($personpasswordnew)) {
                $personpasswordnew = Str::password(10);
            }
            $userlogin = sprintf("%s%s.%s", Str::substr(Str::slug($SFRPersonData->persondata_pname), 0, 1), Str::substr(Str::slug($SFRPersonData->persondata_pmiddlename), 0, 1), Str::slug($SFRPersonData->persondata_psurname));
            //Проверяем, есть ли такой логин
            $checkLogin = SfrUser::where('username', $userlogin)->get();
            $checkLoginNum = $checkLogin->count();
            if ($checkLoginNum > 0) {
                $loginAdd = $checkLoginNum + 1;
                $userlogin = sprintf("%s%s.%s%s", Str::substr(Str::slug($SFRPersonData->persondata_pname), 0, 1), Str::substr(Str::slug($SFRPersonData->persondata_pmiddlename), 0, 1), Str::slug($SFRPersonData->persondata_psurname), $loginAdd);
            }
            $userdata = new SfrUser;
            $userdata->username = $userlogin;
            //$userdata->password = bcrypt('12345');
            $userdata->password = Hash::make($personpasswordnew);
            $sfrperson->SfrUser()->save($userdata);
        } else {
            if (!is_null($personpasswordnew)) {
                $sfrperson->SfrUser->update(['password' => Hash::make($personpasswordnew)]);
            }
            $userlogin = $SFRUserData->username;
        }
        return $userlogin;
    }

}
