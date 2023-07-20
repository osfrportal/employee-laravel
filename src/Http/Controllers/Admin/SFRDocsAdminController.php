<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Models\SfrDocTypes;
use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Models\SfrFiles;

use Osfrportal\OsfrportalLaravel\Data\SFRDocData;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

use Yajra\DataTables\DataTables;


class SFRDocsAdminController extends Controller
{
    private $apiDocsGroupsSelect2Collection;
    private $apiDocsTypesSelect2Collection;

    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */
    public function apiTypesShow()
    {
        $all = SfrDocTypes::all();
        return DataTables::of($all)->toJson();
    }
    public function apiGroupsShow()
    {
        $all = SfrDocGroups::all();
        return DataTables::of($all)->toJson();
    }
    public function apiDocsShow()
    {
        $all = SfrDocs::all();
        return DataTables::of($all)->toJson();
    }
    public function apiSelect2ShowDocsGroups() {
        $this->apiDocsGroupsSelect2Collection = new Collection();
        SfrDocGroups::all()->each(function ($item, $key) {
            $tmp_arr = [
                'id' => $item->groupid,
                'text' => $item->group_name,
            ];
            $this->apiDocsGroupsSelect2Collection->push($tmp_arr);
        });
        $api_data['results'] = $this->apiDocsGroupsSelect2Collection->sortBy(['text'])->values()->all();
        return response()->json(data: $api_data, options: JSON_UNESCAPED_UNICODE);
    }
    public function apiSelect2ShowDocsTypes() {
        $this->apiDocsTypesSelect2Collection = new Collection();
        SfrDocTypes::all()->each(function ($item, $key) {
            $tmp_arr = [
                'id' => $item->typeid,
                'text' => $item->type_name,
            ];
            $this->apiDocsTypesSelect2Collection->push($tmp_arr);
        });
        $api_data['results'] = $this->apiDocsTypesSelect2Collection->sortBy(['text'])->values()->all();
        return response()->json(data: $api_data, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */
    //ДОКУМЕНТЫ
    public function docsShowList()
    {
        return view('osfrportal::admin.docs.docs_list');
    }
    public function docsAddForm()
    {
        return view('osfrportal::admin.docs.docs_add_form');
    }
    public function docsAdd(SFRDocData $docdata)
    {
        SfrDocs::updateOrCreate([
            'doc_name' => $docdata->docName,
            'doc_number' => $docdata->docNumber,
            'doc_date' => $docdata->docDate,
        ], [
            'doc_typeid' => $docdata->docType,
            'doc_groupid' => $docdata->docGroup,
            'doc_data' => $docdata->toJson(),
        ]);
        $this->flasher_interface->addSuccess('Данные успешно сохранены');
        return redirect()->route('osfrportal.admin.docs.all');
    }
    //ТИПЫ ДОКУМЕНТОВ
    public function typesShowList()
    {
        return view('osfrportal::admin.docs.types_list');
    }
    public function typesAddForm()
    {
        $edit_values['type_name'] = null;
        return view('osfrportal::admin.docs.types_add_form', ['edit_values' => $edit_values]);
    }
    public function typesSave(Request $request)
    {
        $validation_rules = [
            'type_name' => 'required',
        ];
        $validation_messages = [
            'type_name.required' => 'Не указано наименование',
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

        $type_name = $validatedData['type_name'];
        SfrDocTypes::firstOrCreate([
            'type_name' => $type_name,
        ]);
        $this->flasher_interface->addSuccess('Данные успешно сохранены');
        return redirect()->route('osfrportal.admin.docs.types.all');
    }

    //ГРУППЫ ДОКУМЕНТОВ
    public function groupsShowList()
    {
        return view('osfrportal::admin.docs.groups_list');
    }
    public function groupsAddForm()
    {
        $edit_values['group_name'] = null;
        return view('osfrportal::admin.docs.groups_add_form', ['edit_values' => $edit_values]);
    }
    public function groupsSave(Request $request)
    {
        $validation_rules = [
            'group_name' => 'required',
        ];
        $validation_messages = [
            'group_name.required' => 'Не указано наименование',
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

        $group_name = $validatedData['group_name'];
        SfrDocGroups::firstOrCreate([
            'group_name' => $group_name,
        ]);
        $this->flasher_interface->addSuccess('Данные успешно сохранены');
        return redirect()->route('osfrportal.admin.docs.groups.all');
    }
}
