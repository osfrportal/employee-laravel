<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;
use Livewire\Component;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;


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
        $userId = Auth::user()->id;
        $key = "admin:mainterance:{$userId}";

        $msg = json_encode(array('time' => 'time_message', 'message' => 'text_message'));
        Redis::setex($key, $this->durationInSeconds, $userId);
        //Redis::set($key, $msg, 'EX', 35);
        $this->redis_message = Redis::get($key);
        return view('osfrportal::livewire.admin.mainterance-messages', ['redis_message' => $this->redis_message]);
    }
}