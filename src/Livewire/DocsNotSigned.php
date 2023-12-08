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

        $user = Auth::user();

        $currentRoute = Route::getCurrentRoute();

        $this->docsNotSignedCount = CountUnsignedDocsByUserAction::run();

        $text_to = sprintf('Вам необходимо ознакомиться с нормативными документами. Кол-во документов: %s', $this->docsNotSignedCount);

        if($user->can('users-manage')) {
            $this->dispatch('docsnotsigned-message', $text_to);
        }

        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }



}
