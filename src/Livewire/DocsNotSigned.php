<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Osfrportal\OsfrportalLaravel\Actions\Docs\CountUnsignedDocsByUserAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DocsNotSigned extends Component
{
    public $docsNotSignedCount;
    public function render()
    {
        $userAdminRoles = ['Super Admin', 'ozi-admin', 'ozi-staff'];
        $user = Auth::user();
        $isAdminRole = $user->hasRole($userAdminRoles);

        $this->docsNotSignedCount = CountUnsignedDocsByUserAction::run();

        $text_to = sprintf('Вам необходимо ознакомиться с нормативными документами. Кол-во документов: %s', $this->docsNotSignedCount);

        if (($this->docsNotSignedCount > 0) && (!$isAdminRole)) {
            $this->dispatch('docsnotsigned-message', $text_to);
        }

        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }

    public function gotoDocs()
    {
        $this->redirectRoute('osfrportal.docs.index');
    }



}
