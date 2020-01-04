<?php

namespace App\Modules\Counsellor\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Standard\Models\Standard;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Storage;

class CounsellorController extends Controller
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
    public function counsellorList()
    {
        return view('Counsellor::list');
    }

    public function counsellorData()
    {
        $counsellor_detail = Counsellor::orderBy('id','desc')->get();

        return Datatables::of($counsellor_detail)
//            ->addColumn('total_bill', function($report) {
//                return $report->total_price + $report->total_discount;
//            })
            ->make(true);
    }

    public function checkCounsellorNameDuplication(Request $request)
    {
        $counsellor_name = $request->counsellor_name;
        if(isset($request->id))
        {
            $check_name = Counsellor::where('counsellor_name',$counsellor_name)->where('id','<>',$request->id)->first();
        }
        else
        {
            $check_name = Counsellor::where('counsellor_name',$counsellor_name)->first();
        }
        if($check_name->count() > 0)
        {
            return "false";
        }
        else
        {
            return "true";
        }

    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Counsellor::create');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'counsellor_id' => 'required|unique:counsellors',
                'counsellor_name' => 'required|unique:counsellors',
                'counsellor_email_id' => 'required|email|unique:counsellors',
                'counsellor_mobile_no' => 'required|numeric|min:10|unique:counsellors',
                'counsellor_password' => 'required',
                'confirm_password' => 'required|same:counsellor_password'

            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $insert_counsellor =  new Counsellor();
                if($request->hasFile('counsellor_document'))
                {
                    $extension = $request->file('counsellor_document')->getClientOriginalExtension();
                    $new_file_name = str_replace(".", "-", microtime(true)) . "." . $extension;
                    Storage::put('public/counsellor_documents/' . $new_file_name, file_get_contents($request->file('counsellor_document')->getRealPath()));
                    $insert_counsellor->counsellor_document = $new_file_name;
                }
                $insert_counsellor->counsellor_id = $request->counsellor_id;
                $insert_counsellor->counsellor_name = $request->counsellor_name;
                $insert_counsellor->counsellor_email_id = $request->counsellor_email_id;
                $insert_counsellor->counsellor_mobile_no = $request->counsellor_mobile_no;
                $insert_counsellor->counsellor_password = bcrypt($request->counsellor_password);
                $insert_counsellor->save();
                return redirect('admin/counsellor/list')->with('success','Counsellor Added Successfully!');

        }
    }

    public function update(Request $request,$id)
    {
        $counsellor = Counsellor::find($id);
        if($request->method()=="GET")
        {
            return view('Counsellor::update',['counsellor'=>$counsellor]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'counsellor_id' => 'required',
                'counsellor_name' => 'required',
                'counsellor_email_id' => 'required',
                'counsellor_mobile_no' => 'required|numeric|min:10',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $check_name_duplication = Counsellor::where('counsellor_name',$request->counsellor_name)->where('id','<>',$id)->first();
            if(isset($check_name_duplication) && $check_name_duplication->count() > 0)
            {
                return redirect()->back()
                    ->withErrors(['counsellor_name' => 'Name Already Exist'])
                    ->withInput();
            }
            $check_email_duplication = Counsellor::where('counsellor_email_id',$request->counsellor_email_id)->where('id','<>',$id)->first();
            if(isset($check_email_duplication) && $check_email_duplication->count() > 0)
            {
                return redirect()->back()
                    ->withErrors(['counsellor_email_id' => 'Email Id Already Exist'])
                    ->withInput();
            }
            $check_mobile_duplication = Counsellor::where('counsellor_mobile_no',$request->counsellor_mobile_no)->where('id','<>',$id)->first();
            if(isset($check_mobile_duplication) && $check_mobile_duplication->count() > 0)
            {
                return redirect()->back()
                    ->withErrors(['counsellor_mobile_no' => 'Mobile No Already Exist'])
                    ->withInput();
            }

            if($request->hasFile('counsellor_document'))
            {
                if($counsellor->counsellor_document != null)
                {
                unlink(storage_path('/app/public/counsellor_documents/'.$counsellor->counsellor_document));
                }
                $extension = $request->file('counsellor_document')->getClientOriginalExtension();
                $new_file_name = str_replace(".", "-", microtime(true)) . "." . $extension;
                Storage::put('public/counsellor_documents/' . $new_file_name, file_get_contents($request->file('counsellor_document')->getRealPath()));
                $counsellor->counsellor_document = $new_file_name;
            }
            $counsellor->counsellor_id = $request->counsellor_id;
            $counsellor->counsellor_name = $request->counsellor_name;
            $counsellor->counsellor_email_id = $request->counsellor_email_id;
            $counsellor->counsellor_mobile_no = $request->counsellor_mobile_no;
            if(isset($request->counsellor_password) && $request->counsellor_password != '')
            {
                $counsellor->counsellor_password = bcrypt($request->counsellor_password);
            }
            $counsellor->save();
            return redirect('admin/counsellor/list')->with('success','Counsellor Updated Successfully!');


        }
    }

    public function delete($id)
    {
        $delete_counsellor = Counsellor::find($id);
        if($delete_counsellor->counsellor_document  != null)
        {
            unlink(storage_path('/app/public/counsellor_documents/'.$delete_counsellor->counsellor_document));
        }
        $delete_counsellor->delete();
        return redirect('admin/counsellor/list')->with('success','Counsellor Delete Successfully!');
    }
}
