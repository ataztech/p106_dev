<?php

namespace App\Modules\Demo\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Demo\Models\Demo;
use App\Modules\Price\Models\Price;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;

class DemoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('Demo::list');
    }

    public function data()
    {
        $demo_arr = [];
        if(Auth::user()->user_type == '1')
        {
            $demo = Demo::orderBy('id','desc')->get();
        }
        else
        {
            $demo = Demo::where('created_by_id',Auth::user()->id)->orderBy('id','desc')->get();
        }
        foreach($demo as $key => $d)
        {
            if($d->created_by == 1)
            {
                //$demo_arr[$key]['created_by'] = 'Admin';
                $demo_arr[$key]['created_by_id'] = $d->createdByAdminOrTelecaller->name.' (Admin)';
            }
            if($d->created_by == 6)
            {
                //$demo_arr[$key]['created_by'] = 'Telecaller';
                $demo_arr[$key]['created_by_id'] = $d->createdByAdminOrTelecaller->name.' (Telecaller)';
            }
            if($d->created_by == NULL)
            {
            
    
               $demo_arr[$key]['created_by_id'] = $d->createdByCounsellor->counsellor_name.' (Counsellor)';
            }
            //$demo_arr[$key]['user'] = $d->telecallerName->name;
            $demo_arr[$key]['id'] = $d->id;
            //$demo_arr[$key]['created_by_id'] = $d->telecallerName->name;
            $demo_arr[$key]['student_name'] = $d->student_name;
            $demo_arr[$key]['contact_number'] = $d->contact_number;
            $demo_arr[$key]['alternative_contact_number'] = $d->alternative_contact_number ? $d->alternative_contact_number : 'N/A' ;
            $demo_arr[$key]['standard'] = $d->standard;
            $demo_arr[$key]['date'] = $d->date;
            $demo_arr[$key]['time'] = $d->time;
            $demo_arr[$key]['address'] = $d->address;
            if(isset($d->assigned_to))
            {
                $demo_arr[$key]['assigned_to'] = $d->counsellorName->counsellor_name;
            }
            else
            {
                $demo_arr[$key]['assigned_to'] = 'Not Assigned Yet';
            }

        }
    
        return Datatables::of($demo_arr)
            /*->addColumn('alternative_contact_number', function($d) {
                if($d->alternative_contact_number == '')
                {
                    return 'N/A';
                }
            })*/
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            $counsellors = Counsellor::all();
            return view('Demo::create',compact('counsellors'));
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'contact_number' => 'required',
                'standard' => 'required',
                'date' => 'required',
                'time' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $create_demo =  new Demo();
            $create_demo->created_by_id = Auth::user()->id;
            if(Auth::user()->user_type == '1')
            {
                $create_demo->created_by = 1;
            }
            if(Auth::user()->user_type == '6')
            {
                $create_demo->created_by = 6;
            }
            $create_demo->student_name = $request->name;
            $create_demo->contact_number = $request->contact_number;
            $create_demo->alternative_contact_number = $request->alternative_contact_number;
            $create_demo->standard = $request->standard;
            $create_demo->date = $request->date;
            $create_demo->time = $request->time;
            $create_demo->address = $request->address;
            if(isset($request->counsellor))
            {
                $create_demo->assigned_to = $request->counsellor;
            }
            $create_demo->save();
            return redirect('telecaller/demo/list')->with('success','Demo Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $demo = Demo::find($id);
        $counsellors = Counsellor::all();
        if($request->method()=="GET")
        {
            return view('Demo::update',['demo'=>$demo,'counsellors'=>$counsellors]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'contact_number' => 'required',
                'standard' => 'required',
                'date' => 'required',
                'time' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $demo->student_name = $request->name;
            $demo->contact_number = $request->contact_number;
            $demo->alternative_contact_number = $request->alternative_contact_number;
            $demo->standard = $request->standard;
            $demo->date = $request->date;
            $demo->time = $request->time;
            $demo->address = $request->address;
            if(isset($request->counsellor))
            {
                $demo->assigned_to = $request->counsellor;
            }
            $demo->save();
            return redirect('telecaller/demo/list')->with('success','Demo Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Demo::find($id)->delete();
        return redirect('telecaller/demo/list')->with('success','Demo Delete Successfully!');
    }
}
