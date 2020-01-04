<?php

namespace App\Modules\Video\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Standard\Models\Standard;
use App\Modules\Subject\Models\Subject;
use App\Modules\Video\Models\Video;
use App\Modules\Video\Models\CorrectAnswer;
use App\Modules\Chapter\Models\Chapter;
use App\Modules\Topic\Models\Topic;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class VideoController extends Controller
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
    public function listVideo()
    {
        return view('Video::list');
    }

    public function data()
    {
        $videos = Video::orderBy('id','desc')->get();

        foreach ($videos as $video)
        {
            $video->standard_name = $video->topic->chapter->subject->standard->name;
            $video->subject_name = $video->topic->chapter->subject->name;
            $video->chapter_name = $video->topic->chapter->name;
            $video->topic_name = $video->topic->name;
        }
        return Datatables::of($videos)
            ->addColumn('name', function($video) {
                return $video->name;
            })
            ->addColumn('link', function($video) {
                return $video->link;
            })
           ->rawColumns(['question'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->isMethod("GET"))
        {
            $standards = Standard::all();
            return view('Video::create',['standards'=>$standards]);
        }
        else
        {
            $video =  new Video();
            $video->topic_id = $request->topic;
            $video->name = $request->name;
            $video->link = $request->link;
            $video->save();

            return redirect('admin/video/list')->with('success','Video Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $video = Video::find($id);
        if($request->method()=="GET")
        {
            $standards = Standard::all();
            return view('Video::update',['standards'=>$standards,'video'=>$video]);
        }
        else
        {
            $video->topic_id = $request->topic;
            $video->name = $request->name;
            $video->link = $request->link;
            $video->save();

            return redirect('admin/video/list')->with('success','Video Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Video::find($id)->delete();
        return redirect('admin/video/list')->with('success','Video Delete Successfully!');
    }

    public function getSubject(Request $request)
    {
        return Subject::where('standard_id',$request->standard)->get();
    }

    public function getChapter(Request $request)
    {
        return Chapter::where('subject_id',$request->subject)->get();
    }
    
    public function getTopic(Request $request)
    {
        return Topic::where('chapter_id',$request->chapter)->where('related_with','1')->get();
    }
}
