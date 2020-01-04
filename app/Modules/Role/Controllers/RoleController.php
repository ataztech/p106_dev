<?php

namespace App\Modules\Role\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Role\Models\Permission;
use App\Modules\Role\Models\Role;
use App\Modules\Role\Models\RoleAndPermission;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('Role::list');
    }

    public function listTelecallerRoles()
    {
        return view('Role::telecaller-role-list');
    }

    public function data()
    {
        $roles = Role::where('role_type','0')->orderBy('id','desc')->get();

        return Datatables::of($roles)
//            ->addColumn('total_bill', function($report) {
//                return $report->total_price + $report->total_discount;
//            })
            ->make(true);
    }

    public function telecallerRoleData()
    {
        $roles = Role::where('role_type','2')->orderBy('id','desc')->get();

        return Datatables::of($roles)
//            ->addColumn('total_bill', function($report) {
//                return $report->total_price + $report->total_discount;
//            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Role::create');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $role =  new Role();
            $role->name=$request->name;
            $role->save();
            return redirect('admin/role/list')->with('success','Role Added Successfully!');
        }
    }

    public function createTelecaller(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Role::create');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $role =  new Role();
            $role->name=$request->name;
            $role->role_type = '2';
            $role->save();
            return redirect('admin/telecaller-role/list')->with('success','Role Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $role = Role::find($id);
        if($request->method()=="GET")
        {
            return view('Role::update',['role'=>$role]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $role->name=$request->name;
            $role->save();
            return redirect('admin/role/list')->with('success','Role Updated Successfully!');
        }
    }

    public function updateTelecaller(Request $request,$id)
    {
        $role = Role::find($id);
        if($request->method()=="GET")
        {
            return view('Role::update',['role'=>$role]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $role->name=$request->name;
            $role->save();
            return redirect('admin/telecaller-role/list')->with('success','Role Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        return redirect('admin/role/list')->with('success','Role Delete Successfully!');
    }

    public function deleteTelecaller($id)
    {
        Role::find($id)->delete();
        return redirect('admin/telecaller-role/list')->with('success','Role Delete Successfully!');
    }

    //Permission
    public function setPermission(Request $request,$id)
    {
        if($request->method()=="GET")
        {
            $permissions = Permission::select('module_name')->where('permission_type','0')->orderBy('module_name')->distinct()->get();
            $role = Role::find($id);
            return view('Role::permission',['permissions'=>$permissions,'role'=>$role]);
        }
        else
        {
            RoleAndPermission::where('role_id',$id)->delete();
            foreach($request->permission as $per)
            {
                RoleAndPermission::create(['role_id'=>$id,'permission_id'=>$per]);
            }

            return redirect('admin/role/list')->with('success','Permission Set Successfully!');
        }
    }

    // tellecallerPermission
    public function setTelecallerPermission(Request $request,$id)
    {
        if($request->method()=="GET")
        {
            $permissions = Permission::select('module_name')->where('permission_type','2')->orderBy('module_name')->distinct()->get();
            $role = Role::find($id);
            return view('Role::permission',['permissions'=>$permissions,'role'=>$role]);
        }
        else
        {
            RoleAndPermission::where('role_id',$id)->delete();
            foreach($request->permission as $per)
            {
                RoleAndPermission::create(['role_id'=>$id,'permission_id'=>$per]);
            }

            return redirect('/admin/telecaller-role/list')->with('success','Permission Set Successfully!');
        }
    }
}
