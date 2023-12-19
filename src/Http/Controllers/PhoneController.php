<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Yajra\Datatables\Datatables as Datatables;
use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Models\SfrDialplan;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonContacts;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneData;

use Osfrportal\OsfrportalLaravel\Exports\SFRPhonesToXLSXExport;
use Osfrportal\OsfrportalLaravel\Exports\SFRVipnetToXLSXExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Log;
use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

use Illuminate\Support\Facades\Redis;

class PhoneController extends Controller
{
    private $result_collection;
    private $permissionExportPD = 'export-phones-pd';

    private $durationInSeconds = 600;
    private $redisKey = 'phone:cache';

    private function sortDialPlanArrayByField($arr_to_sort)
    {
        $array_name = [];

        foreach ($arr_to_sort as $key => $row) {
            $array_name[$key] = $row['dialplan_len'];
        }

        array_multisort($array_name, SORT_ASC, $arr_to_sort);
        return $arr_to_sort;
    }

    public function phoneIndex()
    {
        return view('osfrportal::sections.phone.index');
    }
    /**
     * Ищем адрес по внутреннему номеру.
     * возвращаем строку или null
     *
     * @param integer $phone_internal
     * @return string
     */
    private function addressByInternalNumber($phone_internal)
    {
        $dialplan_collection = SfrDialplan::with('addressFull')->where('dpnumstart', '<=', $phone_internal)->where('dpnumend', '>=', $phone_internal)->get();


        $numplan_array = array();
        foreach ($dialplan_collection->all() as $dialplan) {
            $dialplan_len = $dialplan->dpnumend - $dialplan->dpnumstart;
            $tmp_arr = ['dpid' => $dialplan->dpid, 'dpnumstart' => $dialplan->dpnumstart, 'dpnumend' => $dialplan->dpnumend, 'dialplan_len' => $dialplan_len, 'paddress' => $dialplan->addressFull->paddress];
            array_push($numplan_array, $tmp_arr);
        }
        $numplan_array_sorted = $this->sortDialPlanArrayByField($numplan_array);

        return Arr::get($numplan_array_sorted, '0.paddress', null);
    }
    /**
     * Ищем код города внутреннему номеру.
     * возвращаем строку или null
     *
     * @param integer $phone_internal
     * @return string
     */
    private function areacodeByInternalNumber($phone_internal)
    {
        $dialplan_collection = SfrDialplan::with('addressFull')->where('dpnumstart', '<=', $phone_internal)->where('dpnumend', '>=', $phone_internal)->get();


        $numplan_array = array();
        foreach ($dialplan_collection->all() as $dialplan) {
            $dialplan_len = $dialplan->dpnumend - $dialplan->dpnumstart;
            $tmp_arr = ['dpid' => $dialplan->dpid, 'dpnumstart' => $dialplan->dpnumstart, 'dpnumend' => $dialplan->dpnumend, 'dialplan_len' => $dialplan_len, 'paddress' => $dialplan->addressFull->paddress, 'areacode' => $dialplan->addressFull->areacode];
            array_push($numplan_array, $tmp_arr);
        }
        $numplan_array_sorted = $this->sortDialPlanArrayByField($numplan_array);
        return Arr::get($numplan_array_sorted, '0.areacode', null);
    }
    public function doUpdateContacts(Request $request)
    {

        $validation_rules = [
            'inputEmailAddress' => 'email:rfc,strict|ends_with:@48.sfr.gov.ru',
            'inputPhoneInt' => 'required|digits:4',
            'inputPhoneExt' => 'required|digits_between:5,6',
            'inputRoom' => 'required|alpha_dash|max:30',
            'inputPhoneMobile' => 'nullable|numeric|digits:10',
            'personid' => 'required|uuid',
        ];
        $validation_messages = [
            'inputRoom.required' => 'Не указано помещение',
            'inputPhoneMobile.digits' => 'Номер мобильного телефона должен содержать 10 цифр',
            'inputEmailAddress' => 'Не указан корректный адрес электронной почты. Адрес электронной почты должен заканчиваться на следующее значения: @48.sfr.gov.ru',
        ];


        $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
        if ($validator->fails()) {
            //dd($validator->errors());
            $this->flasher_interface->addError('Проверьте заполненные данные и повторите сохранение.');
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $current_user = Auth::user();


        $validatedData = $validator->validated();
        $person_data = SfrPerson::with('SfrPersonContacts')->where('pid', $validatedData['personid'])->first();


        $person_contactdata_DTO = new SfrPhoneContactData();
        $person_contactdata_DTO->room = $validatedData['inputRoom'];
        $person_contactdata_DTO->address = $this->addressByInternalNumber($validatedData['inputPhoneInt']);

        $person_contactdata_DTO->email_ext = Str::lower($validatedData['inputEmailAddress']);
        $person_contactdata_DTO->phone_external = $validatedData['inputPhoneExt'];
        $person_contactdata_DTO->phone_internal = $validatedData['inputPhoneInt'];
        $person_contactdata_DTO->phone_mobile = $validatedData['inputPhoneMobile'];
        $person_contactdata_DTO->areacode = $this->areacodeByInternalNumber($validatedData['inputPhoneInt']);

        $contactdata_collection_json = $person_contactdata_DTO->toJson(JSON_UNESCAPED_UNICODE);


        if (!is_null($person_data->SfrPersonContacts)) {
            $contactdata_old = $person_data->SfrPersonContacts->contactdata;
            $person_data->SfrPersonContacts->contactdata = $contactdata_collection_json;
            $person_data->SfrPersonContacts->save();
        } else {
            $contactdata_old = '';
            $contactdata = new SfrPersonContacts(['contactdata' => $contactdata_collection_json]);

            $person_data->SfrPersonContacts()->save($contactdata);
        }

        $logContext = [
            'personFullName' => $person_data->getFullName(),
            'personPid' => $person_data->getPid(),
            'contactdata_new' => $contactdata_collection_json,
            'contactdata_old' => $contactdata_old,
        ];
        LogAddAction::run(LogActionsEnum::LOG_PHONE_UPDATE(), 'Обновлены контактные данные работника {personFullName}', $logContext);
        Redis::del($this->redisKey);


        $this->flasher_interface->addSuccess('Данные успешно обновлены');
        return back();
    }
    public function phoneShowEditForm(Request $request)
    {
        $validatedData = Validator::make($request->route()->parameters(), [
            'personid' => 'required|uuid',
        ])->validated();
        $person = SfrPerson::where('pid', $validatedData['personid'])->first();

        $person_data = new SFRPersonData(
            persondata_pid: $person->getPid(),
            persondata_fullname: $person->getFullName(),
        );
        if (!is_null($person->getPersonContactData())) {
            $contact_data = SFRPhoneContactData::from($person->getPersonContactData());
        } else {
            $contact_data = new SFRPhoneContactData;
        }

        return view('osfrportal::sections.phone.editform', ['SFRPersonData' => $person_data, 'SFRPhoneContactData' => $contact_data]);
    }

    public function convertPersonContactData($person_data_collection, $unit_collection = null)
    {
        foreach ($person_data_collection as $person) {


            if (isset($unit_collection)) {
                $contactdata_unit_name = $unit_collection->unitname;
                $contactdata_unit_name_always = $unit_collection->unitname;
                $contactdata_unit_id = $unit_collection->unitid;
                $contactdata_unit_parentid = $unit_collection->unitparentid;
            } else {
                if (!is_null($person->SfrPersonUnit->first())) {
                    $contactdata_unit_name = $person->SfrPersonUnit->first()->unitname;
                    $contactdata_unit_id = $person->SfrPersonUnit->first()->unitid;
                    $contactdata_unit_parentid = $person->SfrPersonUnit->first()->unitparentid;
                    $contactdata_unit_name_always = $person->SfrPersonUnit->first()->unitname;
                }
            }
            if (!is_null($contactdata_unit_parentid)) {
                $contactdata_unit_parent_name = SfrUnits::find($contactdata_unit_parentid)->only(['unitname'])['unitname'];
            } else {
                $contactdata_unit_parent_name = $contactdata_unit_name;
                $contactdata_unit_name = null;
            }
            $person_vacation = $person->getPersonVacationNow();
            if (!is_null($person_vacation)) {
                $contactdata_vacation = sprintf("%s - %s", Carbon::parse($person_vacation->vacationstart)->format('d.m.Y'), Carbon::parse($person_vacation->vacationend)->format('d.m.Y'));
                $contactdata_vacation_end = Carbon::parse($person_vacation->vacationend)->format('d.m.Y');
            } else {
                $contactdata_vacation = null;
                $contactdata_vacation_end = null;
            }

            $person_dekret = $person->getPersonDekretNow();
            if (!is_null($person_dekret)) {
                $contactdata_dekret_end = Carbon::parse($person_dekret->dekretend)->format('d.m.Y');
            } else {
                $contactdata_dekret_end = null;
            }

            $person_absence = $person->getPersonAbsenceNow();
            //dump($person_absence);
            if (!is_null($person_absence)) {
                $contactdata_absence_end = Carbon::parse($person_absence->absenceend)->format('d.m.Y');
            } else {
                $contactdata_absence_end = null;
            }

            $person_data = new SFRPersonData(
                persondata_pid: $person->getPid(),
                persondata_fullname: $person->getFullName(),
                persondata_appointment: $person->getAppointment(),
                persondata_vacation: $contactdata_vacation,
                persondata_vacation_end: $contactdata_vacation_end,
                persondata_dekret_end: $contactdata_dekret_end,
                persondata_absence_end: $contactdata_absence_end,
            );
            if (isset($person->SfrPersonContacts->contactdata)) {
                $contact_data = SFRPhoneContactData::from($person->SfrPersonContacts->contactdata);
                $contact_data->email_ext = Str::lower($contact_data->email_ext);
            } else {
                $contact_data = new SFRPhoneContactData;
            }





            $unit_col = [
                'contactdata_unit_name' => $contactdata_unit_name,
                'contactdata_unit_name_always' => $contactdata_unit_name_always,
                'contactdata_unit_id' => $contactdata_unit_id,
                'contactdata_unit_parentid' => $contactdata_unit_parentid,
                'contactdata_unit_parent_name' => $contactdata_unit_parent_name,
                'contactdata_person' => $person_data,
                'contactdata_phone_data' => $contact_data,
            ];

            $cd = SFRPhoneData::from($unit_col);
            //printf('%s %s %s', $contactdata_unit_name_always, $contactdata_unit_id, $cd->contactdata_unit_name_always);
            $this->result_collection->push($cd);
            //dump($cd);
        }
        //return $this->result_collection;
    }
    public function convertPersonsFromUnit($unit_data)
    {
        $this->result_collection = collect();

        foreach ($unit_data as $root) {
            $PFRPersons_sorted = $root->SfrPersons->sortBy(function ($person, $key) {
                //dump($person);
                foreach ($person->SfrPersonAppointment as $PersonAppointment) {
                    return $PersonAppointment->asortorder;
                }
            });
            //dump($PFRPersons_sorted);

            $this->convertPersonContactData($PFRPersons_sorted, $root);

            foreach ($root->children as $child) {
                $PFRPersons_sorted = $child->SfrPersons->sortBy(function ($person, $key) {
                    foreach ($person->SfrPersonAppointment as $PersonAppointment) {
                        return $PersonAppointment->asortorder;
                    }
                });
                $this->convertPersonContactData($PFRPersons_sorted, $child);
            }
        }
        return $this->result_collection;
    }

    public function apiPhonesData()
    {
        if (!Redis::exists($this->redisKey)) {
            $unitsAllFromDB = SfrUnits::whereNull('unitparentid')->orderBy('unitsortorder', 'ASC')->with('children')->orderBy('unitname', 'ASC')->with('SfrPersons')->get();
            $units_all = $this->convertPersonsFromUnit($unitsAllFromDB);
            Redis::setex($this->redisKey, $this->durationInSeconds, json_encode($units_all));            
        }

        $units_all = json_decode(Redis::get($this->redisKey));

        return Datatables::of($units_all)
            ->addColumn('action', function ($user) {
                $url = route('osfrportal.phone.editform', ['personid' => $user->contactdata_person->persondata_pid]);
                //$url = $user->contactdata_person->persondata_pid;
                $html_url = "&nbsp";
                if (is_null($user->contactdata_person->persondata_dekret_end)) {
                    $html_url = sprintf('<a href="%s"><span class="bi bi-pencil-square"></span></a>', $url);
                }
                return $html_url;
            })
            ->setRowClass(function ($user) {
                if ($user->contactdata_person->persondata_absence_end != '') {
                    return 'bg-info opacity-50';
                }
                if ($user->contactdata_person->persondata_vacation_end != '') {
                    //return 'bg-warning opacity-75';
                    //return 'table-warning p-2 text-dark bg-opacity-75 opacity-75';
                    return 'bg-vacation p-2 opacity-75';
                }
                if ($user->contactdata_person->persondata_dekret_end != '') {
                    return 'opacity-75';
                }
            })
            ->make(true);
    }

    public function exportPhonesToXLSX()
    {
        $this->authorize($this->permissionExportPD);

        return new SFRPhonesToXLSXExport();
    }
    /* export vipnet contact info */
    public function exportPhonesToXLSXWithVipNet()
    {
        $this->authorize($this->permissionExportPD);

        return new SFRVipnetToXLSXExport();
    }
}
