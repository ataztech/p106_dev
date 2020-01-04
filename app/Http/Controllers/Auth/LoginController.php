<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserInformation;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        dd(4);
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider) {
        
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider) {
        try {
            $user = Socialite::driver($provider)->user();
            
            $authUser = $this->findOrCreateUser($user, $provider);
            
            Auth::loginUsingId($authUser->id);
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect('auth/'.$provider);
        }
    }

    public function findOrCreateUser($user, $provider) {
        
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
         $createdUser = User::create([
                    'email' => $user->email,
                    'password' => ' ',
                    'mobile' => ' ',
                    'provider' => $provider,
                    'provider_id' => $user->id,
                    'name'=> $user->name,   
                    'image' => $user->avatar,
                    'user_type' => "2"
        ]);
         
         $createdUser->save();
         
         return $createdUser;
         
         
    }

}
