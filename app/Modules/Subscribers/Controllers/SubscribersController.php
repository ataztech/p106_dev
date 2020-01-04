<?php

namespace App\Modules\Subscribers\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Standard\Models\Standard;
use App\PaymentDetail;
use App\User;
use App\Modules\Subscribers\Models\Subscribers;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Storage;

class SubscribersController extends Controller
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


    /*
    Date:21/12/2019
    Name: Sana shaikh
    It return subscribers list
    */
    public function subscibersList()
    {
        return view ('Subscribers::list');
    }



    /*
    Date:21/12/2019
    Name: Sana shaikh
    It checks the number already exists in database or not
    */
    public function checkDuplicateNumber(Request $request)
    {
        $mobile_num = Subscribers::where('subscribers_number',$request->subscriber_contact_number)->first();
        if(isset($mobile_num))
        {
            return 'false';
        }
        else
        {
            return 'true';
        }
        
    }



    /*
    Date:24/12/2019
    Name: Sana shaikh
    Request $request to get data from reuest
    It insert the subscribers mobile number in our database
    */
    public function getSubscribers(Request $request)
    {


        $subscribers = new Subscribers();
        $subscribers->subscribers_number = $request->mobile;
        if($subscribers->save())
        {       
            $result = array('message' => 'Thank you we will reach you shortly', 'icon' => 'success');
            return json_encode($result);
        }
        else
        {
            $result = array('message' => 'Opps something went wrong', 'icon' => 'danger');
            return json_encode($result);
        }
    }




    /*
    Date:24/12/2019
    Name: Sana shaikh
    Fetches data using data table and listed it
    */
    public function subscribersData()
    {
        $subscriber = Subscribers::all();

        return Datatables::of($subscriber)
            ->make(true);
    }
}
