<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum;
use Osfrportal\OsfrportalLaravel\Enums\StorageCategoryTypesEnum;

use Osfrportal\OsfrportalLaravel\Models\SfrStorage;

class SFRStorageController extends Controller
{
    public function index()
    {
        dump(SfrStorage::all());
        return view('osfrportal::admin.storage.index');
    }
}