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
        if (Storage::disk($storage)->exists($filename)) {
            $path = Storage::disk($storage)->path($filename);
            $import = new SFRRcaAppointmentsImport();
            $import->import($path);
        }
    }
}
