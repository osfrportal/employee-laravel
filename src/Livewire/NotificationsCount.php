<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;

class NotificationsCount extends Component
{
    public $unreadNotificationsCount;

    public function render()
    {
        $user = auth()->user();
        if (!is_null($user)) {
            $this->unreadNotificationsCount = $user->getUnreadNotifications();
        } else {
            $this->unreadNotificationsCount = 0;
        }


        return view('osfrportal::livewire.notifications-count', ['unreadNotificationsCount' => $this->unreadNotificationsCount]);
    }
}
