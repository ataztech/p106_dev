<?php

namespace App\Modules\Telecaller\Controllers;

use App\Modules\Role\Models\UserRole;
use App\Modules\Subject\Models\Subject;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class TelecallerController   extends Controller
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
    public function listTelecaller()
    {

        return view('Telecaller::list');
    }

    public function data()
    {
        $telecaller = User::where('user_type',6)->orderBy('id','desc')->get();

        return Datatables::of($telecaller)
            ->addColumn('status', function($teacher) {
                if($teacher->user_status == 1)
                {
                    return '<label class="label label-success">Active</label>';
                }
                else
                {
                    return '<label class="label label-danger">Inactive</label>';
                }

            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Telecaller::create');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'mobile' => 'required|numeric|min:10|unique:users',
                'password' => 'required|min:6|confirmed',
                'city' => 'required',
                'state' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $telecaller =  new User();
            $telecaller->email = $request->email;
            $telecaller->name = $request->name;
            $telecaller->mobile = $request->mobile;
            $telecaller->password = bcrypt($request->password);
            $telecaller->city = $request->city;
            $telecaller->state = $request->state;
            $telecaller->address = $request->address;
            $telecaller->user_status = $request->status;
            $telecaller->user_type = '6';
            $telecaller->save();

            $role = new UserRole();
            $role->user_id = $telecaller->id;
            $role->role_id = 3;
            $role->save();


            return redirect('admin/telecaller/list')->with('success','Telecaller Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $telecaller = User::find($id);
        if($request->method()=="GET")
        {
            return view('Telecaller::update',['telecaller'=>$telecaller]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'email' => 'unique:users',
                'name' => 'required',
                'mobile' => 'unique:users',
                'password' => 'confirmed',
                'city' => 'required',
                'state' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if($request->email != '')
            {
                $telecaller->email = $request->email;
            }
            if($request->password != '')
            {
                $telecaller->password = bcrypt($request->password);
            }
            if($request->mobile != '')
            {
                $telecaller->mobile = $request->mobile;
            }

            $telecaller->name = $request->name;
            $telecaller->city = $request->city;
            $telecaller->state = $request->state;
            $telecaller->address = $request->address;
            $telecaller->user_status = $request->status;

            $telecaller->save();
            return redirect('admin/telecaller/list')->with('success','Telecaller Updated Successfully!');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('admin/telecaller/list')->with('success','Telecaller Delete Successfully!');
    }

    public function telecallerLogin()
    {
        return view('Telecaller::telecaller-login');
    }

    public function telecallerDashboard()
    {
        return view('Telecaller::telecaller-dashboard');
    }
}
