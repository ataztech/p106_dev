<?php

namespace App\Modules\Leads\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Standard\Models\Standard;
use App\PaymentDetail;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Storage;

class LeadsController extends Controller
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
    public function leadList()
    {
        return view('Leads::list');
    }

    public function leadsData()
    {
        $user = User::where('temp_user','1')->orderBy('id','DESC')->get();

        return Datatables::of($user)
            ->make(true);
    }
    
    public function makePermanentUser($id)
    {
        $find_user = User::find($id);
        if($find_user)
        {
            $find_user->temp_user = '0';
            if($find_user->save())
            {
                return redirect('/admin/leads/list')->with('success','User marked as permenent successfully');
            }
        }
    }



}
