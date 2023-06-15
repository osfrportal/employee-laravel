<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables as Datatables;
use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneData;

class PhoneController extends Controller
{
    private $result_collection;
    private $flasher_interface;

    public function __construct() {
        $this->flasher_interface = flash()->options(['timeout' => '2000', 'layout' => 'topCenter', 'modal' => true, 'closeWith' => ['click', 'button'], 'theme' => 'bootstrap-v4']);
    }

    public function phoneIndex()
    {
        return view('osfrportal::sections.phone.index');
    }
    public function doUpdateContacts(Request $request)
    {

        $validation_rules = [
            'inputEmailAddress' => 'email:rfc,strict|ends_with:@058.pfr.gov.ru,@48.sfr.gov.ru,@ro48.fss.ru',
            'inputPhoneInt' => 'required|digits:4',
            'inputPhoneExt' => 'required|digits_between:5,6',
            'inputRoom' => 'required|alpha_dash|max:30',
            'inputPhoneMobile' => 'nullable|numeric|digits:10',
            'personid' => 'required|uuid',
        ];
        $validation_messages = [
            'inputRoom.required' => 'Не указано помещение',
            'inputEmailAddress' => 'Не указан корректный адрес электронной почты. Адрес электронной почты должен заканчиваться на следующие значения: @48.sfr.gov.ru, @058.pfr.gov.ru, @ro48.fss.ru',
        ];


        $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
        if ($validator->fails()) {
            $this->flasher_interface->addError('Проверьте заполненные данные и повторите сохранение.');
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $current_user = Auth::user();

        $validatedData = $validator->validated();;
        //flash()->addFlash(type: 'success', message: 'Данные успешно обновлены', options: ['timeout' => false, 'layout' => 'topCenter']);
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
        $contact_data = SFRPhoneContactData::from($person->SfrPersonContacts->contactdata);

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

            $person_data = new SFRPersonData(
                persondata_pid: $person->getPid(),
                persondata_fullname: $person->getFullName(),
                persondata_appointment: $person->getAppointment(),
                persondata_vacation: $contactdata_vacation,
                persondata_vacation_end: $contactdata_vacation_end,
                persondata_dekret_end: $contactdata_dekret_end,
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
        $units_all = SfrUnits::whereNull('unitparentid')->orderBy('unitsortorder', 'ASC')->with('children')->orderBy('unitname', 'ASC')->with('SfrPersons')->get();

        //return $units_all->toJson();

        return Datatables::of($this->convertPersonsFromUnit($units_all))
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
                if ($user->contactdata_person->persondata_vacation_end != '') {
                    //return 'bg-warning opacity-75';
                    //return 'table-warning p-2 text-dark bg-opacity-75 opacity-75';
                    return 'table-warning p-2 opacity-75';
                }
                if ($user->contactdata_person->persondata_dekret_end != '') {
                    return 'opacity-75';
                }
            })
            ->make(true);
    }
}
