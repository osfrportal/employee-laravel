<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Osfrportal\OsfrportalLaravel\Models\SfrAddresses;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;
use Osfrportal\OsfrportalLaravel\Models\SfrDialplan;

class SFRPhoneAdminController extends Controller
{
    public $all_units;

    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */
    public function APIAddrList()
    {
        $sfraddr = SfrAddresses::orderBy('paddress', 'ASC')->get();

        return DataTables::of($sfraddr)->toJson();
    }

    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */

    public function ShowAddrList()
    {
        return view('osfrportal::admin.phone.addr_list');
    }

    public function ShowDialPlanList()
    {
        $dialplan = SfrDialplan::with('addressFull')->orderBy('dpnumstart', 'ASC')->orderBy('dpnumend', 'ASC')->get();
        return view('osfrportal::admin.phone.dialplan_list', ['dialplan' => $dialplan]);
    }
    public function AddDialPlan()
    {
        $edit_values = [
            'dpnumstart' => null,
            'dpnumend' => null,
            'addrid' => null,
        ];
        $addresses_collection = collect();
        $addresses = SfrAddresses::orderBy('paddress', 'ASC')->get();
        foreach ($addresses as $addr) {
            $addresses_collection->push(['addrid' => $addr->addrid, 'paddress' => $addr->paddress]);
        }
        //dd($addresses_collection);
        return view('osfrportal::admin.phone.dialplan_add_form', [
            'addresses_collection' => $addresses_collection,
            'edit_values' => $edit_values,
        ]);
    }

    public function EditDialPlan(string $dpid)
    {
        $addresses_collection = collect();
        $dialplan = SfrDialplan::find($dpid);
        $addresses = SfrAddresses::orderBy('paddress', 'ASC')->get();
        foreach ($addresses as $addr) {
            $addresses_collection->push(['addrid' => $addr->addrid, 'paddress' => $addr->paddress]);
        }
        //dd($addresses_collection);
        return view('osfrportal::admin.phone.dialplan_add_form', [
            'addresses_collection' => $addresses_collection,
            'edit_values' => $dialplan,
        ]);
    }

    public function SaveDialPlan(Request $request)
    {
        $validation_rules = [
            'dialplan_dpnumstart' => 'required|digits:4|lte:dialplan_dpnumend',
            'dialplan_dpnumend' => 'required|digits:4|gte:dialplan_dpnumstart',
            'addrid' => 'required|uuid',
        ];
        $validation_messages = [
            'addrid.required' => 'Не выбран адрес',
            'dialplan_dpnumstart.required' => 'Поле "Начало диапазона" обязательно для заполнения',
            'dialplan_dpnumend.required' => 'Поле "Конец диапазона" обязательно для заполнения',
            'dialplan_dpnumstart.digits' => 'Поле "Начало диапазона" должно содержать 4 цифры',
            'dialplan_dpnumend.digits' => 'Поле "Конец диапазона" должно содержать 4 цифры',
            'dialplan_dpnumstart.lte' => 'Начало диапазона не может быть больше конечного значения диапазона.',
            'dialplan_dpnumend.gte' => 'Конец диапазона не может быть меньше начального значения диапазона.',
        ];


        $validator = Validator::make($request->all(), $validation_rules, $validation_messages);

        if ($validator->fails()) {
            $errors = implode('<br>', $validator->errors()->all());
            //dd($errors);
            $this->flasher_interface->addError($errors);
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        $dialplan = SfrDialplan::where([
            ['dpnumstart', '=', $validatedData['dialplan_dpnumstart']],
            ['dpnumend', '=', $validatedData['dialplan_dpnumend']],
        ])->first();

        if ($dialplan !== null) {
            $dialplan->update(['addrid' => $validatedData['addrid']]);
        } else {
            $dialplan = new SfrDialplan();
            $dialplan->dpnumstart = $validatedData['dialplan_dpnumstart'];
            $dialplan->dpnumend = $validatedData['dialplan_dpnumend'];
            $dialplan->addrid = $validatedData['addrid'];
            $dialplan->save();
        }
        $this->flasher_interface->addSuccess('Данные успешно сохранены');
        return redirect()->route('osfrportal.admin.phone.dialplan');
    }

    public function DeleteDialPlan(string $dpid) {
        /**
         * TODO: добавить проверку - используется ли сейчас этот диалплан
         */
        $dialplan = SfrDialplan::destroy($dpid);
        if ($dialplan > 0) {
        $this->flasher_interface->addInfo('Данные успешно удаалены');
        return redirect()->route('osfrportal.admin.phone.dialplan');
        } else {
            $this->flasher_interface->addError('Ошибка удаления!');
            return back();
        }
    }

    /**
     * Список подразделений
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowUnitsList()
    {
        $this->all_units = new Collection();

        SfrUnits::whereNull('unitparentid')->orderBy('unitname', 'ASC')->get()->each(function ($item, $key) {
            $this->all_units->push(['unitid' => $item->unitid, 'unitname' => $item->unitname, 'unitcode' => $item->unitcode]);
        });
        $roots_units = SfrUnits::whereNull('unitparentid')->orderBy('unitsortorder', 'ASC')->with('children')->orderBy('unitname', 'ASC')->get();
        return view('osfrportal::admin.phone.units_list', [
            'roots_units' => $roots_units,
            'all_units' => $this->all_units,
        ]);
    }

    public function updateUnit(Request $request)
    {
        $unit = SfrUnits::findOrFail($request->unitid);
        if ($request->unitparentid != 0) {
            $unit->unitparentid = $request->unitparentid;
        } else {
            $unit->unitparentid = null;
        }
        $unit->unitsortorder = $request->unitsortorder;
        $unit->save();
        $this->flasher_interface->addSuccess('Данные успешно обновлены');

        return redirect()->route('osfrportal.admin.phone.units');
    }
}
