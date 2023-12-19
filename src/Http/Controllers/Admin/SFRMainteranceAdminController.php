<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

class SFRMainteranceAdminController extends Controller
{
    public function mainteranceIndex()
    {
        return view('osfrportal::admin.mainterance.index');
    }
}
