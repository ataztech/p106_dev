<?php
namespace App\Modules\Test\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
use App\Modules\Exam\Models\TestSeriesQuestion;
use App\Modules\Exam\Models\TestSeries;
use App\Modules\Exam\Models\TestSeriesSubject;
use App\Modules\Test\Models\TestSubmittedAnswer;
class TestController extends Controller
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

    public function tests(){
        
        return view('Test::tests');
    }
    
    public function AllTests(){
        
        if(Auth::user()->configureSyllabus->exam_flag == 0)
        {
            $all_exam = \App\Modules\Exam\Models\Exam::all();
        
        }else{
            $all_exam = null;
        }
            
   
        $userExams = \App\Modules\Configure\Models\UserCompetetiveExam::where('user_id', Auth::user()->id)->get();
        $exams = \App\Modules\Exam\Models\Exam::orderBy('id','desc')->get();
        return view('Test::all-tests',['all_exam'=>$all_exam, 'exams'=>$exams, 'userExams'=>$userExams]);
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
    
    
    public function attempTest($test_id){
        
        $test_id = base64_decode($test_id);
        $testData = TestSeries::find($test_id);        

        
        
        $objUserAttemptedTest = \App\Modules\Test\Models\UserAttemptedTest::where('test_id',$test_id)
                ->where('user_id',Auth::user()->id)
                ->first();
        if($objUserAttemptedTest)
        {
            echo "You have already attempted this test. Now you will not be able to attempt this test.";
            die;
        }
        $objUserAttemptedTest = new \App\Modules\Test\Models\UserAttemptedTest();
        $objUserAttemptedTest->user_id = Auth::user()->id;
        $objUserAttemptedTest->test_id = $test_id;
        $objUserAttemptedTest->save();
        
        
        
        
        
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $all_test_subject_ids = TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $question_answer = QuestionAnswer::whereIn('id', $all_test_questions_ids)
                ->orderBy('subject_id')
                ->get();
        
        
        $total_question= count($question_answer);
        
        $arr_topics = [];
        $chapter_data = [];
        
        
        
        return view('Test::attempt-exam-test',['arr_topics'=>$arr_topics, 
            'chapter_data'=>$chapter_data, 
            "question_answer"=>$question_answer, 
            'total_question'=>$total_question,
            'testData' => $testData,
            'all_test_subject_ids' => $all_test_subject_ids
            ]);
    }
    
    public function nextQuestion(Request $request){

        $test_id = $request->test_id;
        $index = $request->index;
        $testData = TestSeries::find($test_id);        
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $all_test_subject_ids = TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $question_answer = QuestionAnswer::whereIn('id', $all_test_questions_ids)
                ->orderBy('subject_id')
                ->get();
        
        
        $total_question = count($question_answer);
        
        $arr_topics = [];
        $chapter_data = [];
        
        
        $selectedAnswer = TestSubmittedAnswer::where('test_id',$request->test_id)
                ->where('question_id', $question_answer{$index}->id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->first();
        
                
        
        return view('Test::ajax-attempt-exam-test',['arr_topics'=>$arr_topics, 
            'chapter_data'=>$chapter_data, 
            "question_answer"=>$question_answer, 
            'total_question'=>$total_question,
            'testData' => $testData,
            'all_test_subject_ids' => $all_test_subject_ids,
            'index'=>$index,
            'selectedAnswer'=>$selectedAnswer
            ]);
    }
    
    public function submitTestAnswer(Request $request)
    {
        
        $updateData = TestSubmittedAnswer::where('test_id',$request->test_id)
                ->where('question_id', $request->questionId)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->first();
        
        if($updateData)
        {
        $updateData->selected_answer = $request->selectedOption;
        $updateData->save();    
        }else{
        $obj = new TestSubmittedAnswer();
        $obj->test_id = $request->test_id;
        $obj->question_id = $request->questionId;
        $obj->selected_answer = $request->selectedOption;
        $obj->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $obj->save();
        }
        return json_encode(['result'=>1]);
    }
    
    public function ajaxGetTestReport(Request $request)
    {
        
        
        $test_id = $request->test_id;
        $testData = TestSeries::find($test_id);        
        
        
        
        
        
        
        
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $all_test_subject_ids = TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $question_answer = QuestionAnswer::whereIn('id', $all_test_questions_ids)
                ->orderBy('subject_id')
                ->get();
        
        
        $total_question = count($question_answer);
        
        
        $submittedAnswer = TestSubmittedAnswer::where('test_id',$request->test_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->get();
        $total_question_attempted = count($submittedAnswer);
        $total_question_unattempted = $total_question - count($submittedAnswer);
        
        
        
        return view('Test::ajax-test-report',[
            'total_question_attempted'=>$total_question_attempted,
            'total_question_unattempted'=>$total_question_unattempted,
            ]);
    }
   /* public function getTestReport($test_id)
    {
        
        
        $test_id = base64_decode($test_id);
        $testData = TestSeries::find($test_id);        
        
        
        $score = 0;
        $correct_answer_mark = $testData->positive_mark;
        $wrong_answer_mark = $testData->negative_mark;
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $all_test_subject_ids = TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');
        $all_test_subjects = TestSeriesSubject::where('test_series_id',$test_id)->get();
        
        
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
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
        
        
        $submittedAnswer = TestSubmittedAnswer::where('test_id',$test_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
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
        
        $ak_all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $ak_all_test_subject_ids = TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');
        
        $ak_all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $ak_question_answers = QuestionAnswer::whereIn('id', $ak_all_test_questions_ids)
                ->orderBy('subject_id')->with('answer2')
                ->get();
        
        
        
        
        //end answer key
        return view('Test::test-report',[
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
            ]);
    }*/
    
    public function getTestReport($test_id)
    {
        $test_id = base64_decode($test_id);
        $testData = TestSeries::find($test_id); // Here getting testseries record using test_id
        $score = 0; // Initializing score to zero
        $correct_answer_mark = $testData->positive_mark; // Here getting positive marks from testseries
        $wrong_answer_mark = $testData->negative_mark; // Here getting negative marks from testseries
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id', $test_id)
            ->get()
            ->pluck('question_id'); // Here getting question_ids of all questions in the testseries

        $all_test_subject_ids = TestSeriesSubject::where('test_series_id', $test_id)->get()->pluck('subject_id'); // Here getting subject_ids of testseries

        $all_test_subjects = TestSeriesSubject::where('test_series_id', $test_id)->get(); // Here getting subject record of testseries


        /*$all_test_questions_ids = TestSeriesQuestion::where('test_series_id', $test_id)
            ->get()
            ->pluck('question_id');*/

        $question_answer = QuestionAnswer::whereIn('id', $all_test_questions_ids)
            ->orderBy('subject_id')
            ->get(); // Here getting answer of all question available in testseries

        //distribution
        $subject_questions = [];
        $subject_correct_answers = [];
        $subject_wrong_answers = [];
        $subject_questions_ids2 = [];
        foreach ($question_answer as $index => $qa) {
            // looping answer of question
            foreach ($all_test_subject_ids as $objSubjectId) {
                // looping subject_id
                if ($objSubjectId == $qa->subject_id) {
                    $subject_questions[$qa->subject->name][] = $qa->id;
                    $subject_correct_answers[$qa->subject->name] = 0;
                    $subject_wrong_answers[$qa->subject->name] = 0;
                    $subject_questions_ids2[$qa->subject->id]['questions'][] = $qa->id;
                    $subject_questions_ids2[$qa->subject->id]['subject'] = $qa->subject->name;
                }
            }
        }
        $total_question = count($question_answer); // Getting count of answer

        $submittedAnswer = TestSubmittedAnswer::where('test_id', $test_id)
            ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
            ->get(); // getting all submitted answer by user in testseries

        $subject_marks = [];
        $total_subject_correct_answer = 0;  // Initilizing total_subject_correct_answer to zero
        $total_subject_wrong_answer = 0; // Initilizing total_subject_wrong_answer to zero
        $total_subject_correct_answer_other = 0; // Initilizing total_subject_correct_answer_other to zero specially for MSC ET
        foreach ($subject_questions_ids2 as $sqi2Key => $sqi2Obj) {
            $subjectScore = 0;
            $subjectSubmittedAnswer = $submittedAnswer->whereIn('question_id', $sqi2Obj['questions']);
            /*$total_subject_correct_answer_other = 1;*/
            foreach ($subjectSubmittedAnswer as $objSubSubmittedAnswer) {
                // Specially for MHCET Test
                $subject_id = $objSubSubmittedAnswer->getQuestionAnswer->question->subject->id; // getting subject id of selected answer by user
                $get_positive_marking = TestSeriesSubject::where('test_series_id', $test_id)->where('subject_id', $subject_id)->first(); // getting positive_mark of selected answer by user
                // End
                if ($objSubSubmittedAnswer->selected_answer == $objSubSubmittedAnswer->getQuestionAnswer->answer)  // Checking whether answer selected by user is matching from the original correct answer
                {
                    // If the selected answer is right it goes here
                    if ($correct_answer_mark > 0) // checking whethere the test is MSCET test or other
                    {
                        // It goes here if test is not MSCET
                        $subjectScore += $correct_answer_mark;
                        $total_subject_correct_answer++;

                    }
                    else
                    {
                        $subjectScore += $get_positive_marking->positive_mark;
                        $total_subject_correct_answer_other++;
                    }
                }
                else
                {
                    // If selected answer is wrong then it goes here
                    if ($wrong_answer_mark > 0) {
                        $subjectScore -= $wrong_answer_mark;
                        $total_subject_wrong_answer++;
                    } else {
                        $subjectScore -= $get_positive_marking->negative_mark;
                        $total_subject_wrong_answer++;
                    }

                }
                $subName = $objSubSubmittedAnswer->getQuestionAnswer->question->subject->name;

                if ($objSubSubmittedAnswer->selected_answer == $objSubSubmittedAnswer->getQuestionAnswer->answer) {
                    $subject_correct_answers[$subName] += 1;
                } else {
                    $subject_wrong_answers[$subName] += 1;

                }
            }
            $subject_marks[$subject_questions_ids2[$sqi2Key]['subject']] = $subjectScore;
        }
//end distribution

        $total_question_correct_answer = 0;
        $total_question_correct_answer_other = 0;
        foreach ($submittedAnswer as $objSubmittedAnswer) {
            // Specially for MHCET Test
            $subject_id = $objSubmittedAnswer->getQuestionAnswer->question->subject->id;
            $get_positive_marking = TestSeriesSubject::where('test_series_id', $test_id)->where('subject_id', $subject_id)->first();
            // End
            if ($objSubmittedAnswer->selected_answer == $objSubmittedAnswer->getQuestionAnswer->answer)
            {
                if ($correct_answer_mark > 0)
                {
                    $score += $correct_answer_mark;
                    $total_question_correct_answer++;
                }
                else
                {
                    $score += $get_positive_marking->positive_mark;
                    $total_question_correct_answer_other++;
                }
            }
            else
            {
                if ($wrong_answer_mark > 0)
                {
                    $score -= $wrong_answer_mark;
                }
                else
                {
                    $score -= $get_positive_marking->negative_mark;
                }
            }

        }
        $total_question_attempted = count($submittedAnswer);
        $total_question_unattempted = $total_question - count($submittedAnswer);
        $total_question_answered = count($submittedAnswer);
        if ($total_question_answered > 0)
        {
            if($correct_answer_mark > 0)
            {
                $accuracy = round(($total_question_correct_answer / $total_question_answered) * 100, 2);
            }
            else
            {
                $accuracy = round(($total_question_correct_answer_other / $total_question_answered) * 100, 2);
            }
        }
        else
        {
            $accuracy = 0;
        }

        // answer key

        $ak_all_test_questions_ids = TestSeriesQuestion::where('test_series_id', $test_id)
            ->get()
            ->pluck('question_id');

        $ak_all_test_subject_ids = TestSeriesSubject::where('test_series_id', $test_id)->get()->pluck('subject_id');

        $ak_all_test_questions_ids = TestSeriesQuestion::where('test_series_id', $test_id)
            ->get()
            ->pluck('question_id');

        $ak_question_answers = QuestionAnswer::whereIn('id', $ak_all_test_questions_ids)
            ->orderBy('subject_id')->with('answer2')
            ->get();



        //end answer key
        //dd($score);
        return view('Test::test-report', [
            'total_question_attempted' => $total_question_attempted,
            'total_question_unattempted' => $total_question_unattempted,
            'subject_correct_answers' => $subject_correct_answers,
            'subject_wrong_answers' => $subject_wrong_answers,
            'total_subject_wrong_answer' => $total_subject_wrong_answer,
            'total_subject_correct_answer' => $total_subject_correct_answer,
            'score' => $score,
            'total_question' => $total_question,
            'accuracy' => $accuracy,
            'subject_questions' => $subject_questions,
            'subject_marks' => $subject_marks,
            'testData' => $testData,
            'ak_question_answers' => $ak_question_answers,
            'submittedAnswer' => $submittedAnswer,
            'total_subject_correct_answer_other' => $total_subject_correct_answer_other
        ]);
    }
    
  
}
