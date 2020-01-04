<?php

namespace App\Http\Middleware;

use App\Modules\LoginHistory\Models\LoginHistory;
use App\Modules\Subject\Models\Subject;
use Closure;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Request;

class CheckUserState
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        return $next($request);
        if(Auth::check())
        {
            //subject wise time code
            /*$subject_id = base64_decode(Request::segment(3));
            if(isset($subject_id))
            {
                $subject = Subject::select('name')->find($subject_id);
                if(isset($subject))
                {
                   $current_subject =  $subject->name;
                }
            }*/
            $buffer_time = 20; // Setting buffer time
            date_default_timezone_set('Asia/Kolkata'); // setting time zone
            $middleware_current_time = date('h:i:s a'); // Getting current time when middleware is called
            Session::put('middleware_current_time',$middleware_current_time); // storing middleware current time in session
            $c_time = date_create_from_format('h:i:s a',Session::get('login_current_time')); // getting login current time from session
            $m_c_time = date_create_from_format('h:i:s a',Session::get('middleware_current_time')); // getting middleware current time from session
            $check_buffer_time = $c_time->diff($m_c_time)->format('%i'); // getting difference between login current time and middleware current
            if($check_buffer_time <= $buffer_time)  // checking if the difference between login current time and middleware current is less than buffer time or not
            {
                //subject wise time code
                /*$current_subject_usage = $check_buffer_time;
                if(Session::has($current_subject))
                {
                    $get_previous_subject_usage_time = Session::get($current_subject);
                    $new_subject_usage_time = $get_previous_subject_usage_time + $current_subject_usage;
                    Session::put($current_subject,$new_subject_usage_time);
                }
                else
                {
                    Session::put($current_subject,$current_subject_usage);
                }*/
                // performing some action if difference between login current time and middleware current is less than buffer time
                $update_login_current_time = date('h:i:s a');
                Session::put('login_current_time',$update_login_current_time);
            }
            else
            {
                // performing some action if difference between login current time and middleware current is greater than buffer time
                $start_time = Session::get('start_time'); // getting start time from session
                $end_time = date('h:i:s a',strtotime($start_time . ' +2 minutes')); // creating end time by adding start time and buffer time
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

                // expiring user session and creating new start and current time
                date_default_timezone_set('Asia/Kolkata'); // CDT
                $update_start_time = date('h:i:s a');
                $update_login_current_time = date('h:i:s a');
                Session::put('start_time',$update_start_time);
                Session::put('login_current_time',$update_login_current_time);


            }
            //dd(Session::get('start_time'),Session::get('current_time'),$check_buffer_time);
            //dd(Session::get('start_time'),Session::get('current_time'));
        }

        return $next($request);
    }
}
