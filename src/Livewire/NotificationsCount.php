<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;

class NotificationsCount extends Component
{
    public $unreadNotificationsCount;

    public function render()
    {
        $user = auth()->user();

        $this->unreadNotificationsCount = $user->unreadNotifications->count();

        return view('osfrportal::livewire.notifications-count', ['unreadNotificationsCount' => $this->unreadNotificationsCount]);
    }
}