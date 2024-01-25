<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;



class SFRAdminDashboardController extends Controller
{
    public function showDashboard()
    {
        return view('osfrportal::admin.dashboard.admin_dashboard');
    }
}
