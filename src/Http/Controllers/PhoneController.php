<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables as Datatables;

use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Data\SFRPersonData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneData;

class PhoneController extends Controller
{
    private $result_collection;

    public function phoneIndex()
    {
        return view('osfrportal::sections.phone.index');
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
                $contactdata_unit_parent_name =  SfrUnits::find($contactdata_unit_parentid)->only(['unitname'])['unitname'];
            } else {
                $contactdata_unit_parent_name = $contactdata_unit_name;
                $contactdata_unit_name = null;
            }


            $person_data = new SFRPersonData(
                persondata_pid: $person->getPid(),
                persondata_fullname: $person->getFullName(),
                persondata_appointment: $person->getAppointment(),
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
                //$url = route('phone.edit', ['personid' => $user->persondata_pid]);
                $html_url = $user->contactdata_person->persondata_pid;
                //$html_url = "&nbsp";

                return $html_url;
            })
            ->make(true);
    }
}
