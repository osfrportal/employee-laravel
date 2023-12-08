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

        $this->docsNotSignedCount = CountUnsignedDocsByUserAction::run();

        $text_to = sprintf('Вам необходимо ознакомиться с нормативными документами. <br> Кол-во документов: %s', $this->docsNotSignedCount);

        if($user->can('users-manage') && !Route::is('osfrportal.docs.*')) {
            $this->dispatch('docsnotsigned-message', $text_to);
        }

        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }

    public function gotoDocs()
    {
        $this->redirectRoute('osfrportal.docs.index');
    }



}
