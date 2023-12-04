<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;

class DocsNotSigned extends Component
{
    public $docsNotSignedCount;

    public function render()
    {
        $this->docsNotSignedCount = 10;


        return view('osfrportal::livewire.docsnotsigned-count', ['docsNotSignedCount' => $this->docsNotSignedCount]);
    }
}
