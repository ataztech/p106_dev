<?php

namespace App\Modules\PackageRole\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Role\Models\Permission;
use App\Modules\Role\Models\Role;
use App\Modules\Role\Models\RoleAndPermission;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;

class PackageRoleController extends Controller
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
        return view('PackageRole::list');
    }

    public function data()
    {
        $roles = Role::where('role_type','1')->orderBy('id','desc')->get();

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
            return view('PackageRole::create');
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
            $role->name = $request->name;
            $role->role_type = '1';
            $role->save();
            return redirect('admin/package-role/list')->with('success','Package Role Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $role = Role::find($id);
        if($request->method()=="GET")
        {
            return view('PackageRole::update',['package_role'=>$role]);
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
            return redirect('admin/package-role/list')->with('success','Package Role Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        return redirect('admin/package-role/list')->with('success','Package Role Delete Successfully!');
    }

    //Permission
    public function setPermission(Request $request,$id)
    {
        if($request->method()=="GET")
        {
            $permissions = Permission::select('module_name')->orderBy('module_name')->where('permission_type','1')->distinct()->get();
            $role = Role::find($id);
            return view('PackageRole::permission',['permissions'=>$permissions,'role'=>$role]);
        }
        else
        {
            RoleAndPermission::where('role_id',$id)->delete();
            foreach($request->permission as $per)
            {
                RoleAndPermission::create(['role_id'=>$id,'permission_id'=>$per]);
            }

            return redirect('admin/package-role/list')->with('success','Permission Set Successfully!');
        }
    }
}
