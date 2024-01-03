<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


use Osfrportal\OsfrportalLaravel\Mail\SendPassword;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrDocTypes;
use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Models\SfrSignatures;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonMovements;
use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Data\SFRDocData;
use Osfrportal\OsfrportalLaravel\Data\SFRSignData;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;
use phpseclib3\File\X509;

use Illuminate\Support\Facades\Redis;

use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;

use Osfrportal\OsfrportalLaravel\Actions\GeneratePersonLoginPassAction;
use Osfrportal\OsfrportalLaravel\Actions\SendPasswordToUserAction;

class SFRPersonController extends Controller
{
    private $permissionManage = 'person-manage';
    private $permissionView = 'person-view';

    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */
    public function APIPersonsList()
    {
        $durationInSeconds = 1800;
        $redisKey = 'admin:persons:cache:listall';
        if (!Redis::exists($redisKey)) {
            $sfrpersonsFromDB = SFRPersonData::collection(SfrPerson::orderBy('psurname', 'ASC')->orderBy('pname', 'ASC')->with('SfrUser')->get())->toCollection();
            Redis::setex($redisKey, $durationInSeconds, json_encode($sfrpersonsFromDB));
        }
        //$this->authorize($this->permissionView);


        $sfrpersons = json_decode(Redis::get($redisKey));

        //return DataTables::of($sfrpersons)->toJson();
        return DataTables::of($sfrpersons)
            ->setRowClass(function ($person) {
                if ($person->persondata_appointment == '') {
                    return 'table-danger';
                }
                if ($person->persondata_vacation_end != '') {
                    return 'table-warning';
                }
            })
            ->setRowId(function ($person) {
                return $person->persondata_pid;
            })
            ->make(true);
    }

    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */

    public function ShowPersonsList()
    {
        $this->authorize($this->permissionView);

        return view('osfrportal::admin.persons.list_all');
    }

    private function getPersonDocsSigns(string $personId)
    {


        $filesList = [
            'docDateNumber',
            'docName',
            'docFileHash',
            'docSigned',
            'signCertHash',
            'signCertCN',
            'signCertValidDates',
            'signDateTime',
        ];
        $collectionDocs = collect();

        $allDocs = SfrDocs::where('doc_data->docNeedSign', true)->with(['SfrDocsFiles'])->get();
        foreach ($allDocs as $doc) {

            $docDataDTO = SFRDocData::forList($doc);
            $docType = SfrDocTypes::where('typeid', $docDataDTO->docType)->firstOrFail('type_name');
            $docGroup = SfrDocGroups::where('groupid', $docDataDTO->docGroup)->firstOrFail('group_name');
            $docDataDTO->docTypeName = $docType->type_name;
            $docDataDTO->docGroupName = $docGroup->group_name;
            $docDataDTO->docDate = Carbon::parse($docDataDTO->docDate)->format('d.m.Y');

            $docDateNumber = sprintf("№%s от %s", $docDataDTO->docNumber, $docDataDTO->docDate);

            $docDataDTO->docFiles = $doc->SfrDocsFiles;

            foreach ($doc->SfrDocsFiles as $docFile) {
                $sign = SfrSignatures::where('sign_fileid', $docFile->fileid)->where('sign_pid', $personId)->first();

                if (!is_null($sign)) {
                    $signDTO = SFRSignData::fromXML($sign);
                    $filesList_tmp = [
                        'docDateNumber' => $docDateNumber,
                        'docName' => $docDataDTO->docName,
                        'docTypeName' => $docDataDTO->docTypeName,
                        'docFileDescription' => $docFile->file_description,
                        'docSigned' => true,
                    ];
                    $filesList = Arr::collapse([$filesList_tmp, $signDTO->toArray()]);
                } else {
                    $filesList = [
                        'docDateNumber' => $docDateNumber,
                        'docName' => $docDataDTO->docName,
                        'docTypeName' => $docDataDTO->docTypeName,
                        'docFileDescription' => $docFile->file_description,
                        'docSigned' => false,
                    ];
                }
                $collectionDocs->push($filesList);
            }


        }
        return $collectionDocs;
    }

    public function ShowPersonDetail($personid)
    {
        $this->authorize($this->permissionView);

        $sfrperson = SfrPerson::where('pid', $personid)->with('SfrUser')->first();
        $SFRPersonData = SFRPersonData::from($sfrperson);
        $userlogin = GeneratePersonLoginPassAction::run($sfrperson);
        $SFRUserData = $sfrperson->SfrUser;
        $SFRPhoneContactData = SFRPhoneContactData::from($sfrperson);
        $SFRPersonCerts = $sfrperson->SfrPersonCerts;
        //$SFRPersonCrypto = SFRCryptoData::from($sfrperson->SfrPersonCrypto);
        $SFRPersonCrypto = $sfrperson->SfrPersonCrypto;
        $rfidKeysUser = $sfrperson->getPersonRfidCards();


        $docsSignsUser = $this->getPersonDocsSigns($personid);

        $SFRPersonStamps = $sfrperson->SfrPersonStamps;
        $logContext = [
            'personFullName' => $sfrperson->getFullName(),
            'personPid' => $sfrperson->getPid(),
        ];
        LogAddAction::run(LogActionsEnum::LOG_VIEW_PERSON(), 'Просмотр профиля работника {personFullName}, pid: {personPid}', $logContext);

        //dump($SFRPersonStamps);
        //dump($sfrperson->SfrPersonOrion->RfidCards);
        return view('osfrportal::admin.persons.detail', [
            'SFRPersonData' => $SFRPersonData,
            'SFRPhoneContactData' => $SFRPhoneContactData,
            'SFRPersonCerts' => $SFRPersonCerts,
            'SFRUserData' => $SFRUserData,
            'rfidKeysUser' => $rfidKeysUser,
            'docsSignsUser' => $docsSignsUser,
            'SFRPersonStamps' => $SFRPersonStamps,
            'SFRPersonCrypto' => $SFRPersonCrypto,
        ]);
    }

    public function genDocsSignListPrint($personid)
    {
        $sfrperson = SfrPerson::where('pid', $personid)->first();
        $SFRPersonData = SFRPersonData::from($sfrperson);

        $docsSignsUser = $this->getPersonDocsSigns($personid);
        return view('osfrportal::print.tmpl.docssigns', [
            'docsSignsUser' => $docsSignsUser,
            'SFRPersonData' => $SFRPersonData,
        ]);
    }
    public function sendRandPassword(Request $request)
    {
        $this->authorize($this->permissionView);

        $personid = $request->input('personid');
        $sfrperson = SfrPerson::where('pid', $personid)->first();
        $SFRPhoneContactData = SFRPhoneContactData::from($sfrperson);

        if (is_null($SFRPhoneContactData->email_ext)) {
            $this->flasher_interface->addError('Электронная почта работника не найдена.<br>Заполните данные в телефонном справочнике!');
            return back();
        } else {

            SendPasswordToUserAction::run($sfrperson);

            $this->flasher_interface->addSuccess('Пароль сгенерирован и отправлен на почту работнику');
            return redirect()->route('osfrportal.admin.persons.detail', ['personid' => $personid]);
        }
    }



    public function movementsAllShow(Request $request)
    {
        if ($request->ajax()) {
            $data = SfrPersonMovements::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        } else {
            return view('osfrportal::admin.persons.movements.movements_all');
        }
    }
}
