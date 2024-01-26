<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Actions\Docs\CountUnsignedDocsByUserAction;
use Osfrportal\OsfrportalLaravel\Actions\LiveUsersListAction;
use Osfrportal\OsfrportalLaravel\Actions\GetPersonsBirthdaysAction;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function dashboardIndex()
    {
        $docsUnsignedCount = CountUnsignedDocsByUserAction::run();
        $personsBirthdays = GetPersonsBirthdaysAction::run();

        $unreadNotifications = Auth::user()->unreadNotifications()->get()->toArray();
        return view('osfrportal::sections.dashboard.dashboard', ['unreadNotifications' => $unreadNotifications, 'docsUnsignedCount' => $docsUnsignedCount, 'personsBirthdays' => $personsBirthdays]);
    }
    public function dashboardIndex2()
    {
        //LiveUsersListAction::run();
        $personsBirthdays = GetPersonsBirthdaysAction::run();
        $docsUnsignedCount = CountUnsignedDocsByUserAction::run();

        $unreadNotifications = Auth::user()->unreadNotifications()->limit(10)->get()->toArray();
        return view('osfrportal::sections.dashboard.dashboard2', ['unreadNotifications' => $unreadNotifications, 'docsUnsignedCount' => $docsUnsignedCount, 'personsBirthdays' => $personsBirthdays]);
    }

    public function markNotificationRead(Request $request)
    {
        Auth::user()->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();
        return response()->noContent();
    }
}
