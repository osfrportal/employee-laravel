<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Data\SFRMsgStatusData;

class SFRMainteranceAdminController extends Controller
{
    public function mainteranceIndex()
    {
        $test = SFRMsgStatusData::from(false, 'Тестовое сообщение');
        dump($test);
        return view('osfrportal::admin.mainterance.index');
    }
}
