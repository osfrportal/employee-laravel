<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

class SFRPersonController extends Controller
{
    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */
    public function APIPersonsList()
    {
        //$sfrpersons = SfrPerson::with('PersonDekret','PersonVacation', 'PersonTabNum', 'PersonAppointment', 'PersonUnit')->orderBy('psurname', 'ASC')->orderBy('pname', 'ASC')->get();
        $with_relations = [
            'SfrPersonContacts',
            'SfrPersonVacation',
            'SfrPersonDekret',
        ];
        $sfrpersons = SfrPerson::with($with_relations)->orderBy('psurname', 'ASC')->orderBy('pname', 'ASC')->get();
        //$sfrpersons = SfrPerson::orderBy('psurname', 'ASC')->orderBy('pname', 'ASC')->get();
        return DataTables::of($sfrpersons)->toJson();
    }

    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */

    public function ShowPersonsList()
    {
        return view('osfrportal::admin.persons.list_all');
    }
}