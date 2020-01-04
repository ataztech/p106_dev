<?php

namespace App\Modules\QuestionAnswer\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Standard\Models\Standard;
use App\Modules\Subject\Models\Subject;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
use App\Modules\QuestionAnswer\Models\CorrectAnswer;
use App\Modules\Chapter\Models\Chapter;
use App\Modules\Topic\Models\Topic;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class QuestionAnswerController extends Controller
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

    public function getCkImage(Request $request){
        $CKEditor = $request->CKEditor;
        $funcNum = $request->CKEditorFuncNum;
        $message = $url = '';
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->move(storage_path().'/images/', $filename);
                $url = url('/storage/images/' . $filename);
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
    /**
     * Show the application dashChapter::
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('QuestionAnswer::list');
    }

    public function data()
    {
        $question_answers = QuestionAnswer::orderBy('id','desc')->get();

        foreach ($question_answers as $question_answer)
        {
            $question_answer->standard_name = $question_answer->topic->chapter->subject->standard->name;
            $question_answer->subject_name = $question_answer->topic->chapter->subject->name;
            $question_answer->chapter_name = $question_answer->topic->chapter->name;
            $question_answer->topic_name = $question_answer->topic->name;
        }
        return Datatables::of($question_answers)
            ->addColumn('answer_type', function($question_answer) {
                return $question_answer->answer_type ? 'Multiple' : 'Single';
            })
            ->addColumn('question', function($question_answer) {
                return htmlspecialchars_decode(htmlspecialchars_decode($question_answer->question));
            })
           ->rawColumns(['question'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->isMethod("GET"))
        {
            $standards = Standard::all();
            return view('QuestionAnswer::create',['standards'=>$standards]);
        }
        else
        {
            
            $question_answer =  new QuestionAnswer();
            $question_answer->topic_id = $request->topic;
            $question_answer->question = $request->question;
            $question_answer->chapter_id = $request->chapter;
            $question_answer->subject_id = $request->subject;
            $question_answer->option_1 = $request->option1;
            $question_answer->option_2 = $request->option2;
            $question_answer->option_3 = $request->option3;
            $question_answer->option_4 = $request->option4;
            $question_answer->option_5 = $request->option5;
            $question_answer->answer_type = $request->answer_type;
            $question_answer->reason = $request->reason;
            $question_answer->save();

            foreach($request->answer as $ans)
            {
                CorrectAnswer::create(['question_answer_id'=>$question_answer->id,'answer'=>$ans]);
            }
            return redirect('admin/question-answer/list')->with('success','Question And Answer Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $question_answer = QuestionAnswer::find($id);
        if($request->method()=="GET")
        {
            $standards = Standard::all();
            $correct_answers = CorrectAnswer::where('question_answer_id',$id)->get()->pluck('answer')->toArray();
            return view('QuestionAnswer::update',['standards'=>$standards,'question_answer'=>$question_answer,'correct_answers'=>$correct_answers]);
        }
        else
        {
            $question_answer->topic_id = $request->topic;
            $question_answer->question = $request->question;
            $question_answer->option_1 = $request->option1;
            $question_answer->option_2 = $request->option2;
            $question_answer->option_3 = $request->option3;
            $question_answer->option_4 = $request->option4;
            $question_answer->option_5 = $request->option5;
            $question_answer->answer_type = $request->answer_type;
            $question_answer->reason = $request->reason;
            $question_answer->save();

            CorrectAnswer::where('question_answer_id',$question_answer->id)->delete();
            foreach($request->answer as $ans)
            {
                CorrectAnswer::create(['question_answer_id'=>$question_answer->id,'answer'=>$ans]);
            }
            return redirect('admin/question-answer/list')->with('success','Question And Answer Updated Successfully!');
        }
    }

    public function delete($id)
    {
        QuestionAnswer::find($id)->delete();
        return redirect('admin/question-answer/list')->with('success','Question And Answer Delete Successfully!');
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
        return Topic::where('chapter_id',$request->chapter)->where('related_with','0')->get();
    }
}
