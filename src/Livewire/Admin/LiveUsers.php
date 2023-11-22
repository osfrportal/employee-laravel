<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Redis;
use Osfrportal\OsfrportalLaravel\Actions\LiveUsersCountAction;

class LiveUsers extends Component
{
    public $liveUsersCount;

    public function render()
    {
        $this->liveUsersCount = LiveUsersCountAction::run();

        return view('osfrportal::livewire.admin.liveusers-count', ['liveUsersCount' => $this->liveUsersCount]);
    }
}
