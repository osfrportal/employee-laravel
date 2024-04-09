<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Imports\SFRRcaAppointmentsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRRcaUnitsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRRcaEmployeeImport;

class SFRRcaImportController extends Controller
{
    public function runRcaFilesGet()
    {
        $statusImportPost = false;
        $statusImportOrg = false;
        $statusImportEmployee = false;

        $fileImportPost = null;
        $fileImportOrg = null;
        $fileImportEmployee = null;

        $storageRO = 'RCAimportRO';
        $folderRO = 'oim_arch';
        $filesRO = Storage::disk($storageRO)->files($folderRO);
        $dt = Carbon::now()->format('Ymd');
        $pregstring = sprintf('/^(oim_arch\/000_%s)(post|org|employee)_(.*)/i', $dt);
        $matchingFiles = preg_grep($pregstring, $filesRO);
        $countFiles = count($matchingFiles);
        if ($countFiles == 3) {
            foreach ($matchingFiles as $matchingFile) {
                if (preg_match(sprintf('/^(oim_arch\/000_%s)post_(.*)/i', $dt), $matchingFile)) {
                    $fileImportPost = $matchingFile;
                }
                if (preg_match(sprintf('/^(oim_arch\/000_%s)org_(.*)/i', $dt), $matchingFile)) {
                    $fileImportOrg = $matchingFile;
                }
                if (preg_match(sprintf('/^(oim_arch\/000_%s)employee_(.*)/i', $dt), $matchingFile)) {
                    $fileImportEmployee = $matchingFile;
                }
            }
            if (!is_null($fileImportPost)) {
                $importAppointments = new SFRRcaAppointmentsImport();
                $statusImportPost = $importAppointments->import($fileImportPost, $storageRO);
            }
            if (!is_null($fileImportOrg)&&($statusImportPost === true)) {
                $importUnits = new SFRRcaUnitsImport();
                $statusImportOrg = $importUnits->import($fileImportOrg, $storageRO);
            }
            if (!is_null($fileImportOrg)&&($statusImportPost === true)&&($statusImportOrg === true)) {
                $importEmployee = new SFRRcaEmployeeImport();
                $statusImportEmployee = $importEmployee->import($fileImportEmployee, $storageRO);
            }
            dump('DONE');
        }
    }
}
