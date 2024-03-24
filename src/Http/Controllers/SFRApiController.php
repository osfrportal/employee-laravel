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
use Yajra\DataTables\DataTables;

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
use Osfrportal\OsfrportalLaravel\Actions\Api\Select2DocsAllGroupedAction;
use Osfrportal\OsfrportalLaravel\Actions\Api\Select2InfosystemsAllGroupedAction;
use Osfrportal\OsfrportalLaravel\Actions\Api\Select2InfosystemByIDAction;
use Osfrportal\OsfrportalLaravel\Actions\Api\Select2DocTypeByIDAction;
use Osfrportal\OsfrportalLaravel\Actions\Api\Select2DocGroupByIDAction;
use Osfrportal\OsfrportalLaravel\Actions\Orion\GetAccessPointsByCardIdAction;
use Osfrportal\OsfrportalLaravel\Actions\Crypto\CryptoListAllAction;

use Osfrportal\OsfrportalLaravel\Services\SFRPersonService;

class SFRApiController extends Controller
{
    public function apiSelect2UnitsAll(Request $request)
    {
        $data = Select2UnitsAllAction::run();
        return $data;
    }

    public function apiSelect2DocsGroupedAll(Request $request)
    {
        $data = Select2DocsAllGroupedAction::run();
        return $data;
    }

    public function apiSelect2DocTypeByID(Request $request)
    {
        $data = Select2DocTypeByIDAction::run();
        return $data;
    }
    public function apiSelect2DocGroupByID(Request $request)
    {
        $data = Select2DocGroupByIDAction::run();
        return $data;
    }


    public function apiGetAccessPointsByCardId(int $cardid)
    {
        $data = GetAccessPointsByCardIdAction::run($cardid);
        return $data;
    }

    public function apiSelect2InfosystemsGroupedAll(Request $request)
    {
        $data = Select2InfosystemsAllGroupedAction::run();
        return $data;
    }
    public function apiSelect2InfosystemByID($isysid)
    {
        $data = Select2InfosystemByIDAction::run($isysid);
        return $data;
    }

    public function apiCryptoListAll()
    {
        $data = CryptoListAllAction::run();
        return DataTables::of($data)->make(true);
    }
    /**
     * API интерфейс для вывода информации о работнике
     * Использутеся для Ajax запроса формой select2
     * @param string $searchq
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiSelect2PersonsList(string $searchq, SFRPersonService $sfrpersonservice)
    {
        $tmp = $sfrpersonservice->APIPersonsSearchSelect2($searchq);
        return response()->json(data: $tmp, options: JSON_UNESCAPED_UNICODE);
    }
}
