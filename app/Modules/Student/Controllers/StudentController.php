<?php

namespace App\Modules\Student\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class StudentController extends Controller
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
        return view('Student::list');
    }

    public function data()
    {
        $students = User::where('user_type',3)->where('temp_user','0')->orderBy('id','desc')->get();

        return Datatables::of($students)
            ->addColumn('status', function($student) {
                if($student->user_status == 1)
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
            return view('Student::create');
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
            $student =  new User();
            $student->email = $request->email;
            $student->name = $request->name;
            $student->mobile = $request->mobile;
            $student->password = bcrypt($request->password);
            $student->city = $request->city;
            $student->state = $request->state;
            $student->address = $request->address;
            $student->user_status = $request->status;
            $student->user_type = '3';

            $student->save();
            return redirect('admin/student/list')->with('success','Student Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $student = User::find($id);
        if($request->method()=="GET")
        {
            return view('Student::update',['student'=>$student]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                
                'name' => 'required',
//                'mobile' => 'unique:users',
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
                $student->email = $request->email;
            }
            if($request->password != '')
            {
                $student->password = bcrypt($request->password);
            }
            if($request->mobile != '')
            {
                $student->mobile = $request->mobile;
            }
            

            $student->name = $request->name;
            $student->city = $request->city;
            $student->state = $request->state;
            $student->address = $request->address;
            $student->user_status = $request->status;

            $student->save();
            return redirect('admin/student/list')->with('success','Student Updated Successfully!');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('admin/student/list')->with('success','Student Delete Successfully!');
    }
    
    public function makeTemperory($id)
    {
        $find_user = User::find($id);
        if($find_user)
        {
            $find_user->temp_user = '1';
            if(!isset($find_user->account_registration_date) && !isset($find_user->account_expiration_date))
            {
                date_default_timezone_set('Asia/Kolkata'); // setting time zone
                $account_registration_date = new \DateTime("now");
                $account_expiration_date = new \DateTime("+3 day");
                $find_user->account_registration_date = $account_registration_date->format('d-m-Y h:i:s a');
                $find_user->account_expiration_date = $account_expiration_date->format('d-m-Y h:i:s a');
            }
            if($find_user->save())
            {
                return redirect('admin/student/list')->with('success','User marked as temperory successfully');
            }
        }
    }
}
