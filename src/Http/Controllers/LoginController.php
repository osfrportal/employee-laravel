<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showloginform()
    {
        return view('osfrportal::sections.auth.login');
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

            //return redirect()->intended('osfrportal.dashboard');
            return Redirect::route('osfrportal.dashboard');
        }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
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
        return redirect('/');
    }
}
