<?php

namespace App\Modules\Subject\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Standard\Models\Standard;
use App\Modules\Subject\Models\Subject;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class SubjectController extends Controller
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
     * Show the application dashSubject::
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('Subject::list');
    }

    public function data()
    {
        $subjects = Subject::orderBy('id','desc')->get();

        foreach ($subjects as $subject)
        {
            $subject->standard_name = $subject->standard->name;
        }
        return Datatables::of($subjects)
//            ->addColumn('image', function($subject) {
//                return '<label>jhgjg</label>';
//            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->isMethod("GET"))
        {
            $standards = Standard::all();
            return view('Subject::create',['standards'=>$standards]);
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
            $subject =  new Subject();
            $subject->standard_id = $request->standard;
            $subject->name = $request->name;

            if ($request->hasFile('image')) {

                $image = fileUploadHelper::fileUpload(['file_type'=>'image','html_input_name'=>'image','file'=>$request->image,
                    'destination'=>'/storage/app/public/subject','resize'=>['resize'=>true,'height'=>100,'width'=>100,'resize_destination'=>'/storage/app/public/subject/thumb']]);

                if(isset($image['error_code']) && $image['error_code'])
                {
                    dd($image);
                }
                else
                {
                    $subject->link = '/storage/app/public/subject/';
                    $subject->image = $image[0];
                }

            }

            $subject->save();
            return redirect('admin/subject/list')->with('success','Subject Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $subject = Subject::find($id);
        if($request->method()=="GET")
        {
            $standards = Standard::all();
            return view('Subject::update',['subject'=>$subject,'standards'=>$standards]);
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
            $subject->name = $request->name;
            $subject->standard_id = $request->standard;
            $subject->save();
            return redirect('admin/subject/list')->with('success','Subject Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Subject::find($id)->delete();
        return redirect('admin/subject/list')->with('success','Subject Delete Successfully!');
    }


}
