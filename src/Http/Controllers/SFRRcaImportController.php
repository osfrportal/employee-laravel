<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Imports\SFRRcaAppointmentsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRRcaUnitsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRRcaEmployeeImport;

class SFRRcaImportController extends Controller
{
    public function runAppointmentsImport()
    {
        $filename = '000_20240408post.xml';
        $storage = 'imports';

        $import = new SFRRcaAppointmentsImport();
        $import->import($filename, $storage);

    }
    public function runUnitsImport()
    {
        $filename = '000_20240408org.xml';
        $storage = 'imports';

        $import = new SFRRcaUnitsImport();
        $import->import($filename, $storage);

    }

    public function runEmployeeImport()
    {
        $filename = '000_20240408employee.xml';
        $storage = 'imports';

        $import = new SFRRcaEmployeeImport();
        $import->import($filename, $storage);

    }

    public function runRcaFilesGet()
    {
        $storageRO = 'RCAimportRO';
        $folderRO = 'oim_arch';
        $filesRO = Storage::disk($storageRO)->files($folderRO);
        $dt = Carbon::now()->format('Ymd');
        dump($dt);
        $pregstring = sprintf('/^(oim_arch\/000_%s)(post|org|employee)_(.*)/i', $dt);
        $matchingFiles = preg_grep($pregstring, $filesRO);
        dump($matchingFiles);
        $storageRW = 'imports';
        $folderRW = '';
    }
}
