<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Http\Requests\RestorePassPostRequest;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Actions\SendPasswordToUserAction;
use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

class LoginController extends Controller
{
    public function showloginform()
    {
        return view('osfrportal::sections.auth.login');
    }

    public function showRestorePassForm()
    {
        return view('osfrportal::sections.auth.restorepass');
    }
    public function doRestorePass(RestorePassPostRequest $request)
    {
        $inn = $request->input('inn');
        $snils = preg_replace('/[-\s]/', '', $request->input('snils'));
        $sfrperson = SfrPerson::where('pinn', $inn)->where('psnils', $snils)->first();
        if (!is_null($sfrperson)) {
            $SFRPhoneContactData = SFRPhoneContactData::from($sfrperson);
            if (!is_null($SFRPhoneContactData->email_ext)) {
                //SendPasswordToUserAction::run($sfrperson);
                SendPasswordToUserAction::dispatch($sfrperson);
                return back()->with([
                    'passwordSended' => 'Учетные данные для входа на портал отправлены на контактный адрес электронной почты.',
                ]);
            } else {
                return back()->withErrors([
                    'personNotFound' => 'Электронная почта работника не найдена. Заполните данные в телефонном справочнике или обратитесь в ОЗИ.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                'personNotFound' => 'Не найден работник с указанными ИНН и СНИЛС! Проверьте данные!',
            ])->withInput();
        }
    }
    /**
     * Обработка попыток аутентификации.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $remember = true;

        $credentials = $request->validate([
            'username' => ['required', 'max:35'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $logContext = [
                'personFullName' => Auth::user()->SfrPerson->getFullName(),
                'personPid' => Auth::user()->SfrPerson->getPid(),
            ];
            LogAddAction::run(LogActionsEnum::LOG_AUTH(), 'Вход пользователя {personFullName}, pid: {personPid})', $logContext);
            //return redirect()->intended('osfrportal.dashboard');
            return Redirect::intended(route('osfrportal.dashboard'));
        }
        LogAddAction::run(LogActionsEnum::LOG_AUTH(), 'ОШИБКА входа пользователя {username})', $credentials, 'warning');

        return back()->withErrors([
            'name' => 'Неверный пароль. Запросите пароль по ссылке "Выслать пароль" и попробуйте еще раз.',
        ])->onlyInput('name');
    }

    /**
     * Выход пользователя из системы
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('osfrportal.mainpage'));
    }
}
