<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Actions\Units\UnitHeadCalcAction;


class SFRAdminDashboardController extends Controller
{
    public function showDashboard()
    {
        UnitHeadCalcAction::run('9a06e58a-6aa3-40ba-bc80-0f0b74280f66');
        return view('osfrportal::admin.dashboard.admin_dashboard');
    }
}
