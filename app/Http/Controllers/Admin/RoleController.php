<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
// use App\Models\Role;
use DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Role | ' . env('APP_NAME');
        $role = Role::all();
        return view('admin.role.index', compact('title', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Role | ' . env('APP_NAME');
        $permission = Permission::get();
        return view('admin.role.create', compact('title', 'permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'   => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        if(!empty($request->permission)) {
            $permissions = Permission::whereIn('id', $request->permission)->get();
            $role->syncPermissions($permissions);
        }



        // $category->syncPermissions($request->name);

        return redirect()->route('roles.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Role | ' . env('APP_NAME');
        $category = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.role.edit', compact('category', 'title', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validator = $request->validate([
            'name'   => 'required|unique:roles,name,' . $id,
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissions = Permission::whereIn('id', $request->permission)->get();

        $role->syncPermissions($permissions);

        // $category->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with('success', 'Record updated!.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Role::find($id)->delete();
        return redirect()->route('roles.index')->with('success', 'Record deleted!.');;
    }
}
