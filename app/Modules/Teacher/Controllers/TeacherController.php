<?php

namespace App\Modules\Teacher\Controllers;

use App\Modules\Subject\Models\Subject;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class TeacherController extends Controller
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
    public function listTeacher()
    {
        return view('Teacher::list');
    }

    public function data()
    {
        $teachers = User::where('user_type',4)->orderBy('id','desc')->get();

        return Datatables::of($teachers)
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
            ->addColumn('subject', function($teacher) {
                return $teacher->subject->name;
            })
            ->rawColumns(['status','subject'])
            ->make(true);
    }

    public function create(Request $request)
    {
        $subjects = Subject::all();
        if($request->method()=="GET")
        {
            return view('Teacher::create',compact('subjects'));
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
            $teacher =  new User();
            $teacher->email = $request->email;
            $teacher->name = $request->name;
            $teacher->subject_id = $request->subject;
            $teacher->mobile = $request->mobile;
            $teacher->password = bcrypt($request->password);
            $teacher->city = $request->city;
            $teacher->state = $request->state;
            $teacher->address = $request->address;
            $teacher->user_status = $request->status;
            $teacher->user_type = '4';

            $teacher->save();
            return redirect('admin/teacher/list')->with('success','Teacher Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $teacher = User::find($id);
        $subjects = Subject::all();
        if($request->method()=="GET")
        {
            return view('Teacher::update',['teacher'=>$teacher,'subjects'=>$subjects]);
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
                $teacher->email = $request->email;
            }
            if($request->password != '')
            {
                $teacher->password = bcrypt($request->password);
            }
            if($request->mobile != '')
            {
                $teacher->mobile = $request->mobile;
            }

            $teacher->name = $request->name;
            $teacher->subject_id = $request->subject;
            $teacher->city = $request->city;
            $teacher->state = $request->state;
            $teacher->address = $request->address;
            $teacher->user_status = $request->status;

            $teacher->save();
            return redirect('admin/teacher/list')->with('success','Teacher Updated Successfully!');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('admin/teacher/list')->with('success','Teacher Delete Successfully!');
    }
}
