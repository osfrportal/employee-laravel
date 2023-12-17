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
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Data\SFRDocData;
use Osfrportal\OsfrportalLaravel\Data\SFRSignData;
use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Osfrportal\OsfrportalLaravel\Data\Crypto\SFRCryptoData;
use phpseclib3\File\X509;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Osfrportal\OsfrportalLaravel\Exports\SFRDocsSignsExport;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    /**
     * Обновление пароля пользователем
     * @param Request $request
     * @return Response
     */
    public function passwordChange(Request $request)
    {
        $input = $request->all();

        $validation_rules = [
            'inputCurrentPassword' => 'current_password',
            'inputNewPassword' => 'required|min:8',
            'inputNewPassword2' => 'required|same:inputNewPassword',
        ];
        $validation_messages = [
            'same' => 'Новый пароль и его подтверждение не совпадают',
            'required' => 'Поле не заполнено',
            'min' => 'Не менее 8 знаков',
            'current_password' => 'Текущий пароль указан не верно',
        ];


        $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
        if ($validator->fails()) {
            $this->flasher_interface->addError('Проверьте заполненные данные и повторите сохранение.');
            return back()
                ->withErrors($validator);
        }


        $validatedData = $validator->validated();

        $user = SfrUser::find(Auth::user()->userid);
        $user->update(['password' => Hash::make($validatedData['inputNewPassword'])]);
        $this->flasher_interface->addSuccess('Пароль изменен');
        Log::info('Пользователь изменил свой пароль', ['person' => $user->getFullName(), 'pid' => $user->getPid(),]);

        return back();
    }

    public function profileIndex()
    {
        $person_data = new SFRPersonData(
            persondata_pid: Auth::user()->SfrPerson->getPid(),
            persondata_fullname: Auth::user()->SfrPerson->getFullName(),
            persondata_birthday: Auth::user()->SfrPerson->getBirthDate(),
            persondata_inn: Auth::user()->SfrPerson->getINN(),
            persondata_snils: Auth::user()->SfrPerson->getSNILS(),
            persondata_appointment: Auth::user()->SfrPerson->getAppointment(),
            persondata_tabnum: Auth::user()->SfrPerson->getTabNum(),
            persondata_unit_name: Auth::user()->SfrPerson->getUnit(),
        );
        $contact_data = SFRPhoneContactData::from(Auth::user()->SfrPerson->SfrPersonContacts->contactdata);

        return view('osfrportal::sections.profile.index', ['SFRPersonData' => $person_data, 'SFRPhoneContactData' => $contact_data]);
    }
    public function profileUsbSkdCerts()
    {
        $certsUser = Auth::user()->SfrPerson->SfrPersonCerts;
        $rfidKeysUser = Auth::user()->SfrPerson->getPersonRfidCards();
        $stampsUser = Auth::user()->SfrPerson->SfrPersonStamps;
        $cryptoUser = SFRCryptoData::from(Auth::user()->SfrPerson->SfrPersonCrypto->cryptodata);

        return view('osfrportal::sections.profile.usbskdcerts', [
            'certsUser' => $certsUser,
            'rfidKeysUser' => $rfidKeysUser,
            'stampsUser' => $stampsUser,
            'cryptoUser' => $cryptoUser,
        ]);
    }

    public function genDocsSignListPrint()
    {
        $sfrperson = Auth::user()->SfrPerson;
        $personid = Auth::user()->SfrPerson->getPid();
        $SFRPersonData = SFRPersonData::from($sfrperson);

        $docsSignsUser = $this->getPersonDocsSigns($personid);
        //return Excel::download(new SFRDocsSignsExport($docsSignsUser, $SFRPersonData), 'signs.pdf', \Maatwebsite\Excel\Excel::TCPDF);
        return view('osfrportal::print.tmpl.docssigns', [
            'docsSignsUser' => $docsSignsUser,
            'SFRPersonData' => $SFRPersonData,
        ]);
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
            //$docType = SfrDocTypes::where('typeid', $docDataDTO->docType)->firstOrFail('type_name');
            //$docGroup = SfrDocGroups::where('groupid', $docDataDTO->docGroup)->firstOrFail('group_name');
            //$docDataDTO->docTypeName = $docType->type_name;
            //$docDataDTO->docGroupName = $docGroup->group_name;
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
}
