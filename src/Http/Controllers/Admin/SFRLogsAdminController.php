<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use danielme85\LaravelLogToDB\LogToDB;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

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
        $days_count = 30;
        $phone_update_logs = LogToDB::model(null, 'pgsql', 'sfrlogs')->orderByDesc('created_at')->whereJsonContains('context->action', LogActionsEnum::LOG_PHONE_UPDATE())->whereDate('created_at', '>=', Carbon::now()->subDays($days_count))->get();
        $phone_update_logs->dump();

        return view('osfrportal::admin.logs.logsphoneupdates');
    }
}
