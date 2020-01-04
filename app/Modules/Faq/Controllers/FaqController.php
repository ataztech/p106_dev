<?php

namespace App\Modules\Faq\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Faq\Models\Faq;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;

class FaqController extends Controller
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
        return view('Faq::list');
    }

    public function data()
    {
        $faqs = Faq::orderBy('id','desc')->get();

        return Datatables::of($faqs)
            //    ->addColumn('answer', function($faq) {
            //        return '<textarea>'.$faq->answer.'</textarea>';
            //    })
            // ->rawColumns(['answer'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Faq::create');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'answer' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $faq =  new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
            return redirect('admin/faq/list')->with('success','Faq Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $faq = Faq::find($id);
        if($request->method()=="GET")
        {
            return view('Faq::update',['faq'=>$faq]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'answer' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
            return redirect('admin/faq/list')->with('success','Faq Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Faq::find($id)->delete();
        return redirect('admin/faq/list')->with('success','Faq Delete Successfully!');
    }
}
