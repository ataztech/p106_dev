<?php

namespace App\Modules\Concept\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Standard\Models\Standard;
use App\Modules\Subject\Models\Subject;
use App\Modules\Concept\Models\Concept;
use App\Modules\Chapter\Models\Chapter;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class ConceptController extends Controller
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
     * Show the application dashChapter::
     *
     * @return \Illuminate\Http\Response
     */
    public function listConcept()
    {
        return view('Concept::list');
    }

    public function data()
    {
        $concepts = Concept::orderBy('id','desc')->get();

        foreach ($concepts as $concept)
        {
           
            $concept->type = $concept->conceptType->type;
            $concept->standard_name = $concept->chapter->subject->standard->name;
            $concept->subject_name = $concept->chapter->subject->name;
            $concept->chapter_name = $concept->chapter->name;
        }
        return Datatables::of($concepts)
            
           ->rawColumns(['concept'])
            ->make(true);
    }

    public function upload(Request $request)
    {
        if($request->isMethod("GET"))
        {
            $standards = Standard::all();
            $conceptType = \App\Modules\Concept\Models\ConceptType::all();
            
            return view('Concept::create',['standards'=>$standards, 'conceptType'=>$conceptType]);
        }else{


            $concept =  new Concept();
            $concept->chapter_id = $request->chapter;
            if($request->concept_type == '5')
            {
                if ($request->hasFile('pdf'))
                {
                        $ext = $request->pdf->getClientOriginalExtension();
                        $new_name = time() . '.' . $ext;
                        $destination = base_path('public/media/concept/');
                        $request->pdf->move($destination, $new_name);
                        $concept->concept = $new_name;
                }
            
            }
            else
            {
                $concept->concept = $request->concept;
            }
            $concept->concept_type = $request->concept_type;
            $concept->save();
            $result = array('msg' => 'success');
            return json_encode($result);


            //return redirect('admin/concept/list')->with('success','Concept Added Successfully!');
        }
    }
    public function create(Request $request)
    {
        if($request->isMethod("GET"))
        {
            $standards = Standard::all();
            $conceptType = \App\Modules\Concept\Models\ConceptType::all();
            
            return view('Concept::create',['standards'=>$standards, 'conceptType'=>$conceptType]);
        }
        else
        {
            $concept =  new Concept();
            $concept->chapter_id = $request->chapter;
            $concept->concept = $request->concept;
            $concept->concept_type = $request->concept_type;
            $concept->save();

            return redirect('admin/concept/list')->with('success','Concept Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $concept = Concept::find($id);
        if($request->method()=="GET")
        {
            $standards = Standard::all();
            $conceptType = \App\Modules\Concept\Models\ConceptType::all();
            return view('Concept::update',['standards'=>$standards,'concept'=>$concept, 'conceptType'=>$conceptType]);
        }
        else
        {
            $concept->chapter_id = $request->chapter;
            $concept->concept = $request->concept;
            $concept->concept_type = $request->concept_type;
            $concept->save();

            return redirect('admin/concept/list')->with('success','Concept Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Concept::find($id)->delete();
        return redirect('admin/concept/list')->with('success','Concept Delete Successfully!');
    }

    public function getSubject(Request $request)
    {
        return Subject::where('standard_id',$request->standard)->get();
    }

    public function getChapter(Request $request)
    {
        return Chapter::where('subject_id',$request->subject)->get();
    }
}
