<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use Illuminate\Support\Collection;

class PermissionsController extends Controller
{
    private $sfr_roles_select2_collection;
    private $sfr_permissions_select2_collection;
    /**
     * --------------------------------
     * API functions
     * --------------------------------
     */
    public function APISelect2ShowRolesList()
    {
        $this->sfr_roles_select2_collection = new Collection();
        Role::all()->each(function ($item, $key) {
            $tmp_arr = [
                'id' => $item->id,
                'text' => $item->name,
            ];
            $this->sfr_roles_select2_collection->push($tmp_arr);
        });
        $api_data['results'] = $this->sfr_roles_select2_collection->sortBy(['text'])->values()->all();
        return response()->json(data: $api_data, options: JSON_UNESCAPED_UNICODE);
    }
    public function APISelect2ShowPermissionsList()
    {
        $this->sfr_permissions_select2_collection = new Collection();
        Permission::all()->each(function ($item, $key) {
            $tmp_arr = [
                'id' => $item->id,
                'text' => $item->name,
            ];
            $this->sfr_permissions_select2_collection->push($tmp_arr);
        });
        $api_data['results'] = $this->sfr_permissions_select2_collection->sortBy(['text'])->values()->all();
        return response()->json(data: $api_data, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Summary of APIShowPermissionsList
     * @return mixed
     */
    public function APIShowRolesList()
    {
        $all_roles_in_database = Role::with('permissions')->get();

        return DataTables::of($all_roles_in_database)->toJson();
    }
    public function APIShowPermissionsList()
    {
        $all_permissions_in_database = Permission::with('roles')->get();

        return DataTables::of($all_permissions_in_database)->toJson();
    }

    /**
     * --------------------------------
     * Main functions
     * --------------------------------
     */
    public function AddRole(Request $request)
    {
        $rules = [
            'rolename' => 'required|max:50|unique:roles,name',
            'permissions' => 'filled',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->only('rolename', 'permissions'), $rules);
        if ($validator->fails()) {
            $error = [
                'success' => false,
                'message' => json_decode($validator->errors())
            ];
            return response()->json(data: $error, status: 422, options: JSON_UNESCAPED_UNICODE);
        }
        // Retrieve the validated input...
        $validated = $validator->validated();
        $created_role = Role::findOrCreate($validated['rolename']);
        if (isset($validated['permissions'])) {
            $created_role->syncPermissions($validated['permissions']);
        }
        $message = [
            'success' => true,
            'message' => 'Добавлено успешно'
        ];
        return response()->json(data: $message, status: 200, options: JSON_UNESCAPED_UNICODE);

    }
    /**
     * Summary of ShowPermissionsList
     * @return mixed
     */
    public function ShowRolesList()
    {
        return view('osfrportal::admin.permissions.role_showlist');
    }

    public function ShowPermissionsList()
    {
        return view('osfrportal::admin.permissions.permission_showlist');
    }
}
