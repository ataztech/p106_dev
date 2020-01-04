<?php


namespace App\Http\Controllers;


use App\Modules\Cms\Models\Cms;
use Illuminate\Http\Request;
use App\Modules\Price\Models\Price;
use App\User;
use App\Modules\LoginHistory\Models\LoginHistory;
use Illuminate\Support\Facades\Session;


use Auth;


class HomeController extends Controller

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

    public function index()

    {

        if(Auth::user()->user_status==0)
        {
            echo "<h3 style='color:red;'>Your account is blocked. Please contact admin.</h3>";
            
            Auth::logout();
            Auth::logout();
            die;
        }
        if (Auth::user()->user_type == 1) {

            return redirect('admin/dashboard');

        } 
        elseif(Auth::user()->user_type == 6){

            return redirect('telecaller/dashboard');
        }else {


            if (Auth::user()->user_type == 3 && Auth::user()->syllabus_flag == 0) {
                
                if(Auth::user()->temp_user == '1')
                {
                    date_default_timezone_set('Asia/Kolkata'); // setting time zone
                    $current_data = new \DateTime("now");
                    $current_data = $current_data->format('d-m-Y h:i:s a');
                    $expiration_date = new \DateTime(Auth::user()->account_expiration_date);
                    if($current_data <= $expiration_date)
                    {
                        date_default_timezone_set('Asia/Kolkata'); // CDT
                        $start_time = date('h:i:s a');
                        $login_current_time = date('h:i:s a');
                        Session::put('start_time',$start_time);
                        Session::put('login_current_time',$login_current_time);
                        return redirect('/user/configure/class');
                    }
                    else
                    {
                        Auth::logout();
                        return redirect('/')->with('expired','Sorry your account is expired');
                    }
                }
                else
                {
                    date_default_timezone_set('Asia/Kolkata'); // CDT
                    $start_time = date('h:i:s a');
                    $login_current_time = date('h:i:s a');
                    Session::put('start_time',$start_time);
                    Session::put('login_current_time',$login_current_time);
                    return redirect('/user/configure/class');
                }

           } elseif (Auth::user()->user_type == 3 && Auth::user()->syllabus_flag == 1) {
               
               if(Auth::user()->temp_user == '1')
                {
                    date_default_timezone_set('Asia/Kolkata'); // setting time zone
                    $current_data = new \DateTime("now");
                    $current_data = $current_data->format('d-m-Y h:i:s a');
                    $expiration_date = new \DateTime(Auth::user()->account_expiration_date);
                    if($current_data <= $expiration_date)
                    {
                    
                        date_default_timezone_set('Asia/Kolkata'); // CDT
                        $start_time = date('h:i:s a');
                        $login_current_time = date('h:i:s a');
                        Session::put('start_time',$start_time);
                        Session::put('login_current_time',$login_current_time);
                        return redirect('/dashboard');
                    }
                    else
                    {
                        Auth::logout();
                        return redirect('/')->with('expired','Sorry your account is expired');
                    }

                }
                else
                {
                    date_default_timezone_set('Asia/Kolkata'); // CDT
                    $start_time = date('h:i:s a');
                    $login_current_time = date('h:i:s a');
                    Session::put('start_time',$start_time);
                    Session::put('login_current_time',$login_current_time);
                    return redirect('/dashboard');
                }


            } else {

                return redirect('/login')->with('error', 'Something went wrong');

            }

        }


    }

    public function logout()
    {

        $start_time = Session::get('start_time');
        date_default_timezone_set('Asia/Kolkata'); // CDT
        $end_time = date('h:i:s a');
        $s_time = date_create_from_format('h:i:s a',$start_time); // converting start time to time object
        $e_time = date_create_from_format('h:i:s a',$end_time); // converting end time to time object
        //$active_duration = $s_time->diff($e_time)->format('%i'); // getting difference between start time and end time
        $active_duration = $s_time->diff($e_time); // getting difference between start time and end time
        $current_data = date('d/m/Y'); // getting current date

        // saving data in table start
        $save_user_state = new LoginHistory();
        $save_user_state->user_id = Auth::user()->id;
        $save_user_state->start_time = $start_time;
        $save_user_state->end_time = $end_time;
        if($active_duration->format('%i') >= 60)
        {
            $save_user_state->active_time = $active_duration->format('%h').' Hour '.$active_duration->format('%i').' Minutes';
        }
        else
        {
            $save_user_state->active_time = $active_duration->format('%i').' Minutes';
        }
        $save_user_state->date = $current_data;
        $save_user_state->save();
        //end

        Session::forget('start_time');
        Session::forget('login_current_time');
        Session::forget('middleware_current_time');
        Auth::logout();
        return redirect('/');
    }

    public function dashboard()

    {


        return view('home');

    }

    public function examinerDashboard()

    {


        return view('examiner-home');

    }

    public function cms($slug){
        $cms = Cms::where('slug',$slug)->first();
        return view('cms',compact('cms'));
    }
    
    public function priceDetails(){
        $prices = Price::all();
        return view('price-details',compact('prices'));
    }

    public function getPrice(Request $request){
        $price = Price::where('year',$request->year)->first();
        return $price;
    }
    
    public function checkMobileNumber(Request $request)
    {
        $mobile_no = $request->mobile;
        $check_mobile_no = User::where('mobile',$mobile_no)->first();
        if(isset($check_mobile_no))
        {
            return 'false';
        }
        else
        {
            return 'true';
        }
    }
    
     public function registerStudent(Request $request)
    {
        $email = str_replace(' ', '', $request->name);
        $email = $email.rand(10,2500).'@gmail.com';
        date_default_timezone_set('Asia/Kolkata'); // setting time zone
        $account_registration_date = new \DateTime("now");
        $account_expiration_date = new \DateTime("+3 day");
        $student =  new User();
        $student->email = $email;
        $student->name = $request->name;
        $student->mobile = $request->mobile;
        $student->city = $request->city;
        $student->password = bcrypt($request->pasword);
        $student->user_status = '1';
        $student->user_type = '3';
        $student->temp_user = '1';
        $student->account_registration_date = $account_registration_date->format('d-m-Y h:i:s a');
        $student->account_expiration_date = $account_expiration_date->format('d-m-Y h:i:s a');
        if($student->save())
        {
            $result = array('message' => 'Register Successfully...','icon'=>'success');
        }
        else
        {
            $result = array('message' => 'Opps Something Went Wrong','icon'=>'danger');
        }
        return json_encode($result);
    }
    
    public function sendMessage()
    {
        date_default_timezone_set('Asia/Kolkata'); // setting time zone
        $current_date = date('d/m/Y');
        $all_users = User::where('user_type','3')->where('temp_user','0')->get();
        if(isset($all_users))
        {
            foreach($all_users as $key => $user)
            {
                $message = '';
                $total_active_duration = 0;
                $get_user_activities = LoginHistory::where('user_id','5')->where('date','=',$current_date)->get();
                if(isset($get_user_activities))
                {
                    $send_message_to_number = $user->mobile;
                    $send_message_to_name = $user->name;
                    $message = "Hello ".$send_message_to_name.", your activity log for ".$current_date." are below,";
                    foreach($get_user_activities as $index => $activity)
                    {
                        $message .= ' ('.++$index.')'." Start Time: ".str_replace(' ', '', $activity->start_time);
                        $message .= " End Time: ".str_replace(' ', '', $activity->end_time);
                        $message .= " Active Duration: ".$activity->active_time;

                        // This code to display total active duration
                        $s_time = date_create_from_format('h:i:s a',$activity->start_time); // converting start time to time object
                        $e_time = date_create_from_format('h:i:s a',$activity->end_time); // converting end time to time object
                        $active_duration = $s_time->diff($e_time); // getting difference between start time and end time
                        $total_active_duration += $active_duration->format('%i'); // storing active duration in minutes format
                    }
                    if($total_active_duration >= 60) // checking total active duration is greater than 60 minute
                    {
                        // if total active duration is greater tahn 60 minute execte this code
                        $format = '%d Hours %d Minutes'; // setting format to display time
                        $hours = floor($total_active_duration / 60); // getting total hour from minute
                        $minutes = ($total_active_duration % 60); // getting minute
                        $message .= " Total Active Duration: ".sprintf($format, $hours, $minutes);

                    }
                    else
                    {
                        // else display the total minute
                        $message .= " Total Active Duration: ".$total_active_duration." Minutes";
                    }

                    //dd($message);
                    $xml_data ='<?xml version="1.0"?>
                                <parent>
                                    <child>
                                        <user>ATAZTech</user>
                                        <key>6c5128b6dcXX</key>
                                        <mobile>9834751620</mobile>
                                        <message>'.$message.'</message>
                                        <accusage>2</accusage>
                                        <senderid>NTFSMS</senderid>
                                    </child>
                                </parent>';

                    $URL = "http://mobicomm.dove-sms.com//submitsms.jsp?";
                    $ch = curl_init($URL);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    dd($output);
                }

            }
        }
    }
    
    public function verifyForgotPasswordNUmber(Request $request)
    {
        $mobile = $request->mobile;
        if(isset($mobile))
        {
            $verify_mobile_number = User::where('mobile',$mobile)->first();
            if(isset($verify_mobile_number) && $verify_mobile_number->count() > 0)
            {
                $generate_new_password = 'AtazLearning'.rand(1000,9999);
                $mobile_number = $verify_mobile_number->mobile;
                $message = 'Hello '.$verify_mobile_number->name.', your new password is '.$generate_new_password;
                $xml_data ='<?xml version="1.0"?>
                                <parent>
                                    <child>
                                        <user>ATAZTech</user>
                                        <key>6c5128b6dcXX</key>
                                        <mobile>'.$mobile_number.'</mobile>
                                        <message>'.$message.'</message>
                                        <accusage>2</accusage>
                                        <senderid>ATAZLR</senderid>
                                    </child>
                                </parent>';
                $URL = "http://mobicomm.dove-sms.com//submitsms.jsp?";
                $ch = curl_init($URL);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
                curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_exec($ch);
                $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                if($resultStatus == 200)
                {
                    $verify_mobile_number->password = bcrypt($generate_new_password);
                    $verify_mobile_number->save();
                    $result = array('res_status' => '1', 'res_msg' => 'Success', 'response' => '');
                    return json_encode($result);
                }
                else
                {
                    $result = array('res_status' => '0', 'res_msg' => 'Opps something went wrong', 'response' => '');
                    return json_encode($result);
                }

            }
            else
            {
                $result = array('status' => '0','message'=>'Mobile number not found');
                return json_encode($result);
            }
        }
    }
    

}

