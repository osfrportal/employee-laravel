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
    public function saveInfoSystem(SaveInfosystemPostRequest $request) {

    }
}
