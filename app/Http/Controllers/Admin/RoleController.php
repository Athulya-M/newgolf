<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
  function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $roles = Role::where('id','>',1)->orderBy('id','DESC')->get();
        return view('admin.roles.index',compact('roles'));
    }


    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.form',compact('permission'));
    }

   public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            DB::commit();
            return redirect()->route('roles.index')->with('success', __('Role created successfully'));
                       
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->withErrors(['message' => trans('Errors')])->withInput($request->all());
        }
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('admin.roles.show',compact('role','rolePermissions'));
    }
    
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('admin.roles.form',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'       => 'required',
            'permission' => 'required',]);
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));
            DB::commit();
            return redirect()->route('roles.index')->with('success',__('Role updated successfully'));
                        
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->withErrors(['message' => trans('Errors')])->withInput($request->all());
        }
    
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DB::table("roles")->where('id',$id)->delete();
            DB::commit();
            $response = ['status' => 'success', 'message' => __('Deleted Successfully') ];
            return response()->json($response);
        } catch (\Exception $exception) {
            DB::rollback();
            $response = ['status' => 'error', 'message' => __('Failed')];
            return response()->json($response);
        }
    }
    
}

