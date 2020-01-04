<?php

namespace App\Modules\TeacherDashboard\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Board\Models\Board;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class TeacherDashboardController extends Controller
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
     * Show the application dashBoard::
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TeacherDashboard::dashboard');
    }
}
