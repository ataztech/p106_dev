<?php

namespace App\Modules\Doubt\Controllers;

use App\Modules\Doubt\Models\Doubt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;

class DoubtController extends Controller
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
        return view('Doubt::list');
    }

    public function doubtData() {
        $doubts = Doubt::all();
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
        return view('Doubt::reply', ['doubt' => $doubt]);
    }

}
