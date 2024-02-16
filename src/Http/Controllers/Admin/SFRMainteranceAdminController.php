<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;



class SFRMainteranceAdminController extends Controller
{
    public function mainteranceIndex()
    {
        $test = SFRMsgStatusData::from(['error' => false, 'message' => 'Тестовое сообщение']);

        dump($test->toJson());
        Redis::set($this->redisMKey, $test->toJson());
        if (Redis::exists($this->redisMKey)) {
            dump(Redis::get($this->redisMKey));
        }
        //Redis::del($this->redisKey);
        return view('osfrportal::admin.mainterance.index');
    }
}
