<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EmailTemplate\Models\EmailTemplate;
use App\Modules\Models\GlobalValue;
use App\Modules\Role\Models\Permission;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;

class AdminController extends Controller
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
        return view('Admin::dashboard');
    }

    public function login()
    {
        return view('Admin::login');
    }

    public function email()
    {
        $site_title = GlobalValue::where('slug','site-title')->first();
        $site_email = GlobalValue::where('slug','site-email')->first();

        $data['USER_NAME'] = 'Aamir';
        $data['SITE_TITLE'] = $site_title->value;
        $data['SITE_EMAIL'] = $site_email->value;

        $email_template = EmailTemplate::where('template_key','registration-successful')->first();
        Mail::send('emailtemplate.registration-successful',$data, function($message) use ($site_email,$site_title) {
            $message->to('aamirkazi81@gmail.com', 'Testing')->subject('Demo')->from($site_email->value,$site_title->value);
        });
        dd('done');
    }

    public function profile(Request $request)
    {
        if($request->method()=="GET")
        {
            $user = User::find(Auth::user()->id);
            return view('Admin::profile',['user'=>$user]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'mobile' => 'unique:users',
                'email' => 'email|unique:users',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::find(Auth::user()->id);

            $user->name = $request->name;
            if($request->mobile != '')
            {
                $user->mobile = $request->mobile;
            }
            if($request->email != '')
            {
                $user->email = $request->email;
            }
            $user->address = $request->address;
            $user->save();

            return redirect('/admin/profile')->with('success',"Profile Updated Successfully");
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if(Hash::check($request->old_password, Auth::user()->password))
        {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('/admin/profile')->with('password_success',"Password has been updated successfully");
        }
        else
        {
            return redirect('/admin/profile')->with('password_error',"Something went wrong");
        }
    }

}
