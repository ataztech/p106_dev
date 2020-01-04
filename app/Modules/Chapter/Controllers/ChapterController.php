<?php

namespace App\Modules\Chapter\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Standard\Models\Standard;
use App\Modules\Subject\Models\Subject;
use App\Modules\Chapter\Models\Chapter;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class ChapterController extends Controller
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
    public function list()
    {
        return view('Chapter::list');
    }

    public function data()
    {
        $chapters = Chapter::orderBy('id','desc')->get();

        foreach ($chapters as $chapter)
        {
            $chapter->standard_name = $chapter->subject->standard->name;
            $chapter->subject_name = $chapter->subject->name;
        }
        return Datatables::of($chapters)
            ->addColumn('board', function($chapter) {
                if($chapter->board_id ==2)
                {
                return 'CBSE';
                }else{
                    return 'MHSB';
                }
            })
            ->make(true);
    }

    public function create(Request $request)
  {
        if($request->isMethod("GET"))
        {
            $subjects = Subject::all();
            return view('Chapter::create',['subjects'=>$subjects]);
        }
        else
        {

            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'board' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $chapter =  new Chapter();
            $chapter->subject_id = $request->subject;
            $chapter->name = $request->name;
            $chapter->board_id = $request->board;
            
            if($request->has('extra'))
            {
                $chapter->extra = '1';
            }else{
                $chapter->extra = '0';
            }

            $chapter->save();
            return redirect('admin/chapter/list')->with('success','Chapter Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $chapter = Chapter::find($id);
        if($request->method()=="GET")
        {
            $subjects = Subject::all();
            return view('Chapter::update',['chapter'=>$chapter,'subjects'=>$subjects]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'board' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $chapter->name = $request->name;
            $chapter->board_id = $request->board;
            $chapter->subject_id = $request->subject;
            
            
            if($request->has('extra'))
            {
                
                
                $chapter->extra = '1';
            }else{
                $chapter->extra = '0';
            }
            
            $chapter->save();
            
            return redirect('admin/chapter/list')->with('success','Chapter Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Chapter::find($id)->delete();
        return redirect('admin/chapter/list')->with('success','Chapter Delete Successfully!');
    }


}
