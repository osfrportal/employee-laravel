<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum;
use Osfrportal\OsfrportalLaravel\Enums\StorageCategoryTypesEnum;

use Osfrportal\OsfrportalLaravel\Models\SfrStorage;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Illuminate\Http\Request;
use Osfrportal\OsfrportalLaravel\Http\Requests\StorageAddNewRequest;

class SFRStorageController extends Controller
{

    private $permissionManage = 'flash-manage';

    public function index(Request $request)
    {
        $this->authorize($this->permissionManage);
        if ($request->ajax()) {
            $model = SfrStorage::with(['person'])->select('sfrstorage.*');

            return Datatables::of($model)
                ->setRowId('storuuid')
                ->make(true);
        } else {
            return view('osfrportal::admin.storage.index');
        }
    }

    public function create()
    {
        $this->authorize($this->permissionManage);
        $StorageTypes = StorageTypesEnum::toArray();
        $StorageCategoryTypes = StorageCategoryTypesEnum::toArray();
        return view('osfrportal::admin.storage.create', ['StorageTypes' => $StorageTypes, 'StorageCategoryTypes' => $StorageCategoryTypes]);
    }

    public function store(StorageAddNewRequest $request)
    {
        //dump($request->all());
        //dump($request->validated());
        $validated = $request->validated();
        $model = new SfrStorage();
        $model->stortype = $validated['stortype'];
        $model->stormark = $validated['stormark'];
        $model->stordate = $validated['stordate'];
        $model->storvolume = $validated['storvolume'];
        $model->stornumber = $validated['stornumber'];
        $model->storserial = $validated['storserial'];
        $model->storarrivedfrom = $validated['storarrivedfrom'];
        $model->stordestroydate = $validated['stordestroydate'];
        $model->stordestroydoc = $validated['stordestroydoc'];
        $model->save();
        //$model->refresh();
        //$person = SfrPerson::find($validated['personid']);
        $model->person()->attach($validated['personid']);

        $this->flasher_interface->addSuccess('Устройство хранения успешно добавлено');
        return redirect()->route('osfrportal.admin.storage.index');
    }
}
