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
    public function __construct()
    {
        parent::__construct();
    }
    public function dashboardIndex()
    {
        $unreadNotifications = Auth::user()->unreadNotifications()->limit(10)->get()->toArray();
        return view('osfrportal::sections.dashboard.dashboard', ['unreadNotifications' => $unreadNotifications]);
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
