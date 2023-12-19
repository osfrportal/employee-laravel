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
        Redis::set('admin:mainterance:123', 'message');
        $this->redis_message = Redis::get('admin:mainterance:123');
        return view('osfrportal::livewire.admin.mainterance-messages', ['redis_message' => $this->redis_message]);
    }
}