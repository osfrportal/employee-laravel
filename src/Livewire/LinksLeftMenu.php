<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Osfrportal\OsfrportalLaravel\Models\SfrLinks;

class LinksLeftMenu extends Component
{
    public function render()
    {
        $links = SfrLinks::where('linkshowinleftmenu', true)->orderBy('linksortorder', 'ASC')->orderBy('linkname', 'ASC')->get();
        return view('osfrportal::livewire.leftmenuLinks', ['leftmenuLinks' => $links]);
    }
}
