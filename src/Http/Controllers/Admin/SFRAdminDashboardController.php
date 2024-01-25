<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\Ldap\SfrADUser;

class SFRAdminDashboardController extends Controller
{
    public function showDashboard()
    {
        $usersAD = SfrADUser::limit(10)->get();
        foreach ($usersAD as $userAD) {
            $userAD->getFirstAttribute('cn');
        }

        return view('osfrportal::admin.dashboard.admin_dashboard');
    }
}
