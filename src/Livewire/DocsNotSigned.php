<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Osfrportal\OsfrportalLaravel\Actions\Docs\CountUnsignedDocsByUserAction;


class DocsNotSigned extends Component
{
    public $docsNotSignedCount;

    public function render()
    {
        $docsUnsignedCount = CountUnsignedDocsByUserAction::run();

        $this->docsNotSignedCount = $docsUnsignedCount;

        $text_to = sprintf('Вам необходимо ознакомиться с нормативными документами. Кол-во документов: %s', $this->docsNotSignedCount);
        flash()->addWarning($text_to);
/*
        sweetalert()
            ->timer(0)
            ->backdrop(false)
            ->position('center')
            ->showConfirmButton()
            ->confirmButtonText('ОК')
            ->showCloseButton(false)
            ->addWarning($text_to);
*/
        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }



}
