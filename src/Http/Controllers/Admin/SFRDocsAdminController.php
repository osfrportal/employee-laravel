<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Osfrportal\OsfrportalLaravel\Models\SfrDocGroups;
use Osfrportal\OsfrportalLaravel\Models\SfrDocTypes;
use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Models\SfrFiles;
use Osfrportal\OsfrportalLaravel\Models\SfrUnits;

use Osfrportal\OsfrportalLaravel\Data\SFRDocData;
use Osfrportal\OsfrportalLaravel\Data\SFRUnitData;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

use Yajra\DataTables\DataTables;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Osfrportal\OsfrportalLaravel\Actions\Units\HierarchyUnitsListAction;

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
    public function apiGroupsShortShow()
    {
        $collectionGroupsShort = collect();
        $all = SfrDocGroups::get(['groupid', 'group_name']);
        foreach ($all as $m) {
            $collectionGroupsShort->put($m->groupid, $m->group_name);
        }
        return $collectionGroupsShort->toJson();
    }
    public function apiDocsShow()
    {
        $collectionDocs = collect();
        $allDocs = SfrDocs::all();
        foreach ($allDocs as $doc) {
            //dump($doc->doc_data);
            $collectionDocs->push(SFRDocData::forList($doc));

        }
        //dump(DataTables::of($collectionDocs)->toJson());
        //dd($all->toArray());
        //return SFRDocData::from($all);
        return DataTables::of($collectionDocs)->toJson();
    }
    public function apiSelect2ShowDocsGroups()
    {
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
    public function apiSelect2ShowDocsTypes()
    {
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
    public function docsShowDetail(string $docid)
    {
        try {
            $docData = SfrDocs::where('docid', $docid)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->flasher_interface->addError('Документ не найден!');
            return back();
        }
        $docDataDTO = SFRDocData::forList($docData);

        try {
            $docType = SfrDocTypes::where('typeid', $docDataDTO->docType)->firstOrFail('type_name');
        } catch (ModelNotFoundException $e) {
            $this->flasher_interface->addError('Тип документа не найден!');
            return back();
        }
        try {
            $docGroup = SfrDocGroups::where('groupid', $docDataDTO->docGroup)->firstOrFail('group_name');
        } catch (ModelNotFoundException $e) {
            $this->flasher_interface->addError('Раздел документа не найден!');
            return back();
        }
        return view('osfrportal::admin.docs.docs_detail', [
            'docid' => $docid,
            'docData' => $docDataDTO,
            'docGroupName' => $docGroup->group_name,
            'docTypeName' => $docType->type_name,
            'docFiles' => $docData->SfrDocsFiles,
        ]);
    }
    public function docsShowList()
    {
        $groupsShort = $this->apiGroupsShortShow();
        return view('osfrportal::admin.docs.docs_list', ['groupsShort' => $groupsShort]);
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

    //ОТЧЕТЫ
    public function reportsShowList()
    {
        return view('osfrportal::admin.docs.reports.reports_index');
    }

    public function reportsShowByUnits(Request $request)
    {
        $withSfrPersonData = true;
        $sfrunits = [];
        $sfrdocs = [];
        $withChildUnits = false;

        $personsForReport = [];

        if ($request->has('sfrunits')) {
            $sfrunits = $request->input('sfrunits');
        }
        if ($request->has('sfrdocs')) {
            $sfrdocs = $request->input('sfrdocs');
        }
        if ($request->has('withChildUnits')) {
            $withChildUnits = $request->input('withChildUnits') ? true : false;
        }
        $hierarchyUnits = HierarchyUnitsListAction::run($sfrunits, $withChildUnits, $withSfrPersonData);
        //dump($htest);
        foreach ($hierarchyUnits as $unit) {
            foreach ($unit->unitpersons as $unitRootPerson) {
                $personsForReport[] = $unitRootPerson;
            }
            if (!is_null($unit->childunits)) {
                foreach ($unit->childunits as $unitChild) {
                    foreach ($unitChild->unitpersons as $unitChildPerson) {
                        $personsForReport[] = $unitChildPerson;
                    }
                }
            }
        }
        dump($personsForReport);

        return view('osfrportal::admin.docs.reports.byunits');
    }
}
