<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrInfoSystems;
use Osfrportal\OsfrportalLaravel\Http\Requests\SaveInfosystemPostRequest;


use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SFRInfoSystemsController extends Controller
{
    private $permissionManage = 'infosystem-manage';

    public function listInfoSystemsAll() {
        $this->authorize($this->permissionManage);
        $infosystems = SfrInfoSystems::orderBy('isys_name','ASC')->get();

        return view('osfrportal::admin.infosystems.listall', [
            'infosystems' => $infosystems,
        ]);
    }

    public function showAddForm() {
        $infoSystemsRoot = SfrInfoSystems::doesntHave('parent')->doesntHave('persons')->doesntHave('roles')->orderBy('isys_name','ASC')->get();

        return view('osfrportal::admin.infosystems.infosystemsEditForm', [
            'infoSystemData' => 0,
            'infoSystemsRoot' => $infoSystemsRoot,
        ]);
    }
    public function saveInfoSystem(SaveInfosystemPostRequest $saveRequest) {

        $validated = $saveRequest->validated();
        $parent_isysid = null;
        if (Arr::get($validated, 'parent_isysid') != '-') {
            $parent_isysid = Arr::get($validated, 'parent_isysid');
        }
        $infoSystemModel = SfrInfoSystems::updateOrCreate(
            [
                'isysid' => Arr::get($validated, 'isysid'),
            ],
            [
                'isys_name' => Arr::get($validated, 'isys_name'),
                'parent_isysid' => $parent_isysid,
            ]
        );

        $this->flasher_interface->addSuccess('Данные успешно сохранены');

        return redirect()->route('osfrportal.admin.infosystems.index');
    }
}
