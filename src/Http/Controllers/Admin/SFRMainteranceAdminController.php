<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Data\SFRMsgStatusData;

class SFRMainteranceAdminController extends Controller
{
    public function mainteranceIndex()
    {
        $test = SFRMsgStatusData::from(['error' => false, 'message' => 'Тестовое сообщение']);
        dump($test);
        dump($test->toJson());
        return view('osfrportal::admin.mainterance.index');
    }
}
