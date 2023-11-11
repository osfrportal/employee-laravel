<?php
namespace Osfrportal\OsfrportalLaravel\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SFRDocsSignsExport implements FromView
{
    private $docsSignsUser;
    private $SFRPersonData;

    public function __construct($docsSignsUser, $SFRPersonData)
    {
        $this->docsSignsUser = $docsSignsUser;
        $this->SFRPersonData = $SFRPersonData;
    }
    public function view(): View
    {
        return view('osfrportal::print.tmpl.docssigns', [
            'docsSignsUser' => $this->docsSignsUser,
            'SFRPersonData' => $this->SFRPersonData,
        ]);
    }
}
