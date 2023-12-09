<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

class SFRInfoSystemsController extends Controller
{
    private $permissionManage = 'infosystem-manage';

    public function listInfoSystemsAll() {
        $this->authorize($this->permissionManage);

        return view('osfrportal::admin.links.linksGroupsEdit', [
            'linkGroupID' => 0,
        ]);
    }
}
