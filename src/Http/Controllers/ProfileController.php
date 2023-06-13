<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;

class ProfileController extends Controller
{
    /**
     * Обновление пароля пользователем
     * @param Request $request
     * @return Response
     */
    public function passwordChange(Request $request)
    {
        $input = $request->all();
        $user = SfrUser::find(auth()->user()->id);


        if (!Hash::check($input['current_password'], $user->password)) {
            dd('Passowrd is not match.');
        } else {
            dd('Update you password code');
        }
    }

    public function profileIndex()
    {
        $person_data = new SFRPersonData(
            persondata_pid: Auth::user()->SfrPerson->getPid(),
            persondata_fullname: Auth::user()->SfrPerson->getFullName(),
            persondata_birthday: Auth::user()->SfrPerson->getBirthDate(),
            persondata_inn: Auth::user()->SfrPerson->getINN(),
            persondata_snils: Auth::user()->SfrPerson->getSNILS(),
            persondata_appointment: Auth::user()->SfrPerson->getAppointment(),
            persondata_tabnum: Auth::user()->SfrPerson->getTabNum(),
            persondata_unit_name: Auth::user()->SfrPerson->getUnit(),
        );
        $contact_data = SFRPhoneContactData::from(Auth::user()->SfrPerson->SfrPersonContacts->contactdata);
        //dd($contact_data);
        return view('osfrportal::sections.profile.index', ['SFRPersonData' => $person_data, 'SFRPhoneContactData' => $contact_data]);
    }
    public function profileUsbSkdCerts()
    {
        return view('osfrportal::sections.profile.usbskdcerts');
    }
}
