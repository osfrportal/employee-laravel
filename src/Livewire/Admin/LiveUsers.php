<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Redis;

class LiveUsers extends Component
{
    public $liveUsersCount;



    private function liveUsers()
    {
        $count = 0;
        $cursor = null;
        $redis_prefix = config('database.redis.options.prefix');
        $pattern = $redis_prefix . 'live_users:*';
        do {
            list($cursor, $keys) = Redis::scan($cursor, 'match', $pattern);
            $count += count($keys ?? []);
        } while ($cursor != 0);

        return $count;
    }

    public function render()
    {
        $this->liveUsersCount = $this->liveUsers();

        return view('osfrportal::livewire.admin.liveusers-count', ['liveUsersCount' => $this->liveUsersCount]);
    }
}