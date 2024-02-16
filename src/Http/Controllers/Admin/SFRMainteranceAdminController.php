<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Data\SFRMsgStatusData;

use Illuminate\Support\Facades\Redis;

class SFRMainteranceAdminController extends Controller
{
    private $redisKey = 'mainterance:test';

    public function mainteranceIndex()
    {
        $test = SFRMsgStatusData::from(['error' => false, 'message' => 'Тестовое сообщение']);

        dump($test->toJson());
        Redis::set($this->redisKey, $test->toJson());
        if (Redis::exists($this->redisKey)) {
            dump(Redis::get($this->redisKey));
        }
        //Redis::del($this->redisKey);
        return view('osfrportal::admin.mainterance.index');
    }
}
