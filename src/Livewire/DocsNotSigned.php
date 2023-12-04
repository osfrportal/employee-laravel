<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Osfrportal\OsfrportalLaravel\Actions\Docs\CountUnsignedDocsByUserAction;

class DocsNotSigned extends Component
{
    protected $listeners = ['sweetalertConfirmed'];

    public $docsNotSignedCount;

    public function render()
    {
        $docsUnsignedCount = CountUnsignedDocsByUserAction::run();

        $this->docsNotSignedCount = $docsUnsignedCount;

        $text_to = sprintf('Вам необходимо ознакомиться с нормативными документами. Кол-во документов: %s', $this->docsNotSignedCount);

        sweetalert()
            ->position('center')
            ->showConfirmButton()
            ->confirmButtonText('Перейти')
            ->showCancelButton()
            ->cancelButtonText('Отмена')
            ->addInfo($text_to);

        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }

    public function sweetalertConfirmed(array $payload)
    {
        return redirect()->route('osfrportal.docs.index');
    }

}
