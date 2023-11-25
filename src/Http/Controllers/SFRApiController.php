<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrDocTypes;
use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Models\SfrSignatures;
use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Data\SFRDocData;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use phpseclib3\File\X509;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Osfrportal\OsfrportalLaravel\Exports\SFRDocsSignsExport;
use Illuminate\Support\Facades\Log;

use Osfrportal\OsfrportalLaravel\Actions\Api\Select2UnitsAllAction;

class SFRApiController extends Controller
{
    public function apiSelect2UnitsAll(Request $request)
    {
        $data = Select2UnitsAllAction::make();
        return response()->json(data: $data, options: JSON_UNESCAPED_UNICODE);
    }
}
