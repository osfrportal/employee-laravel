<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Http\Resources\SFROtrsStatsCollection;


class SFROtrsAdminController extends Controller
{
    public function APIStatsOut(Request $request) {
        $collection = collect();
    return new SFROtrsStatsCollection($collection);
    }
}
