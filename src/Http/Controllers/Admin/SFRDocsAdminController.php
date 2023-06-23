<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Models\SfrDocTypes;
use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Models\SfrFiles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Yajra\DataTables\DataTables;


class SFRDocsAdminController extends Controller
{
    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */
    public function apiGroupsShow()
    {
        $all = SfrDocGroups::all();
        return DataTables::of($all)->toJson();
    }

    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */

    public function docsShowList()
    {
        return view('osfrportal::admin.docs.docs_list');
    }
    public function typesShowList()
    {
        return view('osfrportal::admin.docs.types_list');
    }
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
