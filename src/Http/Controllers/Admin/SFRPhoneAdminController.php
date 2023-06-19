<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Osfrportal\OsfrportalLaravel\Models\SfrAddresses;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;

class SFRPhoneAdminController extends Controller
{
    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */
    public function APIAddrList()
    {
        $sfraddr = SfrAddresses::orderBy('paddress', 'ASC')->get();

        return DataTables::of($sfraddr)->toJson();
    }

    public function APIUnitsList()
    {
        $sfraddr = SfrAddresses::orderBy('paddress', 'ASC')->get();

        return DataTables::of($sfraddr)->toJson();
    }
    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */

    public function ShowAddrList()
    {
        return view('osfrportal::admin.phone.addr_list');
    }
    public function ShowUnitsList()
    {
        return view('osfrportal::admin.phone.units_list');
    }
}