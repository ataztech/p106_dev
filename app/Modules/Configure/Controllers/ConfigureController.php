<?php
namespace App\Modules\Configure\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;
use Illuminate\Support\Facades\Session;
use App\User;

class ConfigureController extends Controller
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

    public function configureClass()
    {
        $data = \App\Modules\Standard\Models\Standard::all();
        
        return view('Configure::class',['data'=>$data]);
    }
    
    public function saveConfigureClass($id)
    {
        Session::put('class',$id);
        Session::save();
        return redirect(url('user/configure/save-stream/science'));     
        
    }
    public function configureBoard()
    {
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
            $configureSyllabusData->board = 2;
            $configureSyllabusData->user_id = Auth::user()->id;
            $configureSyllabusData->exam_flag = '0';
            
            $configureSyllabusData->save();    
        }else{
            $configureSyllabus = new \App\Modules\Configure\Models\ConfigureSyllabus();
            $configureSyllabus->class = Session::get('class');
            $configureSyllabus->stream = 1;
            $configureSyllabus->board = 2;
            $configureSyllabus->exam_flag = '0';
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
        if(Session::has('board_exam') && !$request->has('competitive_exam'))
        {
            return redirect(url('user/configure/save-board'));     
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
        $configureSyllabusData->board = 2;
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
        $configureSyllabus->board = 2;
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
    
    public function configureSubjects()
    {
        return view('Configure::subjects');
    }
}
