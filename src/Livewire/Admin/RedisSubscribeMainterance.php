<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;
use Livewire\Component;

use Illuminate\Support\Facades\Redis;


class RedisSubscribeMainterance extends Component
{
    public $redis_message;
    public function __construct()
    {
        Redis::subscribe(['test-channel'], function (string $message) {
            $this->redis_message = $message;
        });
    }
    public function render()
    {
        return view('osfrportal::livewire.admin.mainterance-messages', ['redis_message' => $this->redis_message]);
    }
}