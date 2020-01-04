<?php

namespace App\Modules\QuestionAnswerSet\Controllers;

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
use App\Modules\QuestionAnswerSet\Models\TopTenQuestion;
use App\Modules\QuestionAnswerSet\Models\NcrtSolution;
use App\Modules\QuestionAnswerSet\Models\PreviousQuestionPaper;

class QuestionAnswerSetController extends Controller
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
    public function listQuestionAnswerSet(Request $request)
    {
        $standards = Standard::all();
        $chapter_id = isset($request->chapter_id) ? $request->chapter_id : '';
        return view('QuestionAnswerSet::list',['standards'=>$standards,'chapter_id'=>$chapter_id]);
    }
    
    public function listNcrtSolution($chapter_id)
    {
        $chapter = Chapter::find($chapter_id);
        return view('QuestionAnswerSet::ncrt-solution-list',['chapter'=>$chapter]);
    }

    public function data(Request $request)
    {
        $chapter_id = $request->chapter_id !='' ? $request->chapter_id : 0;
        $chapter = Chapter::where('id',$chapter_id)->get();

        return datatables::of($chapter)
                ->addColumn('standard', function($chap) {
                    return $chap->subject->standard->name;
                })
                ->addColumn('subject', function($chap) {
                    return $chap->subject->name;
                })
            ->addColumn('topten', function($chap) {
                $button = '<a href="'.url("admin/question-answer-sets/top-10/easy/".$chap->id).'" class="btn btn-primary btn-xs">Top 10 Easy Questions</a><br>';
                $button .= '<a href="'.url("admin/question-answer-sets/top-10/medium/".$chap->id).'" class="btn btn-info btn-xs">Top 10 Medium Questions</a><br>';
                $button .= '<a href="'.url("admin/question-answer-sets/top-10/hard/".$chap->id).'" class="btn btn-danger btn-xs">Top 10 Hard Questions</a>';
                return $button;
            })
           ->rawColumns(['topten'])
            ->make(true);
    }
    public function NcrtSolutiondata($chapter_id)
    {
        $ncrt_solution = NcrtSolution::where('chapter_id', $chapter_id)->orderBy('id','DESC')->get();
        return datatables::of($ncrt_solution)
                ->addColumn('question', function($ncrt) {
                    return htmlspecialchars_decode(htmlspecialchars_decode($ncrt->question));
                })
                ->addColumn('type', function($chap) {
                    if($chap->type == 1)
                    {
                    return 'Q&A Solution';
                        
                    }
                    return 'File';
                })
            ->rawColumns(['question'])
            ->make(true);
    }

    public function create(Request $request,$chapter_id)
    {
        if($request->isMethod("GET"))
        {
            $chapter = Chapter::find($chapter_id);
            return view('QuestionAnswerSet::create',['chapter'=>$chapter]);
        }
        else
        {
            $ncrt =  new NcrtSolution();
            $ncrt->chapter_id = $request->chapter;
            $ncrt->question = $request->question;
            $ncrt->solution = $request->solution;
            $ncrt->save();

            return redirect('admin/question-answer-sets/ncrt-solutions/'.$chapter_id)->with('success','NCRT Solution Added Successfully!');
        }
    }
    
    public function upload(Request $request,$chapter_id)
    {
        if($request->isMethod("GET"))
        {
            $chapter = Chapter::find($chapter_id);
            return view('QuestionAnswerSet::upload',['chapter'=>$chapter]);
        }else
        {   
            
            
            $ncrt =  new NcrtSolution();
            $ncrt->chapter_id = $request->chapter;
            
            if($request->type==1)
            {
                $ncrt->question = $request->editor_question;
                    $ncrt->solution = $request->editor_option1;
            }else{
            
                if ($request->hasFile('pdf')) {
                    $ext = $request->pdf->getClientOriginalExtension();
                    $new_name = time() . '.' . $ext;
                    $destination = base_path('public/media/ncrt/');
                    $request->pdf->move($destination, $new_name);   
                    $ncrt->solution = $new_name;
            }
                    $ncrt->question = "";
            }
            
                
                    
            $ncrt->type = $request->type;
            $ncrt->save();

            return redirect('admin/question-answer-sets/ncrt-solutions/'.$chapter_id)->with('success','NCRT Solution Added Successfully!');
        }
    }

    public function update(Request $request,$ncrt_id)
    {
        $ncrt = NcrtSolution::find($ncrt_id);
        if($request->method()=="GET")
        {
            return view('QuestionAnswerSet::update',['ncrt'=>$ncrt]);
        }
        else
        {
            $ncrt->question = $request->question;
            $ncrt->solution = $request->solution;
            $ncrt->save();

            return redirect('admin/question-answer-sets/ncrt-solutions/'.$ncrt->chapter_id)->with('success','NCRT Solution Updated Successfully!');
        }
    }

    public function delete($id)
    {
        $ncrt = NcrtSolution::find($id);
        $chapter_id = $ncrt->chapter_id;
        $ncrt->delete();
        return redirect('admin/question-answer-sets/ncrt-solutions/'.$chapter_id)->with('success','NCRT Solution Deleted Successfully!');
    }
    
    public function getQuestionLevel($level)
    {
        switch ($level)
        {
            case 'easy':
                return ['1','2'];
            case 'medium':
                return ['0','2'];
            case 'hard':
                return ['0','1'];
        }
    }
    
    public function getLevel($level)
    {
        switch ($level)
        {
            case 'easy':
                return '0';
            case 'medium':
                return '1';
            case 'hard':
                return '2';
        }
    }

        public function setQuestion(Request $request,$level,$chapter_id)
    {
            
            
        $other_level = $this->getQuestionLevel($level);
        
//        get topic ids of respective chapter
        $topic_ids = Topic::where('chapter_id',$chapter_id)->get()->pluck('id');
        
        
//        get question ids of that question which are not set in another level
        $top_ten_other_level_que = TopTenQuestion::where('chapter_id',$chapter_id)->whereIn('level',$other_level)->get()->pluck('question_id');
        
//        get set questions
        $selected_questions = TopTenQuestion::where('chapter_id',$chapter_id)->where('level',$this->getLevel($level))->get()->pluck('question_id')->toArray();
        
        
        
//        get all question of perticuler chapter using topic ids and not det in another level
        $all_questions = QuestionAnswer::where('chapter_id',$chapter_id)->whereIn('topic_id',$topic_ids)->whereNotIn('id',$top_ten_other_level_que)->get();
        
        
        
        
        if($request->method() == 'GET')
        {
            return view('QuestionAnswerSet::question-list',array('all_questions'=>$all_questions,'level'=>$level,'selected_questions'=>$selected_questions));
        }
        else
        {
            TopTenQuestion::where('chapter_id',$chapter_id)->where('level',$this->getLevel($level))->delete();
            foreach ($request->question_ids as $question_id)
            {
                TopTenQuestion::create(array('question_id'=>$question_id,'level'=>$this->getLevel($level), 'chapter_id'=>$chapter_id));
            }
            return redirect('admin/question-answer-set/list')->with('success','Top 10 '.ucfirst($level).' Questions Set Successfully');
        }
    }
    
    public function priviousQuestions(Request $request,$chapter_id)
    {
        if($request->isMethod('GET'))
        {
            $topic_ids = Topic::where('chapter_id',$chapter_id)->get()->pluck('id');
            $previous_question_ids = PreviousQuestionPaper::all()->pluck('question_id')->toArray();
            $chapter = Chapter::find($chapter_id);
    //        get all question of perticuler chapter using topic ids and not det in another level
            $all_questions = QuestionAnswer::whereIn('topic_id',$topic_ids)->paginate(30);
            
            return view('QuestionAnswerSet::previous-question-paper',array('all_questions'=>$all_questions,'previous_question_ids'=>$previous_question_ids,'chapter'=>$chapter));
        }
        else
        {
            PreviousQuestionPaper::where('chapter_id',$chapter_id)->delete();
            
            foreach($request->question_ids as $question_id)
            {
                PreviousQuestionPaper::create(array('chapter_id'=>$chapter_id,'question_id'=>$question_id));
            }
            return redirect('admin/question-answer-set/list')->with('success','Previous Question Papers Set Successfully');
        }
        
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
