<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;

use Livewire\Component;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Osfrportal\OsfrportalLaravel\Data\SFRImapStatusData;

class RedisSubscribeMainterance extends Component
{
    public $redis_message;
    public $durationInSeconds;

    public function __construct()
    {
        $this->redis_message = '';
        $this->durationInSeconds = 35;
    }
    public function render()
    {
        $key = 'mainterance:imap';

        //$userId = Auth::user()->userid;
        //$key = "admin:mainterance:{$userId}";

        //$msg = json_encode(array('time' => 'time_message', 'message' => 'text_message'));
        //Redis::setex($key, $this->durationInSeconds, $msg);
        //Redis::set($key, $msg, 'EX', 35);
        $this->redis_message = Redis::get($key);
        $redisData = SFRImapStatusData::from($this->redis_message);
        return view('osfrportal::livewire.admin.mainterance-messages', ['redismessage' => $redisData]);
    }
}
