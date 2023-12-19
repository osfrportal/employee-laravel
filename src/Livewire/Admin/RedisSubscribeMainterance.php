<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;
use Livewire\Component;

use Illuminate\Support\Facades\Redis;


class RedisSubscribeMainterance extends Component
{
    public $redis_message;
    public function __construct()
    {
            $this->redis_message = '';
    }
    public function render()
    {
        $msg = json_encode(array('time' => 'time_message', 'message' => 'text_message'));
        Redis::set('admin:mainterance:123', $msg);
        $this->redis_message = Redis::get('admin:mainterance:123');
        return view('osfrportal::livewire.admin.mainterance-messages', ['redis_message' => $this->redis_message]);
    }
}