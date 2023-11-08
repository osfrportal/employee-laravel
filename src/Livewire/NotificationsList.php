<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationsList extends Component
{
    public $unreadNotifications;

    public function goDashboard()
    {
        return redirect()->route('osfrportal.dashboard');
    }
    public function markRead($nid)
    {
        Auth::user()->unreadNotifications->where('id', $nid)->markAsRead();
    }
    public function render()
    {
        $user = auth()->user();

        $this->unreadNotifications = $user->unreadNotifications;

        return view('osfrportal::livewire.notifications-list', ['unreadNotifications' => $this->unreadNotifications]);
    }
}
