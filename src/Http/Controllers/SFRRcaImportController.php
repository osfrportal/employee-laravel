<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Support\Facades\Storage;


use Osfrportal\OsfrportalLaravel\Imports\SFRRcaAppointmentsImport;


class SFRRcaImportController extends Controller
{
    public function runAppointmentsImport()
    {
        $filename = '000_20240408post.xml';
        $storage = 'imports';

            $import = new SFRRcaAppointmentsImport();
            $import->import($filename, $storage);

    }
}
