<?php

namespace App\Http\Middleware;

use App\UserState;
use App\User;
use Auth;
use Closure;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Session;

class CheckUserExpiration
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
        if(Auth::check())
        {
            if(Auth::user()->temp_user == '1')
            {
                date_default_timezone_set('Asia/Kolkata'); // setting time zone
                $current_data = new \DateTime("now");
                $current_data = $current_data->format('d-m-Y h:i:s a');
                $expiration_date = new \DateTime(Auth::user()->account_expiration_date);
                if ($current_data > $expiration_date) {
                    Auth::logout();
                    return redirect('/')->with('expired','Sorry your account is expired');
                }
            }
        }

        return $next($request);
    }
}
