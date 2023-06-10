<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;

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
        return view('osfrportal::sections.profile.index');
    }
    public function profileUsbSkdCerts()
    {
        return view('osfrportal::sections.profile.usbskdcerts');
    }
}
