<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Osfrportal\OsfrportalLaravel\Models\SfrConfig;

class SFRSysconfigController extends Controller
{
    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */

    public function showConfigList()
    {
        $configList = SfrConfig::groupBy('group')->all();
        dump($configList);
        return view('osfrportal::admin.sysconfig.configlist', ['configList' => $configList]);
    }
}