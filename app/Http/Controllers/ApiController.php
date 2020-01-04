<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Modules\Learn\Models\QuestionReport;
use App\Modules\Chapter\Models\Chapter;
use App\Modules\Topic\Models\Topic;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
use App\Modules\QuestionAnswer\Models\QuestionsAnswersFilter;

class ApiController extends Controller
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
     * Authenticate user login.
     *
     * @return \Illuminate\Http\Response
     */


    public function setQuestionFlag()
    {
        $issues_data = \App\Modules\Learn\Models\Issue::all();
    }
    
    public function login(Request $request){

        $payLoad = json_decode(request()->getContent(), true);

        $credentials = [
            'mobile' => $payLoad['mobile_number'],
            'password' => $payLoad['password']
        ];

        if(Auth::attempt($credentials))
        {
            if(Auth::user()->user_status==0)
        {
            return ['success'=>'0',"error_message"=>"Your account is blocked. Please contact admin."];
        }else{
            return ['success'=>'1',"data"=>Auth::user()];
        }
            
        }
        return ['success'=>'0','error_message'=>"Invalid Login Credentials."];
    }



    public function getDashboardData(Request $request)
    {

        $payLoad =  json_decode(request()->getContent(), true);


        $user_id = $payLoad['user_id'];
        $subjectsData = User::find($user_id)->ConfigureSyllabus->standard->subjects;



        foreach($subjectsData as $subject)
        {
            if(strtolower($subject->name) == "biology")
            {
                $subject->progress =  QuestionReport::getApiSubjectReport(4, $user_id);
                $subject->topics = QuestionReport::getTotalVideoTopicsReport(4)['topics'];
            }else{
                $subject->progress =  QuestionReport::getApiSubjectReport($subject->id, $user_id);
                $subject->topics = QuestionReport::getTotalVideoTopicsReport($subject->id)['topics'];
            }
        }
        return ['success'=>'1',"data"=>$subjectsData->toArray()];

    }


    public function getSubjectChapters(Request $request)
    {
        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $subject_id = $payLoad['subject_id'];
        $subjectsData = User::find($user_id)->ConfigureSyllabus->standard->subjects;
        $userData = User::find($user_id);
        $subject_data = \App\Modules\Subject\Models\Subject::where('id', $subject_id)->first();
        if($userData->configureSyllabus->exam_flag == 1){
            $subject_data = \App\Modules\Subject\Models\Subject::where('id', $subject_id)->first();
            $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();
            if($subject_data->name=="Biology")
            {
                $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();
            }else{
                $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '0')->get();

            }
        }else{
            $subject_data = \App\Modules\Subject\Models\Subject::where('id', $subject_id)->first();
            $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();

            if($subject_data->name == "Biology" )
            {
                $arr_chapters = Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();
            }else{
                $arr_chapters = Chapter::where('subject_id',$subject_id)->where('board_id',2)->where('extra', '0')->get();
            }
        }

        foreach($arr_chapters as $chapter)
        {
            $chapter->count = count($chapter->questionCount);
            $chapter->progress = QuestionReport::getApiChapterReport($chapter->id,$user_id);
            unset($chapter->questionCount);
        }
        $arr_chapters = $arr_chapters->reject(function($obj){

            if($obj->count==0)
            {
                return true;
            }
            return false;
        });

        $arr_chapters = $arr_chapters->values();
        return ['success'=>'1',"data"=>$arr_chapters->toArray(),"subject_data"=>$subject_data];
    }


    public function test(Request $request){

        return json_encode(['test'=>'123']);
    }

    public function getSubjectChaptersTopic(Request $request){

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $subject_id = $payLoad['subject_id'];
        $chapter_id = $payLoad['chapter_id'];
//        $user_id = 5;
//        $subject_id = 8;
//        $chapter_id = 151;


$arr_exclude_topics_ids = [1000,1001,1002,1003,1004,1005,1006,1007,1008,1009,1010];
        $arr_topics = Topic::where('chapter_id',$chapter_id)->where('related_with','0')->whereNotIn('id', $arr_exclude_topics_ids)->get();




        $arr_topic_ids = $arr_topics->pluck('id');



        $total_chapters_questions = QuestionAnswer::whereIn('topic_id',$arr_topic_ids)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',$chapter_id)
            ->where('user_id', $user_id)
            ->count();

        $total_question_answered_time_taken = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',$chapter_id)
            ->where('user_id', $user_id)
            ->sum('time_taken');
        $time_taken['minutes'] = (int)($total_question_answered_time_taken/60);
        $time_taken['seconds'] = ($total_question_answered_time_taken%60);

        $total_question_correct_answer = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',$chapter_id)
            ->where('user_id', $user_id)
            ->where('is_correct', '1')
            ->count();
        
        $final_accuracy = 0;
        if($total_question_answered>0)
        {
            $final_accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
            $final_accuracy = 0;
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
            $overall_progress = round(($total_question_answered / $total_chapters_questions)*100,2);
        }else{
            $overall_progress = 0;
        }

        $chapter_data = Chapter::find($chapter_id);
        $arr=[];
        foreach($arr_topics as $topic)
        {
            $completed = QuestionReport::getApiTopicReport($topic->id, $user_id);
            $accuracy = QuestionReport::getApiAccuracyReport($topic->id, $user_id);
            $topic->progress = $completed;
            $topic->accuracy = $accuracy;
            $arr[] = $accuracy;
        }
        
        
        $result = ['arr_topics'=>$arr_topics,
            'chapter_data'=>$chapter_data,
            'subject_id'=>$subject_id,
            'chapter_id'=>$chapter_id,
            'total_question_answered'=>$total_question_answered,
            'accuracy'=>$final_accuracy,
            'overall_progress'=>$overall_progress,
            'time_taken'=>implode(':',$time_taken),
            'speed'=>($speed>200)?'200+':$speed
        ];
        return ['success'=>'1',"data"=>$result];
    }


    public function chapterTopicAssess(Request $request){
        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $subject_id = $payLoad['subject_id'];
        $chapter_id = $payLoad['chapter_id'];
        $topic_id = $payLoad['topic_id'];

        $arr_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
            ->where('user_id', $user_id)
            ->where('chapter_id',$chapter_id)
            ->pluck('question_id');




        $question_answer = QuestionsAnswersFilter::where('topic_id',$topic_id)
            ->whereNotIn('id', $arr_question_answered)
            ->skip(0)
            ->take(1)
            ->first();

        if($question_answer) {
            $question_answer->question = preg_replace('/\s\s+/', ' ', html_entity_decode($question_answer->question));
            $question_answer->reason = html_entity_decode($question_answer->reason);
            $question_answer->option_1 = html_entity_decode($question_answer->option_1);
            $question_answer->option_2 = html_entity_decode($question_answer->option_2);
            $question_answer->option_3 = html_entity_decode($question_answer->option_3);
            $question_answer->option_4 = html_entity_decode($question_answer->option_4);
        }

        $total_question= QuestionsAnswersFilter::where('topic_id',$topic_id)
            ->whereNotIn('id', $arr_question_answered)
            ->count();

        $chapter_data = Chapter::find($chapter_id);


        $result = [ 'chapter_data'=>$chapter_data, "question_answer"=>$question_answer, 'total_question'=>$total_question, 'chapter_id'=>$chapter_id];

        return ['success'=>'1',"data"=>$result];
    }


    public function getAnswer(Request $request){

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $question_id = $payLoad['question_id'];

        $result = \App\Modules\QuestionAnswer\Models\CorrectAnswer::where('question_answer_id',$question_id)
            ->first();
        return ['success'=>'1',"data"=>$result];

    }

    public function submitReport(Request $request)
    {

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $chapter_id = $payLoad['chapter_id'];
        $topic_id = $payLoad['topic_id'];
        $question_id = $payLoad['question_id'];
        $is_correct_ans = $payLoad['is_correct_ans'];
        $time_taken = $payLoad['time_taken'];
        $obj = new \App\Modules\Learn\Models\QuestionReport();
        $obj->topic_id = $topic_id;
        $obj->question_id = $question_id;
        $obj->is_correct = $is_correct_ans;
        $obj->user_id = $user_id;
        $obj->chapter_id = $chapter_id;
        $obj->time_taken = $time_taken;
        $obj->save();

        return json_encode(['result'=>1]);
    }

    public function getReport(Request $request){
        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $chapter_id = $payLoad['chapter_id'];
        $topic_id = $payLoad['topic_id'];

        $total_topic_questions = QuestionAnswer::where('topic_id',$topic_id)->count();

        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
            ->where('user_id', $user_id)
            ->count();

        $total_question_answered_time_taken = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
            ->where('user_id', $user_id)
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
            ->where('user_id', $user_id)
            ->where('is_correct', '1')
            ->count();

        $total_question_skipped_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
            ->where('user_id', $user_id)
            ->where('is_correct', '2')
            ->count();


        $total_question_wrong_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
            ->where('user_id', $user_id)
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
        $chapter_data = Chapter::find($chapter_id);
        $result =  [
            'chapter_data'=>$chapter_data,
            'chapter_id'=>$chapter_id,
            'total_question_answered'=>$total_question_answered,
            'total_question_correct_answer'=>$total_question_correct_answer,
            'total_question_skipped_answer'=>$total_question_skipped_answer,
            'total_question_wrong_answer'=>$total_question_wrong_answer,
            'accuracy'=>$accuracy,
            'overall_progress'=>$overall_progress,
            'time_taken'=>implode(':',$time_taken),
            'speed'=>$speed
        ];
        return ['success'=>'1',"data"=>$result];


    }

    public function resetTest(Request $request){

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $topic_id = $payLoad['topic_id'];
        \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
            ->where('user_id', $user_id)
            ->delete();
        return ['success'=>'1'];

    }

    public function getConcepet(Request $request){



        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $chapter_id = $payLoad['chapter_id'];
        $concepts = \App\Modules\Concept\Models\Concept::where('chapter_id',$chapter_id)->get();

        foreach($concepts as $concept)
        {
            $concept->concept = html_entity_decode($concept->concept);
        }




        $url = url('public/media/concept/');
        return ['success'=>'1','url'=>$url, "data"=>$concepts];

    }


    public function getChapterDifficultyQuestions(Request $request)
    {
        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $chapter_id = $payLoad['chapter_id'];
        $lev = $payLoad['level'];
        $question_answer = \App\Modules\QuestionAnswerSet\Models\TopTenQuestion::where('chapter_id', $chapter_id)->where('level',$lev)->with('question')->get();



        return ['success'=>'1', "data" => $question_answer];
    }

    public function allTests(){
        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];

        $user = User::find($user_id);

        if($user->configureSyllabus->exam_flag == 0)
        {
            $all_exam = \App\Modules\Exam\Models\Exam::all();
            foreach ($all_exam as $exam) {
                $exam->total_test = count($exam->getAllTest);
            }
        }else{
            $all_exam = null;
        }

        $userExams = \App\Modules\Configure\Models\UserCompetetiveExam::where('user_id', $user_id)->get();

        foreach($userExams as $exam)
        {
            $exam->total_test = count($exam->exam->getAllTest);
        }

        $exams = \App\Modules\Exam\Models\Exam::orderBy('id','desc')->get();
        return ['success'=>'1', 'all_exam'=>$all_exam, 'userExams'=>$userExams];

    }


    public function newExamTests(Request $request){

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $exam_id = $payLoad['exam_id'];
        $exams = \App\Modules\Exam\Models\Exam::find($exam_id);
        $testSeries = \App\Modules\Exam\Models\TestSeries::where('exam_id', $exam_id)->orderBy('start_date')->get();
        $attempted_test_ids = \App\Modules\Test\Models\UserAttemptedTest::where('user_id', $user_id)->get()->pluck('test_id');
        $date = date('Y-m-d');

        $upcomingTestSeries = \App\Modules\Exam\Models\TestSeries::where('start_date','>' ,$date)
            ->where('exam_id', $exam_id)
            ->whereNotIn('id', $attempted_test_ids)
            ->orderBy('start_date')
            ->get();

        $todaysTestSeries = \App\Modules\Exam\Models\TestSeries::where('start_date','<=' ,$date)
            ->where('end_date','>=' ,$date)
            ->whereNotIn('id', $attempted_test_ids)
            ->where('exam_id', $exam_id)
            ->orderBy('start_date')
            ->get();

        return ['exams' => $exams,
            'upcomingTestSeries' => $upcomingTestSeries,
            'todaysTestSeries' => $todaysTestSeries
        ];
    }
    
    public function getTestSyllabus(){
        $payLoad =  json_decode(request()->getContent(), true);
        $test_id = $payLoad['test_id'];
        
        $test = \App\Modules\Exam\Models\TestSeries::find($test_id);
        $chapter_id_arr = [];
        $syllabusData = [];
        foreach($test->testSeriesSubject as $testSubject)
        {           
            foreach($test->testSeriesChapter as $testChapter)
            {
                if ($testChapter->chapter->subject_id == $testSubject->subject_id)
                {
                    if(!in_array($testChapter->chapter->id, $chapter_id_arr))
                    {
                        $syllabusData[$testSubject->subject->name][] = $testChapter->chapter->name;
                        $chapter_id_arr[] = $testChapter->chapter->id;
                    }
                }
            }
        }
        
        
           return ['syllabus' => $syllabusData];
    }

    public function attemptedExamTests(Request $request){

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $exam_id = $payLoad['exam_id'];
        $exams = \App\Modules\Exam\Models\Exam::find($exam_id);
        $testSeries = \App\Modules\Exam\Models\TestSeries::where('exam_id', $exam_id)->orderBy('start_date')->get();
        $attempted_test_ids = \App\Modules\Test\Models\UserAttemptedTest::where('user_id', $user_id)->get()->pluck('test_id');
        $date = date('Y-m-d');

        $attemptedTestSeries = \App\Modules\Exam\Models\TestSeries::whereIn('id', $attempted_test_ids)
            ->where('exam_id', $exam_id)
            ->orderBy('start_date')
            ->get();
        return ['exams' => $exams, 'attemptedTestSeries' => $attemptedTestSeries];
    }

    public function missedExamTests(Request $request){

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $exam_id = $payLoad['exam_id'];
        $exams = \App\Modules\Exam\Models\Exam::find($exam_id);
        $testSeries = \App\Modules\Exam\Models\TestSeries::where('exam_id', $exam_id)->orderBy('start_date')->get();
        $attempted_test_ids = \App\Modules\Test\Models\UserAttemptedTest::where('user_id', $user_id)->get()->pluck('test_id');
        $date = date('Y-m-d');

        $missedTestSeries = \App\Modules\Exam\Models\TestSeries::where('end_date','<' ,$date)
            ->whereNotIn('id', $attempted_test_ids)
            ->where('exam_id', $exam_id)
            ->orderBy('start_date')
            ->get();



        return ['exams' => $exams,
            'missedTestSeries' => $missedTestSeries,
        ];
    }


    public function attempTest(){

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
//        $test_id = $payLoad['test_id'];
        $test_id = $payLoad['test_id'];
        $testData = \App\Modules\Exam\Models\TestSeries::find($test_id);


        $objUserAttemptedTest = \App\Modules\Test\Models\UserAttemptedTest::where('test_id',$test_id)
            ->where('user_id',$user_id)
            ->first();
//        if($objUserAttemptedTest)
//        {
//            echo "You have already attempted this test. Now you will not be able to attempt this test.";
//            die;
//        }
        $objUserAttemptedTest = new \App\Modules\Test\Models\UserAttemptedTest();
        $objUserAttemptedTest->user_id = $user_id;
        $objUserAttemptedTest->test_id = $test_id;
        $objUserAttemptedTest->save();

        $all_test_questions_ids = \App\Modules\Exam\Models\TestSeriesQuestion::where('test_series_id',$test_id)
            ->get()
            ->pluck('question_id');


        $all_test_subject_ids = \App\Modules\Exam\Models\TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');

        $all_test_questions_ids = \App\Modules\Exam\Models\TestSeriesQuestion::where('test_series_id',$test_id)
            ->get()
            ->pluck('question_id');




        $question_answer = QuestionAnswer::whereIn('id', $all_test_questions_ids)
            ->with('subject')
            ->orderBy('subject_id')
            ->get();


        $subject_wise_question_answer = [];
        foreach($question_answer as $qa)
        {
            $subject_wise_question_answer[$qa->subject->name][] = $qa;
        }



//        dd($question_answer[0]->subject);

        $total_question = count($question_answer);

        $arr_topics = [];
        $chapter_data = [];



        // new code

        $qa_data = [];
        $used_subject_ids = [];

        foreach($question_answer as  $index=>$qa)
        {
            foreach($all_test_subject_ids as  $objSubjectId)
            {
                $qa_data[$qa->subject->name][] =  $qa;
            }

        }
        //end code


        return ['arr_topics'=>$arr_topics,
            'chapter_data'=>$chapter_data,
            "question_answer"=>$question_answer,
            'total_question'=>$total_question,
            'testData' => $testData,
            'all_test_subject_ids' => $all_test_subject_ids,
            'qa_data'=>$qa_data,
            'subject_wise_question_answer'=>$subject_wise_question_answer
        ];


    }

    public function submitTestAnswer(Request $request)
    {

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $test_id = $payLoad['test_id'];
        $questionId = $payLoad['questionId'];
        $selectedOption = $payLoad['selectedOption'];


        $updateData = \App\Modules\Test\Models\TestSubmittedAnswer::where('test_id',$test_id)
            ->where('question_id', $questionId)
            ->where('user_id', $user_id)
            ->first();

        if($updateData)
        {
            $updateData->selected_answer = $selectedOption;
            $updateData->save();
        }else{
            $obj = new \App\Modules\Test\Models\TestSubmittedAnswer();
            $obj->test_id = $test_id;
            $obj->question_id = $questionId;
            $obj->selected_answer = $selectedOption;
            $obj->user_id = $user_id;
            $obj->save();
        }


        return json_encode(['result'=>1]);
    }

    public function getTestReport()
    {

        $payLoad =  json_decode(request()->getContent(), true);
        $user_id = $payLoad['user_id'];
        $test_id = $payLoad['test_id'];


        $testData = \App\Modules\Exam\Models\TestSeries::find($test_id);


        $score = 0;
        $correct_answer_mark = $testData->positive_mark;
        $wrong_answer_mark = $testData->negative_mark;
        $all_test_questions_ids = \App\Modules\Exam\Models\TestSeriesQuestion::where('test_series_id',$test_id)
            ->get()
            ->pluck('question_id');

        $all_test_subject_ids = \App\Modules\Exam\Models\TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');
        $all_test_subjects = \App\Modules\Exam\Models\TestSeriesSubject::where('test_series_id',$test_id)->get();



        $all_test_questions_ids = \App\Modules\Exam\Models\TestSeriesQuestion::where('test_series_id',$test_id)
            ->get()
            ->pluck('question_id');

        $question_answer = QuestionAnswer::whereIn('id', $all_test_questions_ids)
            ->orderBy('subject_id')
            ->get();


        //distribution
        $subject_questions = [];
        $subject_correct_answers = [];
        $subject_wrong_answers = [];
        $subject_questions_ids2 = [];
        foreach ($question_answer as $index => $qa) {
            foreach ($all_test_subject_ids as $objSubjectId) {
                if ($objSubjectId == $qa->subject_id) {
                    $subject_questions[$qa->subject->name][] = $qa->id;
                    $subject_correct_answers[$qa->subject->name]=0;
                    $subject_wrong_answers[$qa->subject->name]=0;
                    $subject_questions_ids2[$qa->subject->id]['questions'][] = $qa->id;
                    $subject_questions_ids2[$qa->subject->id]['subject']= $qa->subject->name;
                }
            }
        }

        $total_question = count($question_answer);

        $submittedAnswer = \App\Modules\Test\Models\TestSubmittedAnswer::where('test_id',$test_id)
            ->where('user_id', $user_id)
            ->get();

        $subject_marks = [];

        $total_subject_correct_answer = 0;
        $total_subject_wrong_answer = 0;
        foreach($subject_questions_ids2 as $sqi2Key => $sqi2Obj)
        {
            $subjectScore = 0;
            $subjectSubmittedAnswer = $submittedAnswer->whereIn('question_id', $sqi2Obj['questions']);
            foreach($subjectSubmittedAnswer as $objSubSubmittedAnswer)
            {


                if($objSubSubmittedAnswer->selected_answer == $objSubSubmittedAnswer->getQuestionAnswer->answer)
                {
                    $subjectScore += $correct_answer_mark;
                    $total_subject_correct_answer++;
                }else{
                    $subjectScore-=$wrong_answer_mark;
                    $total_subject_wrong_answer++;
                }
                $subName = $objSubSubmittedAnswer->getQuestionAnswer->question->subject->name;

                if($objSubSubmittedAnswer->selected_answer == $objSubSubmittedAnswer->getQuestionAnswer->answer)
                {
                    $subject_correct_answers[$subName]+= 1;
                }else{
                    $subject_wrong_answers[$subName]+= 1;

                }
            }
            $subject_marks[$subject_questions_ids2[$sqi2Key]['subject']] = $subjectScore;
        }


//        dd($subject_correct_answers, $subject_wrong_answers);
        //end distribution

        $total_question_correct_answer = 0;

        foreach($submittedAnswer as $objSubmittedAnswer)
        {
            if($objSubmittedAnswer->selected_answer == $objSubmittedAnswer->getQuestionAnswer->answer)
            {
                $score += $correct_answer_mark;
                $total_question_correct_answer++;
            }else{
                $score-=$wrong_answer_mark;
            }
        }




        $total_question_attempted = count($submittedAnswer);
        $total_question_unattempted = $total_question - count($submittedAnswer);

        $total_question_answered = count($submittedAnswer);

        if($total_question_answered>0)
        {
            $accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
            $accuracy = 0;
        }
        // answer key

        $ak_all_test_questions_ids = \App\Modules\Exam\Models\TestSeriesQuestion::where('test_series_id',$test_id)
            ->get()
            ->pluck('question_id');

        $ak_all_test_subject_ids = \App\Modules\Exam\Models\TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');

        $ak_all_test_questions_ids = \App\Modules\Exam\Models\TestSeriesQuestion::where('test_series_id',$test_id)
            ->get()
            ->pluck('question_id');

        $ak_question_answers = QuestionAnswer::whereIn('id', $ak_all_test_questions_ids)
            ->orderBy('subject_id')->with('answer2')
            ->get();

        //end answer key
        return [
            'total_question_attempted'=>$total_question_attempted,
            'total_question_unattempted'=>$total_question_unattempted,
            'subject_correct_answers'=>$subject_correct_answers,
            'subject_wrong_answers'=>$subject_wrong_answers,
            'total_subject_wrong_answer'=>$total_subject_wrong_answer,
            'total_subject_correct_answer'=>$total_subject_correct_answer,
            'score'=>$score,
            'total_question'=>$total_question,
            'accuracy' => $accuracy,
            'subject_questions' => $subject_questions,
            'subject_marks' => $subject_marks,
            'testData'=> $testData,
            'ak_question_answers' => $ak_question_answers,
            'submittedAnswer' => $submittedAnswer
        ];
    }

    public function examTests($exam_id){
        $exams = \App\Modules\Exam\Models\Exam::find(base64_decode($exam_id));
        $testSeries = \App\Modules\Exam\Models\TestSeries::where('exam_id', base64_decode($exam_id))->orderBy('start_date')->get();
        $attempted_test_ids = \App\Modules\Test\Models\UserAttemptedTest::where('user_id', Auth::user()->id)->get()->pluck('test_id');
        $date = date('Y-m-d');

        $upcomingTestSeries = \App\Modules\Exam\Models\TestSeries::where('start_date','>' ,$date)
            ->where('exam_id', base64_decode($exam_id))
            ->whereNotIn('id', $attempted_test_ids)
            ->orderBy('start_date')
            ->get();
        $todaysTestSeries = \App\Modules\Exam\Models\TestSeries::where('start_date','<=' ,$date)
            ->where('end_date','>=' ,$date)
            ->whereNotIn('id', $attempted_test_ids)
            ->where('exam_id', base64_decode($exam_id))
            ->orderBy('start_date')
            ->get();


        $missedTestSeries = \App\Modules\Exam\Models\TestSeries::where('end_date','<' ,$date)
            ->whereNotIn('id', $attempted_test_ids)
            ->where('exam_id', base64_decode($exam_id))
            ->orderBy('start_date')
            ->get();

        $attemptedTestSeries = \App\Modules\Exam\Models\TestSeries::whereIn('id', $attempted_test_ids)
            ->where('exam_id', base64_decode($exam_id))
            ->orderBy('start_date')
            ->get();

        return view('Test::exam-tests',['exams' => $exams,
            'upcomingTestSeries' => $upcomingTestSeries,
            'todaysTestSeries' => $todaysTestSeries,
            'missedTestSeries' => $missedTestSeries,
            'attemptedTestSeries' => $attemptedTestSeries,
        ]);
    }
}

