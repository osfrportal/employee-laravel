<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class SFRLogsAdminController extends Controller
{
    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */


    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */
    public function logsPhoneUpdates(Request $request)
    {
        return view('osfrportal::admin.logs.logsphoneupdates');
    }
}
