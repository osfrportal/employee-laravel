<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Osfrportal\OsfrportalLaravel\Actions\Docs\CountUnsignedDocsByUserAction;


class DocsNotSigned extends Component
{
    protected $listeners = [
        'isConfirmed',
    ];

    public $docsNotSignedCount;
    public $flasher_interface;

    public function isConfirmed(array $payload)
    {
        $this->redirectRoute('osfrportal.docs.index');
    }

    public function render()
    {
        $this->flasher_interface = flash()
            ->options([
                'timeout' => '10000',
                'layout' => 'topCenter',
                'modal' => true,
                'closeWith' => ['click', 'button'],
                'theme' => 'bootstrap-v5'
            ]);

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
