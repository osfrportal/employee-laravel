<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Osfrportal\OsfrportalLaravel\Models\SfrLinks;
use Osfrportal\OsfrportalLaravel\Models\SfrLinkGroups;
use Osfrportal\OsfrportalLaravel\Http\Requests\SaveLinkPostRequest;

use Osfrportal\OsfrportalLaravel\Http\Requests\SaveLinkGroupPostRequest;

class SFRLinksAdminController extends Controller
{
    private $apiSelect2GroupsAll;
    private $apiSelect2GroupsRootAll;
    private $apiSelect2GroupsPreselectID;
    private $permissionManage = 'links-manage';
    /**
     * ----------------------------
     * API функции
     * ----------------------------
     */
    public function apiSelect2GroupsAll($selectedGroupID = null)
    {
        $this->apiSelect2GroupsPreselectID = $selectedGroupID;
        $this->apiSelect2GroupsAll = new Collection();
        SfrLinkGroups::orderBy('grlsortorder', 'ASC')->with('parent')->each(function ($item, $key) {
            $grlname = '';
            $tmp_arr = [];
            if (!is_null($item->parent)) {
                $grlname = sprintf('%s -> ', $item->parent->grlname);
            }
            $grlname = sprintf($grlname . '%s', $item->grlname);
            $tmp_arr = Arr::add($tmp_arr, 'id', $item->grlid);
            $tmp_arr = Arr::add($tmp_arr, 'text', $grlname);
            if (!is_null($this->apiSelect2GroupsPreselectID) && ($item->grlid == $this->apiSelect2GroupsPreselectID)) {
                $tmp_arr = Arr::add($tmp_arr, 'selected', true);
            }
            $this->apiSelect2GroupsAll->push($tmp_arr);
        });
        //$api_data['results'] = $this->apiSelect2GroupsAll->sortBy(['text'])->values()->all();
        $api_data = $this->apiSelect2GroupsAll->sortBy(['text'])->values()->all();
        return response()->json(data: $api_data, options: JSON_UNESCAPED_UNICODE);
    }
    public function apiSelect2GroupsRoot($selectedGroupID = null)
    {
        $this->apiSelect2GroupsPreselectID = $selectedGroupID;
        $this->apiSelect2GroupsRootAll = new Collection();
        SfrLinkGroups::where('grlparentid', '=', '0')->orderBy('grlsortorder', 'ASC')->each(function ($item, $key) {
            $tmp_arr = [];
            $tmp_arr = Arr::add($tmp_arr, 'id', $item->grlid);
            $tmp_arr = Arr::add($tmp_arr, 'text', $item->grlname);
            if (!is_null($this->apiSelect2GroupsPreselectID) && ($item->grlid == $this->apiSelect2GroupsPreselectID)) {
                $tmp_arr = Arr::add($tmp_arr, 'selected', true);
            }
            $this->apiSelect2GroupsRootAll->push($tmp_arr);
        });
        //$api_data['results'] = $this->apiSelect2GroupsAll->sortBy(['text'])->values()->all();
        $api_data = $this->apiSelect2GroupsRootAll->sortBy(['text'])->values()->all();
        return response()->json(data: $api_data, options: JSON_UNESCAPED_UNICODE);
    }
    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */
    public function linksGroupsShow()
    {
        $this->authorize($this->permissionManage);

        $allGroups = SfrLinkGroups::orderBy('grlsortorder', 'ASC')->with('parent')->get();
        $rootGroups = SfrLinkGroups::where('grlparentid', '=', '0')->orderBy('grlname', 'ASC')->get();
        return view('osfrportal::admin.links.linksGroupsList', [
            'allGroups' => $allGroups,
            'rootGroups' => $rootGroups,
        ]);
    }

    public function groupSave(SaveLinkGroupPostRequest $saveRequest)
    {
        $validated = $saveRequest->validated();

        $parentid = Arr::get($validated, 'grlparentid');
        //dd($validated);
        $groupModel = SfrLinkGroups::updateOrCreate(
            [
                'grlid' => Arr::get($validated, 'grlid'),
            ],
            [
                'grlname' => Arr::get($validated, 'grlname'),
                'grlsortorder' => Arr::get($validated, 'grlsortorder'),
                'grlcollapsed' => Arr::get($validated, 'grlcollapsed', '1'),
                'grlparentid' => Arr::get($validated, 'grlparentid')
            ]
        );

        $this->flasher_interface->addSuccess('Данные успешно сохранены');

        return redirect()->route('osfrportal.admin.links.groups.all');
    }

    public function linksGroupsAdd()
    {
        $this->authorize($this->permissionManage);

        return view('osfrportal::admin.links.linksGroupsEdit', [
            'linkGroupID' => 0,
        ]);
    }

    public function linksGroupsEdit(int $groupid)
    {
        $this->authorize($this->permissionManage);

        $groupData = SfrLinkGroups::findOrFail($groupid);
        return view('osfrportal::admin.links.linksGroupsEdit', [
            'groupData' => $groupData,
        ]);
    }

    public function linksGroupsDelete(int $groupid)
    {
        $this->authorize($this->permissionManage);

        $groupData = SfrLinkGroups::findOrFail($groupid);
        $groupData->SfrLinks()->detach();
        $groupData->delete();
        $this->flasher_interface->addSuccess('Группа удалена');

        return redirect()->route('osfrportal.admin.links.groups.all');
    }
    public function linksShow()
    {
        $this->authorize($this->permissionManage);

        $allGroups = SfrLinkGroups::all();
        $allLinks = SfrLinks::orderBy('linkid', 'ASC')->with('LinkGroup')->get();
        return view('osfrportal::admin.links.linksList', [
            'allGroups' => $allGroups,
            'allLinks' => $allLinks,
        ]);
    }

    public function linkEdit(int $linkid)
    {
        $this->authorize($this->permissionManage);

        $linkGroupID = null;
        $linkData = SfrLinks::where('linkid', '=', $linkid)->with('LinkGroup')->first();
        $lg = $linkData->LinkGroup->first();
        if (!is_null($lg)) {
            $linkGroupID = $lg->grlid;
        }
        return view('osfrportal::admin.links.linksEdit', [
            'linkData' => $linkData,
            'linkGroupID' => $linkGroupID,
        ]);
    }

    public function linkSave(SaveLinkPostRequest $saveRequest)
    {

        $validated = $saveRequest->validated();
        //dd($validated);
        $lg = Arr::get($validated, 'linksgroup');
        foreach ($lg as $key => $value) {
            if (!strlen($value)) {
                unset($lg[$key]);
            }
        }

        $linkModel = SfrLinks::updateOrCreate(
            [
                'linkid' => Arr::get($validated, 'linkid'),
            ],
            [
                'linkname' => Arr::get($validated, 'linkname'),
                'linkurl' => Arr::get($validated, 'linkurl'),
                'linksortorder' => Arr::get($validated, 'linksortorder'),
                'linkshowinleftmenu' => Arr::get($validated, 'linkshowinleftmenu')
            ]
        );
        $linkGroupsToAttach = $linkModel->LinkGroup()->sync($lg);


        $this->flasher_interface->addSuccess('Данные успешно сохранены');

        return redirect()->route('osfrportal.admin.links.all');
    }

    public function linkDelete(int $linkid)
    {
        $this->authorize($this->permissionManage);

        $linkModel = SfrLinks::findOr($linkid, function () {
            $this->flasher_interface->addError('Ошибка при удалении. Ссылка не найдена в базе');
            return null;
        });
        if (is_null($linkModel)) {
            return redirect()->route('osfrportal.admin.links.all');
        }
        $linkModel->LinkGroup()->detach();
        $linkModel->delete();
        $this->flasher_interface->addSuccess('Ссылка удалена');
        return redirect()->route('osfrportal.admin.links.all');

    }

    public function linkAdd()
    {
        $this->authorize($this->permissionManage);

        return view('osfrportal::admin.links.linksEdit', [
            'linkGroupID' => 0,
        ]);
    }

}