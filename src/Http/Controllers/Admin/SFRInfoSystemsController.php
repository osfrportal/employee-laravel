<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrInfoSystems;
use Osfrportal\OsfrportalLaravel\Models\SfrInfoSystemsRoles;
use Osfrportal\OsfrportalLaravel\Http\Requests\SaveInfosystemPostRequest;
use Osfrportal\OsfrportalLaravel\Http\Requests\SaveInfosystemRoleRequest;


use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SFRInfoSystemsController extends Controller
{
    private $permissionManage = 'infosystem-manage';

    public function listInfoSystemsAll() {
        $this->authorize($this->permissionManage);
        $infosystems = SfrInfoSystems::with('roles')->orderBy('isys_name','ASC')->get();

        return view('osfrportal::admin.infosystems.listall', [
            'infosystems' => $infosystems,
        ]);
    }

    public function showAddForm() {
        $infoSystemsRoot = SfrInfoSystems::doesntHave('parent')->doesntHave('persons')->doesntHave('roles')->orderBy('isys_name','ASC')->get();

        return view('osfrportal::admin.infosystems.infosystemsEditForm', [
            'infoSystemData' => null,
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

    public function showRolesAddForm() {
        return view('osfrportal::admin.infosystems.infosystemsRolesAddForm');
    }

    public function saveInfoSystemRoles(SaveInfosystemRoleRequest $saveRequest) {
        $validated = $saveRequest->validated();
        
        $isysid = Arr::get($validated, 'isysid');
        $infoSystemModel = SfrInfoSystems::with(['roles'])->find($isysid);

        $role = SfrInfoSystemsRoles::updateOrCreate(
            [
                'iroleid' => Arr::get($validated, 'iroleid'),
            ],
            [
                'irole_name' => Arr::get($validated, 'irole_name'),
            ]
        );

        $infoSystemModel->roles()->syncWithoutDetaching($role);
        $infoSystemModel->refresh();

        $rolesCount = $infoSystemModel->roles->count();
        $message = sprintf('Данные успешно сохранены <br> Количество ролей у ресурса "%s"- %s', $infoSystemModel->isys_name, $rolesCount);
        $this->flasher_interface->addSuccess($message);

        return redirect()->route('osfrportal.admin.infosystems.roles.add');
    }
}
