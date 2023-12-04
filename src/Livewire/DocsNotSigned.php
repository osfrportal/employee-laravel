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


        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }
}
