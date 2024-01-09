<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum;
use Osfrportal\OsfrportalLaravel\Enums\StorageCategoryTypesEnum;

use Osfrportal\OsfrportalLaravel\Models\SfrStorage;
use Illuminate\Http\Request;

class SFRStorageController extends Controller
{

    private $permissionManage = 'flash-manage';

    public function index(Request $request)
    {
        $this->authorize($this->permissionManage);
        if ($request->ajax()) {
            $data = SfrStorage::select('*');
            return Datatables::of($data)
                ->setRowId('storuuid')
                ->make(true);
        } else {
            dump(SfrStorage::all());
            return view('osfrportal::admin.storage.index');
        }
    }
}