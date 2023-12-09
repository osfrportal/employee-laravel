<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrInfoSystems;

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
}
