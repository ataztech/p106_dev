<?php

namespace App\Modules\Topic\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Chapter\Models\Chapter;
use App\Modules\Subject\Models\Subject;
use App\Modules\Topic\Models\Topic;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class TopicController extends Controller
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
     * Show the application dashTopic::
     *
     * @return \Illuminate\Http\Response
     */
    public function listTopic()
    {
        return view('Topic::list');
    }

    public function data()
    {
        $topics = Topic::orderBy('id','desc')->get();

        foreach ($topics as $topic)
        {
            $topic->standard_name = $topic->chapter->subject->standard->name;
            $topic->subject_name = $topic->chapter->subject->name;
            $topic->chapter_name = $topic->chapter->name;
        }
        return Datatables::of($topics)
            ->addColumn('related_with', function($topic) {
                return $topic->related_with ? 'Videos' : 'Question And Answers';
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->isMethod("GET"))
        {
            $subjects = Subject::all();
            return view('Topic::create',['subjects'=>$subjects]);
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
            $topic =  new Topic();
            $topic->chapter_id = $request->chapter;
            $topic->name = $request->name;
            $topic->related_with = $request->related_with;

            $topic->save();
            return redirect('admin/topic/list')->with('success','Topic Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $topic = Topic::find($id);
        if($request->method()=="GET")
        {
            $subjects = Subject::all();
            return view('Topic::update',['topic'=>$topic,'subjects'=>$subjects]);
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
            $topic->name = $request->name;
            $topic->chapter_id = $request->chapter;
            $topic->related_with = $request->related_with;
            $topic->save();
            return redirect('admin/topic/list')->with('success','Topic Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Topic::find($id)->delete();
        return redirect('admin/topic/list')->with('success','Topic Delete Successfully!');
    }

    public function getChapter(Request $request)
    {
        return Chapter::where('subject_id',$request->subject)->get();
    }

}
