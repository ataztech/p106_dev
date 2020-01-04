<?php

namespace App\Modules\TeacherDoubt\Controllers;

use App\Modules\Doubt\Models\Doubt;
use App\Modules\Doubt\Models\DoubtReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Validator;

class TeacherDoubtController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listDoubt() {
        return view('TeacherDoubt::list');
    }

    public function doubtData() {
        $doubts = Doubt::where('subject_id',Auth::user()->subject_id)->get();
        $doubts = $doubts->filter(function ($d){
            return $d->teacher_id == null || $d->teacher_id == Auth::user()->id;
        });
        return Datatables::of($doubts)
            ->addColumn('question', function($doubt) {
                return htmlspecialchars_decode(htmlspecialchars_decode($doubt->question));
            })
            ->addColumn('student', function($doubt) {
                return $doubt->student->name;
            })
            ->addColumn('subject', function($doubt) {
                return $doubt->subject->name;
            })
            ->addColumn('status', function($doubt) {
                switch ($doubt->status){
                    case '0':
                        return "<label class='label label-danger'>Open</label>";
                    case '1':
                        return "<label class='label label-info'>In Progress</label>";
                    case '2':
                        return "<label class='label label-success'>Close</label>";
                }
            })
            ->addColumn('teacher', function($doubt) {
                if($doubt->teacher_id != '')
                return $doubt->teacher->name;
            })
            ->rawColumns(['question','student','teacher','status','subject'])
            ->make(true);
    }

    public function viewDoubt($id) {
        $doubt = Doubt::find($id);
        return view('TeacherDoubt::reply', ['doubt' => $doubt]);
    }

    public function replyDoubt(Request $request,$id){
        $doubt_reply = new DoubtReply();
        $doubt_reply->doubt_id = $id;
        $doubt_reply->reply = $request->reply;
        $doubt_reply->reply_of = '1';
        $doubt_reply->save();
        return redirect('/teacher/doubt/view/'.$id);
    }

}
