<?php
namespace App\Modules\Learn\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Modules\Chapter\Models\Chapter;
use App\Modules\Topic\Models\Topic;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
use App\Modules\QuestionAnswer\Models\QuestionsAnswersFilter;
use App\Modules\Video\Models\Video;
class LearnController extends Controller
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

    public function chapterList($subject_id){
        
        
        
        
        if(Auth::user()->configureSyllabus->exam_flag == 1){
           $subject_data = \App\Modules\Subject\Models\Subject::where('id', base64_decode($subject_id))->first();
           
           
           $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();
           if($subject_data->name=="Biology")
           {
               
               
            $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();    
           }else{
            $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '0')->get();    

           }
        }else{
            $subject_data = \App\Modules\Subject\Models\Subject::where('id', base64_decode($subject_id))->first();
            $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();
           
            if($subject_data->name=="Biology")
           {
                
            $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();    
           }else{
            $arr_chapters = Chapter::where('subject_id',base64_decode($subject_id))->where('board_id',2)->where('extra', '0')->get();
           }
           
        }
        
        $arr_chapters = $arr_chapters->reject(function($obj){
            
            if(count($obj->questionCount)==0)
            {
                return true;
            }
            return false;
        });
        
        $arr_chapters = $arr_chapters->values();
           
        return view('Learn::chapters-list',['arr_chapters'=>$arr_chapters]);
    }
    public function examinerChapterList($subject_id){
        
        if(Auth::user()->configureSyllabus->exam_flag == 1){
        
           $subject_data = \App\Modules\Subject\Models\Subject::where('id', base64_decode($subject_id))->first();
           
           
           $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();
           if($subject_data->name=="Biology")
           {
               
               
            $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();    
           }else{
            $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '0')->get();    

           }
        }else{
            $subject_data = \App\Modules\Subject\Models\Subject::where('id', base64_decode($subject_id))->first();
            $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();
           
            if($subject_data->name=="Biology")
           {
                
            $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();    
           }else{
            $arr_chapters = Chapter::where('subject_id',base64_decode($subject_id))->where('board_id',2)->where('extra', '0')->get();
           }
           
        }
        
        $arr_chapters = $arr_chapters->reject(function($obj){
            
            if(count($obj->questionCount)==0)
            {
                return true;
            }
            return false;
        });
        
        $arr_chapters = $arr_chapters->values();
           
        return view('Learn::examiner-chapters-list',['arr_chapters'=>$arr_chapters]);
    }
    public function chapterTopicList($subject_id, $chapter_id){
        
        
        $arr_exclude_topics_ids = [1000,1001,1002,1003,1004,1005,1006,1007,1008,1009,1010,609, 614, 615, 616, 618, 626,
            840, 855, 1019, 27, 66, 115, 170, 190, 227, 274, 224, 275, 288,313, 317, 950, 1507, 1550, 1551, 1556,1557,2083, 2086, 644, 658, 668, 670, 680, 701, 691, 692, 693, 694, 695, 696];
        $arr_topics = Topic::where('chapter_id',base64_decode($chapter_id))->where('related_with','0')->whereNotIn('id', $arr_exclude_topics_ids)->get();
        
        
        $arr_topic_ids = $arr_topics->pluck('id');
        $arr_video_topics = Topic::where('chapter_id',base64_decode($chapter_id))->where('related_with','1')->get();
        $concepts = \App\Modules\Concept\Models\Concept::where('chapter_id',base64_decode($chapter_id))->get();
        
        $total_chapters_questions = QuestionsAnswersFilter::whereIn('topic_id',$arr_topic_ids)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',base64_decode($chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->count();
        
        $total_question_answered_time_taken = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',base64_decode($chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->sum('time_taken');
        $time_taken['minutes'] = (int)($total_question_answered_time_taken/60);
        $time_taken['seconds'] = ($total_question_answered_time_taken%60);
        
        $total_question_correct_answer = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',base64_decode($chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '1')
                ->count();
        if($total_question_answered>0)
        {
        $accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
        $accuracy = 0;
        }
        
        $converted_minutes = $total_question_answered_time_taken/60;
        $converted_hours = $converted_minutes/60;
        
        
        if($converted_hours>0)
        {
        $speed = (int)(round($total_question_answered/$converted_hours));
        }else{
            $speed = 0;
        }
        
        
        
        if($total_chapters_questions>0)
        {
        $overall_progress = round(($total_question_answered/$total_chapters_questions)*100,2);
        }else{
        $overall_progress = 0;
        }
        
        $chapter_data = Chapter::find(base64_decode($chapter_id));
        $conceptType = \App\Modules\Concept\Models\ConceptType::all();
//        dd($chapter_data);
        return view('Learn::topic-list',[
            'arr_topics'=>$arr_topics, 
            'chapter_data'=>$chapter_data, 
            'arr_video_topics'=>$arr_video_topics,
            'subject_id'=>$subject_id, 
            'concepts'=>$concepts, 
            'chapter_id'=>$chapter_id, 
            'total_question_answered'=>$total_question_answered,
            'accuracy'=>$accuracy,
            'overall_progress'=>$overall_progress,
            'time_taken'=>implode(':',$time_taken),
            'conceptType'=>$conceptType,
            'speed'=>$speed
            ]);
    }
    public function examinerChapterTopicList($subject_id, $chapter_id){
        
        
        $arr_exclude_topics_ids = [1000,1001,1002,1003,1004,1005,1006,1007,1008,1009,1010];
        $arr_topics = Topic::where('chapter_id',base64_decode($chapter_id))->where('related_with','0')->whereNotIn('id', $arr_exclude_topics_ids)->get();
        
        
        $arr_topic_ids = $arr_topics->pluck('id');
        $arr_video_topics = Topic::where('chapter_id',base64_decode($chapter_id))->where('related_with','1')->get();
        $concepts = \App\Modules\Concept\Models\Concept::where('chapter_id',base64_decode($chapter_id))->get();
        
        $total_chapters_questions = QuestionsAnswersFilter::whereIn('topic_id',$arr_topic_ids)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',base64_decode($chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->count();
        
        $total_question_answered_time_taken = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',base64_decode($chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->sum('time_taken');
        $time_taken['minutes'] = (int)($total_question_answered_time_taken/60);
        $time_taken['seconds'] = ($total_question_answered_time_taken%60);
        
        $total_question_correct_answer = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',base64_decode($chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '1')
                ->count();
        if($total_question_answered>0)
        {
        $accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
        $accuracy = 0;
        }
        
        $converted_minutes = $total_question_answered_time_taken/60;
        $converted_hours = $converted_minutes/60;
        
        
        if($converted_hours>0)
        {
        $speed = (int)(round($total_question_answered/$converted_hours));
        }else{
            $speed = 0;
        }
        
        
        
        if($total_chapters_questions>0)
        {
        $overall_progress = round(($total_question_answered/$total_chapters_questions)*100,2);
        }else{
        $overall_progress = 0;
        }
        
        $chapter_data = Chapter::find(base64_decode($chapter_id));
        $conceptType = \App\Modules\Concept\Models\ConceptType::all();
//        dd($chapter_data);
        return view('Learn::examiner-topic-list',[
            'arr_topics'=>$arr_topics, 
            'chapter_data'=>$chapter_data, 
            'arr_video_topics'=>$arr_video_topics,
            'subject_id'=>$subject_id, 
            'concepts'=>$concepts, 
            'chapter_id'=>$chapter_id, 
            'total_question_answered'=>$total_question_answered,
            'accuracy'=>$accuracy,
            'overall_progress'=>$overall_progress,
            'time_taken'=>implode(':',$time_taken),
            'conceptType'=>$conceptType,
            'speed'=>$speed
            ]);
    }
 
    
    public function ncertSolutions($subject_id, $chapter_id)
    {
        $question_answer = \App\Modules\QuestionAnswerSet\Models\NcrtSolution::where('chapter_id', base64_decode($chapter_id))->get();
        
        $chapter_data = Chapter::find(base64_decode($chapter_id));
        return view('Learn::ncert-questions',['chapter_data'=>$chapter_data ,"question_answer"=>$question_answer,'chapter_id'=>$chapter_id, 'subject_id'=>$subject_id]);
    }
    
    public function previousPapers($subject_id, $chapter_id)
    {
        
        $question_answer = \App\Modules\QuestionAnswerSet\Models\PreviousQuestionPaper::where('chapter_id',base64_decode($chapter_id))->get();
        
        $chapter_data = Chapter::find(base64_decode($chapter_id));
        return view('Learn::previous_papers',['chapter_data'=>$chapter_data, "question_answer"=>$question_answer, 'chapter_id'=>$chapter_id, 'subject_id'=>$subject_id]);
    }
    public function getChapterDifficultyQuestions($subject_id, $chapter_id, $level)
    {
        $lev = "0";
        switch ($level)
        {
            case 'easy':
                $lev =  '0';
                break;
            case 'medium':
                $lev = '1';
                break;
            case 'hard':
                $lev = '2';
                break;
        }
        
        
        $chapter_data = Chapter::find(base64_decode($chapter_id));
        
        $question_answer = \App\Modules\QuestionAnswerSet\Models\TopTenQuestion::where('chapter_id', base64_decode($chapter_id))->where('level',$lev)->skip(0)->take(1)->first();
//        $question_answer = \App\Modules\QuestionAnswerSet\Models\TopTenQuestion::where('chapter_id', base64_decode($chapter_id))->where('level','0')->get();

//        dd($question_answer);
        if(!isset($question_answer->question))
        {
            $question_answer['question'] = null;
            $question_answer = (object)$question_answer;
        }
        
        
        
        return view('Learn::top-ten-questions',['chapter_data'=>$chapter_data ,"question_answer"=>$question_answer->question,'chapter_id'=>$chapter_id, 'level'=>$level,'subject_id'=>$subject_id]);
    }
    
    
    
    public function nextTopTenQuestion(Request $request, $level, $chapter_id){
        
        $lev = "0";
        switch ($level)
        {
            case 'easy':
                $lev =  '0';
                break;
            case 'medium':
                $lev = '1';
                break;
                
            case 'hard':
                $lev = '2';
                break;
        }
        
        
        $question_answer = \App\Modules\QuestionAnswerSet\Models\TopTenQuestion::where('level',$lev)->where('chapter_id', base64_decode($chapter_id))->skip($request->index)->take(1)->first();
        
         return view('Learn::ajax-top-ten',["question_answer"=>$question_answer->question]);
    }
    
    public function chapterTopicAssess($subject_id, $chapter_id, $topic_id){
        
        $arr_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',base64_decode($topic_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('chapter_id',base64_decode($chapter_id))
                ->pluck('question_id');
        
        
        $question_answer = QuestionsAnswersFilter::where('topic_id',base64_decode($topic_id))
                ->whereNotIn('id', $arr_question_answered)
                ->skip(0)
                ->take(1)
                ->first();
        
        
        $total_question= QuestionsAnswersFilter::where('topic_id',base64_decode($topic_id))
                ->whereNotIn('id', $arr_question_answered)
                ->count();
        $arr_topics = Topic::where('id','!=',base64_decode($topic_id))
                ->where('chapter_id',base64_decode($chapter_id))
                ->where('related_with','0')
                ->get();
        $chapter_data = Chapter::find(base64_decode($chapter_id));
        
        
        return view('Learn::topic-assess',['arr_topics'=>$arr_topics, 'chapter_data'=>$chapter_data, "question_answer"=>$question_answer, 'total_question'=>$total_question, 'chapter_id'=>$chapter_id]);
    }
    public function examinerChapterTopicAssess($subject_id, $chapter_id, $topic_id){
        
        $arr_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',base64_decode($topic_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('chapter_id',base64_decode($chapter_id))
                ->pluck('question_id');
        
        
        $question_answer = QuestionAnswer::where('topic_id',base64_decode($topic_id))
                ->whereNotIn('id', $arr_question_answered)
                ->skip(0)
                ->take(1)
                ->first();
        
        
        $total_question= QuestionAnswer::where('topic_id',base64_decode($topic_id))
                ->whereNotIn('id', $arr_question_answered)
                ->count();
        $arr_topics = Topic::where('id','!=',base64_decode($topic_id))
                ->where('chapter_id',base64_decode($chapter_id))
                ->where('related_with','0')
                ->get();
        $chapter_data = Chapter::find(base64_decode($chapter_id));
        
        
        return view('Learn::examiner-topic-assess',['arr_topics'=>$arr_topics, 'chapter_data'=>$chapter_data, "question_answer"=>$question_answer, 'total_question'=>$total_question, 'chapter_id'=>$chapter_id]);
    }
    
    
    public function submitReport(Request $request)
    {
        $obj = new \App\Modules\Learn\Models\QuestionReport();
        $obj->topic_id = $request->topic_id;
        $obj->question_id = $request->questionId;
        $obj->is_correct = $request->is_correct_ans;
        $obj->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $obj->chapter_id = base64_decode($request->chapter_id);
        $obj->time_taken = $request->time_taken;
        $obj->save();
     
        return json_encode(['result'=>1]);
    }
    public function chapterTopicVideo($subject_id, $chapter_id, $topic_id, $video_id){

        $video = Video::find(base64_decode($video_id));
        
        
        $other_videos = Video::where('topic_id', base64_decode($topic_id))->where('id','!=',base64_decode($video_id))->get();

        return view('Learn::topic-video',['subject_id'=>$subject_id,'chapter_id'=>$chapter_id,'video'=>$video,'other_videos'=>$other_videos]);
    }
    
      public function getAnswer(Request $request){
        $result = \App\Modules\QuestionAnswer\Models\CorrectAnswer::where('question_answer_id',$request->questionId)->first();
        return json_encode(array('result'=>$result));
    }
    
    public function nextQuestion(Request $request){
        $arr_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$request->topic_id)
                ->where('chapter_id',base64_decode($request->chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->pluck('question_id');
        
        $question_answer = QuestionsAnswersFilter::where('topic_id',$request->topic_id)
                ->whereNotIn('id', $arr_question_answered)
//                ->skip($request->index)
                ->take(1)
                ->first();
        
         return view('Learn::ajax-topic-assess',["question_answer"=>$question_answer]);
    }
    public function examinerNextQuestion(Request $request){
        $arr_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$request->topic_id)
                ->where('chapter_id',base64_decode($request->chapter_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->pluck('question_id');
        
        $question_answer = QuestionAnswer::where('topic_id',$request->topic_id)
                ->whereNotIn('id', $arr_question_answered)
//                ->skip($request->index)
                ->take(1)
                ->first();
        
         return view('Learn::ajax-examiner-topic-assess',["question_answer"=>$question_answer]);
    }
    
    
    public function examinerSendReport(Request $request)
    {
        $obj = new \App\Modules\Learn\Models\Issue();
        $obj->chapter_id = base64_decode($request->chapter_id);
        $obj->wrong_answer = $request->wrong_answer;
        $obj->no_img = $request->no_img;
        $obj->no_solution = $request->no_solution;
        $obj->question_id = $request->question_id;
        $obj->save();
        echo 123;
    }
    public function getReport($topic_id, $chapter_id){
        
        $topic_id = base64_decode($topic_id);
        $chapter_id = base64_decode($chapter_id);
        
        $total_topic_questions = QuestionsAnswersFilter::where('topic_id',$topic_id)->count();
        
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->count();
        
        $total_question_answered_time_taken = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->sum('time_taken');
        
        $time_taken['minutes'] = (int)($total_question_answered_time_taken/60);
        $time_taken['seconds'] = ($total_question_answered_time_taken%60);
        
        $converted_minutes = $total_question_answered_time_taken/60;
        $converted_hours = $converted_minutes/60;
        
        
        if($converted_hours>0)
        {
        $speed = (int)(round($total_question_answered/$converted_hours));
        }else{
            $speed = 0;
        }
        
        $total_question_correct_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '1')
                ->count();
        
        $total_question_skipped_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '2')
                ->count();
        
        $total_question_wrong_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '0')
                ->count();
        
        if($total_question_answered>0)
        {
        $accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
        $accuracy = 0;
        }
        
        
        
        if($total_topic_questions>0)
        {
            $overall_progress = round(($total_question_answered/$total_topic_questions)*100,2);
        }else{
            $overall_progress = 0;
        }
        
        
        
        $arr_topics = Topic::where('id','!=',$topic_id)
                ->where('chapter_id',$chapter_id)
                ->where('related_with','0')
                ->get();
        
        $chapter_data = Chapter::find($chapter_id);
        return view('Learn::test-report',[
            'chapter_data'=>$chapter_data,
            'arr_topics'=>$arr_topics, 
            'chapter_id'=>$chapter_id, 
            'total_question_answered'=>$total_question_answered,
            'total_question_correct_answer'=>$total_question_correct_answer,
            'total_question_skipped_answer'=>$total_question_skipped_answer,
            'total_question_wrong_answer'=>$total_question_wrong_answer,
            'accuracy'=>$accuracy,
            'overall_progress'=>$overall_progress,
            'time_taken'=>implode(':',$time_taken),
            'speed'=>$speed
            ]);
        
         
    }
    public function ajaxGetPauseReport(Request $request){
        
        $topic_id = base64_decode($request->topic_id);
        $chapter_id = base64_decode($request->chapter_id);
        
        $total_topic_questions = QuestionsAnswersFilter::where('topic_id',$topic_id)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->count();
        
        
        $total_question_answered_time_taken = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->sum('time_taken');
        
        
        $converted_minutes = $total_question_answered_time_taken/60;
        $converted_hours = $converted_minutes/60;
        
        if($converted_hours>0)
        {
        $speed = (int)(round($total_question_answered/$converted_hours));
        }else{
            $speed = 0;
        }
        $time_taken['minutes'] = (int)($total_question_answered_time_taken/60);
        $time_taken['seconds'] = ($total_question_answered_time_taken%60);
//        $time_taken['hour'] = ($total_question_answered_time_taken/3600);
        

        $total_question_correct_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '1')
                ->count();
        
        $total_question_skipped_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '2')
                ->count();
        
        $total_question_wrong_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '0')
                ->count();
        
        if($total_question_answered>0)
        {
            $accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
            $accuracy = 0;
        }
        
        
        
        if($total_topic_questions>0)
        {
            $overall_progress = round(($total_question_answered/$total_topic_questions)*100,2);
        }else{
            $overall_progress = 0;
        }
        
        
        
        
        $arr_topics = Topic::where('id','!=',$topic_id)
                ->where('chapter_id',$chapter_id)
                ->where('related_with','0')
                ->get();
        
        $chapter_data = Chapter::find($chapter_id);
        
        if($request->has('url'))
        {
            $url = $request->url;
        }else{
            $url = -1;
        }
        return view('Learn::ajax-test-report',[
            'chapter_data'=>$chapter_data,
            'arr_topics'=>$arr_topics, 
            'chapter_id'=>$chapter_id, 
            'total_question_answered'=> $total_question_answered,
            'total_question_correct_answer'=> $total_question_correct_answer,
            'total_question_skipped_answer'=> $total_question_skipped_answer,
            'total_question_wrong_answer'=> $total_question_wrong_answer,
            'accuracy'=> $accuracy,
            'overall_progress'=>$overall_progress,
            'time_taken'=>implode(':',$time_taken),
            'speed'=>$speed,
            'url'=>$url
            ]);     
    }
    
    
    public function bookMarkQuestion(Request $request)
    {
        if($request->status == 2)
        {
            \App\Modules\Learn\Models\Bookmark::where('b_id', $request->question_id)
                ->where('type', '1')
                ->where('subject_id', $request->subject_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            echo 1;
            
        }else{
            
            \App\Modules\Learn\Models\Bookmark::where('b_id', $request->question_id)
                ->where('type', '1')
                ->where('subject_id', $request->subject_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            
            $obj = new \App\Modules\Learn\Models\Bookmark();
            $obj->type = '1';
            $obj->user_id = Auth::user()->id;
            $obj->b_id = $request->question_id;
            $obj->subject_id = $request->subject_id;
            $obj->save();
            
            echo 2;
        }
    }
    public function bookMarkConcept(Request $request)
    {
        /*if($request->status == 2)
        {
            \App\Modules\Learn\Models\Bookmark::where('b_id', $request->concept_id)
                ->where('type', '3')
                    ->where('subject_id', $request->subject_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            echo 1;
            
        }else{
            
            \App\Modules\Learn\Models\Bookmark::where('b_id', $request->concept_id)
                ->where('type', '3')
                    ->where('subject_id', $request->subject_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            
            $obj = new \App\Modules\Learn\Models\Bookmark();
            $obj->type = '3';
            $obj->user_id = Auth::user()->id;
            $obj->b_id = $request->concept_id;
            $obj->subject_id = $request->subject_id;
            $obj->save();
            
            echo 2;
        }*/
        $check_bookmark = \App\Modules\Learn\Models\Bookmark::where('b_id', $request->concept_id)
            ->where('type', '3')
            ->where('subject_id', $request->subject_id)
            ->where('user_id', Auth::user()->id)->first();
        if(isset($check_bookmark) && $check_bookmark->count() > 0)
        {
            $check_bookmark->delete();
            return 0;
        }
        else
        {
            $add_bookmark = new \App\Modules\Learn\Models\Bookmark();
            $add_bookmark->type = '3';
            $add_bookmark->user_id = Auth::user()->id;
            $add_bookmark->b_id = $request->concept_id;
            $add_bookmark->subject_id = $request->subject_id;
            $add_bookmark->save();
            return 1;
        }
    }
    
    public function bookMarkHome()
    {
    
        return view('Learn::bookmarks-home');
        
    }
    
    public function subjectBookmarks($subject_id)
    {
        $subjectData = \App\Modules\Subject\Models\Subject::find(base64_decode($subject_id));
        
        if($subjectData->name=='Biology')
        {
        $ak_all_test_questions_ids = \App\Modules\Learn\Models\Bookmark::where('user_id', Auth::user()->id)
                ->where('type', '1')
                ->where('subject_id', ['4','11'])->get()->pluck('b_id');
        }else{
        $ak_all_test_questions_ids = \App\Modules\Learn\Models\Bookmark::where('user_id', Auth::user()->id)
                ->where('type', '1')
                ->where('subject_id', base64_decode($subject_id))->get()->pluck('b_id');    
        }
        
                $ak_question_answers = QuestionsAnswersFilter::whereIn('id', $ak_all_test_questions_ids)
                ->orderBy('subject_id')->with('answer2')
                ->get();
                
                
                $concept_ids = \App\Modules\Learn\Models\Bookmark::where('user_id', Auth::user()->id)
                ->where('type', '3')
                ->where('subject_id', base64_decode($subject_id))->get()->pluck('b_id');
                $concepts = \App\Modules\Concept\Models\Concept::whereIn('id',$concept_ids)->get();
                
                
                $conceptType = \App\Modules\Concept\Models\ConceptType::all();
        return view('Learn::bookmarks-subject-wise-list', ['ak_question_answers'=>$ak_question_answers ,
            'conceptType'=>$conceptType, 
            'concepts'=>$concepts,
            'subjectData' => $subjectData
            ]);
        
    }
    
    public function resetTest($topic_id, $chapter_id, $subject_id){
        \App\Modules\Learn\Models\QuestionReport::where('topic_id', base64_decode($topic_id))
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->delete();
        
        return redirect(url("user/learn/$subject_id/topic/$chapter_id/test/$topic_id"));
    }
    public function configureClass(){
        $data = \App\Modules\Standard\Models\Standard::all(); 
        return view('Configure::class',['data'=>$data]);
    }
    
    public function saveConfigureClass($id){
        Session::put('class',$id);
        Session::save();
        return redirect(url('user/configure/stream'));       
    }
    public function configureBoard(){
        $data = \App\Modules\Board\Models\Board::all();   
        return view('Configure::board',['data'=>$data]);
    }
    public function saveConfigureBoard(Request $request)
    {
        
        
        if(Session::has('competitive_exam'))
        {    
            Session::put('board',$request->board);
            Session::save();
            return redirect(url('user/configure/exam')); 
        }else{
        \App\Modules\Configure\Models\UserCompetetiveExam::where('user_id',Auth::user()->id)->delete();    
        $configureSyllabusData = \App\Modules\Configure\Models\ConfigureSyllabus::where("user_id",Auth::user()->id)->first();
        
        if($configureSyllabusData)
        {
            $configureSyllabusData->class = Session::get('class');
            $configureSyllabusData->stream = 1;
            $configureSyllabusData->board = $request->board;
            $configureSyllabusData->user_id = Auth::user()->id;
            $configureSyllabusData->exam_flag = 0;
            $configureSyllabusData->save();    
        }else{
            $configureSyllabus = new \App\Modules\Configure\Models\ConfigureSyllabus();
            $configureSyllabus->class = Session::get('class');
            $configureSyllabus->stream = 1;
            $configureSyllabus->board = $request->board;
            $configureSyllabus->exam_flag = 0;
            $configureSyllabus->user_id = Auth::user()->id;
            $configureSyllabus->save();
        }
        Session::forget('class');
        Session::forget('stream');
        Session::forget('board');
        Session::forget('competitive_exam');
        Session::save();
        
        
        $user = User::find(Auth::user()->id);
        $user->syllabus_flag = 1;
        $user->save();
        
                
        return redirect('/dashboard');
        }
    }
    public function configureStream()
    {
        return view('Configure::stream');
    }
    
    public function saveConfigureStream($stream)
    {
        Session::put('stream',$stream);
        Session::save();
        return redirect(url('user/configure/prepare'));     
    }
    
    public function saveConfigurePrepare(Request $request)
    {
            Session::forget('competitive_exam');
            Session::forget('board_exam');
            Session::save();
        if ($request->has('board_exam')) {
            Session::put('board_exam', true);
            Session::save();
        }
        
        if ($request->has('competitive_exam')) {
            Session::put('competitive_exam', true);
            Session::save();
        }
        if(Session::has('board_exam'))
        {
            return redirect(url('user/configure/board'));     
        }else{
            return redirect(url('user/configure/exam'));     
        }
    }
    
    public function configurePrepare()
    {
        return view('Configure::prepare');
    }
    
    public function configureExam1()
    {
        return view('Configure::exam1');
    }
    public function configureExam()
    {
        $data = \App\Modules\Exam\Models\Exam::all();
        
        return view('Configure::exam2',['data'=>$data]);
    }
    
    public function saveConfigureExam(Request $request)
    {
        
        $configureSyllabusData = \App\Modules\Configure\Models\ConfigureSyllabus::where("user_id",Auth::user()->id)->first();
        
        if($configureSyllabusData)
        {
        $configureSyllabusData->class = Session::get('class');
        $configureSyllabusData->stream = 1;
        $configureSyllabusData->board = Session::get('board');
        $configureSyllabusData->user_id = Auth::user()->id;
        $configureSyllabusData->exam_flag = "1";
        $configureSyllabusData->save();
        
        
        \App\Modules\Configure\Models\UserCompetetiveExam::where('user_id',Auth::user()->id)->delete();
            foreach($request->exam as $exam)
            {   
            $userCompetetiveExam = new \App\Modules\Configure\Models\UserCompetetiveExam();
            $userCompetetiveExam->user_id = Auth::user()->id;
            $userCompetetiveExam->exams_id = $exam;
            $userCompetetiveExam->save();
            }
        }else{
        $configureSyllabus = new \App\Modules\Configure\Models\ConfigureSyllabus();
        $configureSyllabus->class = Session::get('class');
        $configureSyllabus->stream = 1;
        $configureSyllabus->board = Session::get('board');
        $configureSyllabus->exam_flag = "1";
        $configureSyllabus->user_id = Auth::user()->id;
        $configureSyllabus->save();
        
        foreach($request->exam as $exam)
        {   
        $userCompetetiveExam = new \App\Modules\Configure\Models\UserCompetetiveExam();
        $userCompetetiveExam->user_id = Auth::user()->id;
        $userCompetetiveExam->exams_id = $exam;
        $userCompetetiveExam->save();
        }
        
        }
        Session::forget('class');
        Session::forget('stream');
        Session::forget('board');
        Session::forget('competitive_exam');
        Session::save();
        
        
          $user = User::find(Auth::user()->id);
        $user->syllabus_flag = 1;
        $user->save();
        
                
//        dd(\App\Modules\Configure\Models\ConfigureSyllabus::where("user_id",Auth::user()->id)->first());
         return redirect('/dashboard');
    }
    
  
}
