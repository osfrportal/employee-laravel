<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Data\SFRMsgStatusData;

use Illuminate\Support\Facades\Redis;

class SFRMainteranceAdminController extends Controller
{
    private $redisMKey = 'mainterance:test';

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
