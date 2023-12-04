<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Osfrportal\OsfrportalLaravel\Actions\Docs\CountUnsignedDocsByUserAction;

class DocsNotSigned extends Component
{
    protected $listeners = ['movetodocs'];

    public $docsNotSignedCount;

    public function render()
    {
        $docsUnsignedCount = CountUnsignedDocsByUserAction::run();

        $this->docsNotSignedCount = $docsUnsignedCount;

        //$this->alertConfirm();

        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }

    public function alertConfirm()
    {
        $text_to = sprintf('Вам необходимо ознакомиться с нормативными документами. Кол-во документов: %s', $this->docsNotSignedCount);
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'message' => 'Необходимо ознакомление с документами',
                'text' => $text_to,
                'action' => 'movetodocs'
            ]);
    }

    public function movetodocs()
    {
        return redirect()->route('osfrportal.docs.index');
    }

}
