<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum;
use Osfrportal\OsfrportalLaravel\Data\SFRDocData;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrDocTypes;
use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Models\SfrSignatures;
use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Models\SfrFiles;

use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUnepController;


class SfrDocsController extends Controller
{
    private function logSign($signdata)
    {
        Log::info('Ознакомление с документом', [
            'signdata' => $signdata,
        ]);
    }
    public function apiGenXMLtoSign(string $docid, string $fileid)
    {
        $doc = SfrDocs::where('docid', $docid)->first();
        $docDataDTO = SFRDocData::forList($doc);
        $docFile = SfrFiles::where('fileid', $fileid)->first();
        //dd($docFile);
        $sxe = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="no" ?><Envelope xmlns="urn:envelope"></Envelope>');
        $xml_body = $sxe->addChild('Body');
        $xml_data = $xml_body->addChild('Data');
        $xml_data->addAttribute('xml:id', 'dataToSign');
        $xml_data->addChild('portalUser', Auth::user()->username);
        $xml_data->addChild('portalPersonUUID', Auth::user()->pid);
        $xml_data->addChild('docSignName', $docDataDTO->docName);
        $xml_data->addChild('docSignFileUUID', $fileid);
        $xml_data->addChild('docSignFileHashGOST', $docFile->file_gosthash);
        $xml_data->addChild('docSignTimestamp', Carbon::now());
        $xmlToSign = $sxe->asXML();
        $xmlToSign = strtr($xmlToSign, array("\n" => ''));
        $encodedXML = base64_encode($xmlToSign);
        return response()->json(['status' => 200, 'data' => $encodedXML]);

    }

    public function apiSaveUNEPSign(Request $request) {
        $validator = Validator::make($request->all(), [
            'sign_fileId' => 'required|uuid',
            'sign_docId' => 'required|uuid',
            'sign_personId' => 'required|uuid',
            'sign_xml' => 'required',
            'sign_unepid' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'data' => $validator->messages()], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();
        $sign_controller = App::make(SFRUnepController::class);
        $sign_data = $sign_controller->signXMLUnep($validated['sign_xml'], $validated['sign_unepid']);



        $sign = new SfrSignatures;
        $sign->sign_fileid = $validated['sign_fileId'];
        $sign->sign_docid = $validated['sign_docId'];
        $sign->sign_pid = $validated['sign_personId'];
        $sign->sign_data = $sign_data;
        $sign->sign_type = CertsTypesEnum::UNEP();
        $sign->save();
        $this->logSign($sign);
        return response()->json(['status' => 200, 'data' => $sign_data], Response::HTTP_OK);

    }

    public function apiSaveUKEPSignToDB(Request $request) {
        $validator = Validator::make($request->all(), [
            'sign_fileId' => 'required|uuid',
            'sign_docId' => 'required|uuid',
            'sign_personId' => 'required|uuid',
            'sign_data' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'data' => $validator->messages()], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();

        $sign = new SfrSignatures;
        $sign->sign_fileid = $validated['sign_fileId'];
        $sign->sign_docid = $validated['sign_docId'];
        $sign->sign_pid = $validated['sign_personId'];
        $sign->sign_data = base64_decode($validated['sign_data']);
        $sign->sign_type = CertsTypesEnum::UKEP();
        $sign->save();
        $this->logSign($sign);
        return response()->json(['status' => 200, 'data' => $request->input(['sign_fileId'])], Response::HTTP_OK);
    }


    public function docsIndex()
    {
        $certListIDsCollection = collect();

        $certIdUNEP = Auth::user()->SfrPerson->getCertIdUNEP();
        $certIdUKEP = Auth::user()->SfrPerson->getCertIdUKEP();

        //Проверяем каким сертификатом будем подписывать
        $certToUse = CertsTypesEnum::NONE();

        if (!is_null($certIdUNEP)) {
            $certToUse = CertsTypesEnum::UNEP();
            $certListIDsCollection->push($certIdUNEP);
        }

        if ($certIdUKEP->count() > 0) {
            foreach ($certIdUKEP as $certUKEP) {

                $certListIDsCollection->push($certUKEP->certserial);
            }
            $certToUse = CertsTypesEnum::UKEP();
        }
        $certListIDs = $certListIDsCollection->implode(';');

        $collectionDocs = collect();
        $collectionSigns = collect();
        $allDocs = SfrDocs::where('doc_data->docNeedSign', true)->with(['SfrDocsFiles', 'SfrDocsUserSigns'])->get();
        foreach ($allDocs as $doc) {
            foreach ($doc->SfrDocsUserSigns as $s) {
                $collectionSigns->push([
                    'sign_fileid' => $s['sign_fileid'],
                    'sign_pid' => $s['sign_pid']
                ]);
            }

            $docDataDTO = SFRDocData::forList($doc);
            $docType = SfrDocTypes::where('typeid', $docDataDTO->docType)->firstOrFail('type_name');
            $docGroup = SfrDocGroups::where('groupid', $docDataDTO->docGroup)->firstOrFail('group_name');
            $docDataDTO->docTypeName = $docType->type_name;
            $docDataDTO->docGroupName = $docGroup->group_name;
            $docDataDTO->docDate = Carbon::parse($docDataDTO->docDate)->format('d.m.Y');
            $docDataDTO->docFiles = $doc->SfrDocsFiles;
            $collectionDocs->push($docDataDTO);

        }
        $docsToSign = $collectionDocs;
        return view('osfrportal::sections.docs.docs_list', ['docsToSign' => $docsToSign, 'certToUse' => $certToUse, 'certListIDs' => $certListIDs, 'docFileSigns' => $collectionSigns]);
    }

    public function docsCard(string $docid)
    {
        return view('osfrportal::sections.docs.docs_card');
    }


}
