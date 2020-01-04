<?php

namespace App\Modules\Exam\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Chapter\Models\Chapter;
use App\Modules\Exam\Models\Exam;
use App\Modules\Exam\Models\TestSeries;
use App\Modules\Exam\Models\TestSeriesQuestion;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
use App\Modules\Standard\Models\Standard;
use App\Modules\Subject\Models\Subject;
use App\Modules\Topic\Models\Topic;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;
use App\Helper\fileUploadHelper;

class ExamController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listExam()
    {
        return view('Exam::list');
    }

    public function data()
    {
        $exams = Exam::orderBy('id','desc')->get();

        return Datatables::of($exams)
//            ->addColumn('total_bill', function($report) {
//                return $report->total_price + $report->total_discount;
//            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Exam::create');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required',
                'exam_full_form' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $exam =  new Exam();
            $exam->name=$request->name;
            $exam->exam_full_form=$request->exam_full_form;

            if ($request->hasFile('image')) {

                $image = fileUploadHelper::fileUpload(['file_type'=>'image','html_input_name'=>'image','file'=>$request->image,
                    'destination'=>'/storage/app/public/exam','resize'=>['resize'=>true,'height'=>100,'width'=>100,'resize_destination'=>'/storage/app/public/exam/thumb']]);

                if(isset($image['error_code']) && $image['error_code'])
                {
                    dd($image);
                }
                else
                {
                    $exam->link = '/storage/app/public/exam/';
                    $exam->image = $image[0];
                }
            }

            $exam->save();
            return redirect('admin/exam/list')->with('success','Exam Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $exam = Exam::find($id);
        if($request->method()=="GET")
        {
            return view('Exam::update',['exam'=>$exam]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'exam_full_form' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $exam->name=$request->name;
            $exam->exam_full_form=$request->exam_full_form;

            if ($request->hasFile('image')) {
                $image = fileUploadHelper::fileUpload(['file_type'=>'image','html_input_name'=>'image','file'=>$request->image,
                    'destination'=>'/storage/app/public/exam','resize'=>['resize'=>true,'height'=>100,'width'=>100,'resize_destination'=>'/storage/app/public/exam/thumb']]);

                if(isset($image['error_code']) && $image['error_code'])
                {
                    dd($image);
                }
                else
                {
                    $exam->link = '/storage/app/public/exam/';
                    $exam->image = $image[0];
                }
            }

            $exam->save();
            return redirect('admin/exam/list')->with('success','Exam Updated Successfully!');
        }
    }

    public function delete($id)
    {
        
        $testData = TestSeries::find((int)$id);
        $testData->delete();
        return redirect('admin/exam/list')->with('success','Exam Delete Successfully!');
    }

    public function setTest($exam_id)
    {
        $exam = Exam::find($exam_id);
        return view('Exam::test-list',array('exam'=>$exam));
    }

    public function getTest($exam_id)
    {
        $all_test = TestSeries::where('exam_id',$exam_id)->orderBy('id','desc')->get();

        return Datatables::of($all_test)
            ->addColumn('exam_date', function($test) {
                return '<label class="label label-info">'.$test->start_date.'</label>';
            })
            ->addColumn('duration', function($test) {
                return '<label class="label label-primary">'.$test->hour.'hour : '.$test->min.'min</label>';
            })
            ->addColumn('positive_mark', function($test) {
                return $test->positive_mark;
            })
            ->rawColumns(['duration','exam_date'])
            ->make(true);
    }

    public function createTest(Request $request,$exam_id)
    {

        $exam = Exam::find($exam_id);
        $exam_slug = $exam->slug;
        if($request->method()=="GET")
        {
            $standards = Standard::all();
            return view('Exam::create-test',array('exam'=>$exam,'standards'=>$standards,'exam_slug' => $exam_slug));
        }
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                "total_question" => "required",
                "mark" => "required",
                "hours" => "required",
                "minute" => "required",
                //"positive_mark" => "required",
                //"negative_mark" => "required",
                "date" => "required",
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $test_series = new TestSeries();
            $test_series->exam_id = $exam_id;
            $test_series->name = $request->name;
            $test_series->exam_type = $request->exam_type;
            $test_series->total_question = $request->total_question;
            $test_series->mark = $request->mark;
            $test_series->hour = $request->hours;
            $test_series->min = $request->minute;
            if(isset($request->positive_mark) && isset($request->negative_mark))
            {
                $test_series->positive_mark = $request->positive_mark;
                $test_series->negative_mark = $request->negative_mark;
            }
            $test_series->start_date = $request->date;
            $test_series->end_date = $request->end_date;
            $test_series->target_year = $request->target_year;
            $test_series->save();
            foreach ($request->subject as $key => $subject_id)
            {
                $testSeriesSubjectObj =  new \App\Modules\Exam\Models\TestSeriesSubject();
                $testSeriesSubjectObj->subject_id = $subject_id;
                $testSeriesSubjectObj->test_series_id = $test_series->id;
                if(isset($request->positive_mark_arr) && isset($request->negative_mark_arr))
                {
                    $testSeriesSubjectObj->positive_mark = $request->positive_mark_arr[$subject_id][0];
                    $testSeriesSubjectObj->negative_mark = $request->negative_mark_arr[$subject_id][0];
                }
                $testSeriesSubjectObj->save();
            }
            
            foreach ($request->chapter as  $chapter_id)
            {
                $testSeriesChapterObj =  new \App\Modules\Exam\Models\TestSeriesChapter();
                $testSeriesChapterObj->chapter_id = $chapter_id;
                $testSeriesChapterObj->test_series_id = $test_series->id;
                $testSeriesChapterObj->save();
            }
            
            foreach ($request->added_question as $question_id)
            {
                TestSeriesQuestion::create(array('question_id'=>$question_id,'test_series_id'=>$test_series->id));
            }

            return redirect('/admin/exam/set/'.$exam_id)->with('success', 'Test Series Added Successfully!');
        }
    }
    public function updateTestAddQuestions(Request $request,$exam_id, $test_id)
    {
        
        $exam = Exam::find($exam_id);
        
        if($request->method()=="GET")
        {
            $standards = Standard::all();
            return view('Exam::update-test-add-questions',array('exam'=>$exam,'standards'=>$standards));
        }
        else {
            foreach ($request->added_question as $question_id)
            {
                TestSeriesQuestion::create(array('question_id'=>$question_id,'test_series_id'=>$test_id));
            }
            return redirect('/admin/exam/set/'.$exam_id)->with('success', 'Test Series Added Successfully!');
        }
    }

    public function updateTest(Request $request,$id)
    {
        $test_series = TestSeries::find($id);
        $max_part = TestSeries::max('part');
        if($request->method()=="GET")
        {
            $standards = Standard::all();
            return view('Exam::update-test',array('test_series'=>$test_series,'standards'=>$standards,'max_part'=>$max_part));
        }
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                "total_question" => "required",
                "mark" => "required",
                "hours" => "required",
                "minute" => "required",
                "positive_mark" => "required",
                "negative_mark" => "required",
                "date" => "required",
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $test_series->part = $max_part;
            $test_series->total_question = $request->total_question;
            $test_series->mark = $request->mark;
            $test_series->hour = $request->hours;
            $test_series->min = $request->minute;
            $test_series->positive_mark = $request->positive_mark;
            $test_series->negative_mark = $request->negative_mark;
            $test_series->start_date = $request->date;
            $test_series->save();

            TestSeriesQuestion::where('test_series_id',$test_series->id)->delete();
            foreach ($request->added_question as $question_id)
            {
                TestSeriesQuestion::create(array('question_id'=>$question_id,'test_series_id'=>$test_series->id));
            }

            return redirect('/admin/exam/set/'.$test_series->exam_id)->with('success', 'Test Series Updated Successfully!');
        }
    }

    public function getSubject(Request $request)
    {
        $subjects = Subject::with('standard')->get();
        
        foreach($subjects as $obj)
        {
            $obj->standard_name = $obj->standard->name;
        }
        return $subjects;
    }

    public function getChapter(Request $request)
    {
        return Chapter::where('subject_id',$request->subject)->get();
    }

    public function getTopicIds($chapter_id)
    {
        return Topic::where('chapter_id',$chapter_id)->get()->pluck('id')->toArray();
    }

    public function getQuestion(Request $request)
    {
        $topic_ids = $this->getTopicIds($request->chapter);

        $all_question = QuestionAnswer::whereIn('topic_id',$topic_ids)->get();

        
        
        return view('Exam::search-question',array('all_questions'=>$all_question, 'request'=>$request));
    }
    
    
    
    
    public function deleteTestQuestions(Request $request){
       echo TestSeriesQuestion::where('test_series_id', $request->test_id)
                ->whereIn('question_id', $request->questions)
                ->delete();
        
        echo "success";
    }
    public function deleteQuestion($exam_id, $test_id){
        
        
        $testData = TestSeries::find($test_id);        

        
        
        
        
        
        
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $all_test_subject_ids = \App\Modules\Exam\Models\TestSeriesSubject::where('test_series_id',$test_id)->get()->pluck('subject_id');
        
        $all_test_questions_ids = TestSeriesQuestion::where('test_series_id',$test_id)
                ->get()
                ->pluck('question_id');
        
        $question_answer = QuestionAnswer::whereIn('id', $all_test_questions_ids)
                ->orderBy('subject_id')
                ->get();
        
        $question_answers = [];
            foreach ($question_answer as $qanswer) {
                $question_answers[$qanswer->topic->chapter->subject->name][] = $qanswer;
            }
            
            
            $question_answer = [];
            foreach ($question_answers as $qanswer) {
                
                foreach($qanswer as $qa)
                {
                    $question_answer[] = $qa;
                }
            }
            
            
            
        $total_question= count($question_answer);
        $arr_topics = [];
        $chapter_data = [];
        
        
        
        return view('Exam::delete_test_questions_list',['arr_topics'=>$arr_topics, 
            'chapter_data'=>$chapter_data, 
            "question_answer"=>$question_answer, 
            'total_question'=>$total_question,
            'testData' => $testData,
            'all_test_subject_ids' => $all_test_subject_ids
            ]);
    }
}
