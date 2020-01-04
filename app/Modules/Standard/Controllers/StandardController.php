<?php

namespace App\Modules\Standard\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Standard\Models\Standard;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;

class StandardController extends Controller
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
        return view('Standard::list');
    }

    public function data()
    {
        $standards = Standard::orderBy('id','desc')->get();

        return Datatables::of($standards)
//            ->addColumn('total_bill', function($report) {
//                return $report->total_price + $report->total_discount;
//            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Standard::create');
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
            $standard =  new Standard();
            $standard->name=$request->name;
            $standard->save();
            return redirect('admin/standard/list')->with('success','Standard Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $standard = Standard::find($id);
        if($request->method()=="GET")
        {
            return view('Standard::update',['standard'=>$standard]);
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
            $standard->name=$request->name;
            $standard->save();
            return redirect('admin/standard/list')->with('success','Standard Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Standard::find($id)->delete();
        return redirect('admin/standard/list')->with('success','Standard Delete Successfully!');
    }
}
