<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    
    public function index()
    {

        $users=User::where('id','>',1)->get();
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
       $roles=Role::where('id','>',1)->get();
       return view('admin.users.form',compact('roles'));
    }

   
    public function store(Request $request)
    {

         $this->validate($request, [
            'first_name'         =>'required',
            'last_name'          =>'required',
            'gender'             =>'required|string|in:male,female',
            'email'              =>'required|unique:users,email|email',
            'password'           =>'required|string|min:8',
            'phone'              =>'required',
            'role'               =>'required|exists:roles,name'
          ]);
          try {
              $data=$request->all();
              $data['password']     =bcrypt($request->password);
              DB::transaction(function () use ($request,$data) {
                $user=User::create($data);
                $user->assignRole($request->role);
        });
        return redirect()->route('users.index')->with('success',__('User created successfully'));
        
        } catch (\Exception $e) {
             return back()->withErrors(['message' => trans('Errors')])->withInput($request->all());
        }
        

    }


    public function show($id)
    {
        $user = User::find($id);
        $roles=Role::where('id','>',1)->get();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.show',compact('user','userRole'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles=Role::where('id','>',1)->get();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.form',compact('user','roles','userRole'));

    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'first_name'         =>'required',
            'last_name'          =>'required',
            'gender'             =>'required|string|in:male,female',
            'email'              =>'unique:users,email,'.$id,
            'password'           =>'nullable|string|min:8',
            'phone'              =>'required',
            'role'               =>'required|exists:roles,name'
          ]);
        DB::beginTransaction();
        try {
            $input = $request->all();
            if(!empty($input['password'])){ 
                $input['password'] = bcrypt($input['password']);
            }else{
                $input = Arr::except($input,array('password'));    
            }
            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->role);
            DB::commit();
            return redirect()->route('users.index')
            ->with('success',__('User updated successfully'));
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->withErrors(['message' => trans('Errors')])->withInput($request->all());
        }
  
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            User::find($id)->delete();
            DB::commit();
            $response = ['status' => 'success', 'message' => __('Deleted Successfully')];
            return response()->json($response);
        } catch (\Exception $exception) {
            DB::rollback();
            $response = ['status' => 'error', 'message' => __('Failed')];
            return response()->json($response);
        }
    }                 

}
