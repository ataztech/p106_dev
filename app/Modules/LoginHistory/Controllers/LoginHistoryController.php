<?php

namespace App\Modules\LoginHistory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\LoginHistory\Models\LoginHistory;
use App\Modules\Standard\Models\Standard;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Storage;

class LoginHistoryController extends Controller
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
    public function loginHistoryList()
    {
        return view('LoginHistory::list');
    }

    public function loginHistoryData()
    {
        $login_history_detail = LoginHistory::all();

        return Datatables::of($login_history_detail)
            ->addColumn('user_id', function($login_history) {
                return $login_history->studentName->name;
            })
            ->addColumn('active_time', function($login_history) {
                return $login_history->active_time;
            })
            ->make(true);
    }



}
