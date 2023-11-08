<?php

namespace Osfrportal\OsfrportalLaravel\Livewire;

use Livewire\Component;
use Osfrportal\OsfrportalLaravel\Models\SfrLinks;
use Osfrportal\OsfrportalLaravel\Models\SfrLinkGroups;

class LinksMainPage extends Component
{
    public function render()
    {
        $groupedLinks = SfrLinkGroups::where('grlparentid', '=', '0')->orderBy('grlsortorder', 'ASC')->with('children')->orderBy('grlname', 'ASC')->with('SfrLinks')->get();
        $rootLinks = SfrLinks::doesntHave('LinkGroup')->orderBy('linksortorder', 'ASC')->orderBy('linkname', 'ASC')->get();
        return view('osfrportal::livewire.mainPageLinks', ['groupedLinks' => $groupedLinks, 'rootLinks' => $rootLinks]);
    }
}
