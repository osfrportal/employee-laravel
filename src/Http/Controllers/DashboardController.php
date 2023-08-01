<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;

class DashboardController extends Controller
{
    public function dashboardIndex()
    {
        $unreadNotifications = Auth::user()->unreadNotifications()->limit(10)->get()->toArray();
        return view('osfrportal::sections.dashboard.dashboard', ['unreadNotifications' => $unreadNotifications]);
    }
}
