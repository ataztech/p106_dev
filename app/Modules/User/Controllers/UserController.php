<?php

namespace App\Modules\User\Controllers;

use App\Modules\Role\Models\Role;
use App\Helper\fileUploadHelper;
use App\Modules\Role\Models\UserRole;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;
use URL;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function list()
    {
        return view('User::list');
    }
    
    public function profile()
    {
        
        
        return view('User::update-profile');
    }
    
    public function updateProfile(Request $request)
    {
        
        
        /*$checkMobile = User::where('mobile',$request->mobile)
                ->where('id','!=',Auth::user()->id)
                ->get();*/
        
        /*if(count($checkMobile)>0)
        {
            Session::put('error','Mobile number already exist.');
            Session::save();
         return redirect(URL::previous());   
        }*/
        
        if($request->has('profile'))
        {
        $image = fileUploadHelper::fileUpload(['file_type'=>'image','html_input_name'=>'profile','file'=>$request->profile,
                    'destination'=>'/storage/app/public/profile','resize'=>['resize'=>true,'height'=>200,'width'=>200,'resize_destination'=>'/storage/app/public/profile/thumb']]);
        
        if(Auth::user()->profile_img!='')
        {
        unlink(base_path('storage/app/public/profile/'.Auth::user()->profile_img));
        unlink(base_path('storage/app/public/profile/thumb/'.Auth::user()->profile_img));
        }
        Auth::user()->profile_img= $image[0];
        }
        //Auth::user()->mobile = $request->mobile;
        Auth::user()->name = $request->name;
        Auth::user()->save();
        Session::put('success','Profile updated successfully.');
            Session::save();
        return redirect(URL::previous());   
    }
    
    
    public function updatePassword(Request $request)
    {
        Auth::user()->password = bcrypt($request->new_password);
        Auth::user()->save();
           Session::put('success','Password updated successfully.');
            Session::save();
        return redirect(URL::previous());    
    }
    public function userSyllabus()
    {
        
        
        return view('User::syllabus');
    }

    public function data()
    {
        $users = User::where('user_type',2)->orderBy('id','desc')->get();

        return Datatables::of($users)
            ->addColumn('status', function($user) {
                if($user->user_status == 1)
                {
                    return '<label class="label label-success">Active</label>';
                }
                else
                {
                    return '<label class="label label-danger">Inactive</label>';
                }

            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            $roles = Role::where('role_type','0')->get();
            return view('User::create',['roles'=>$roles]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'mobile' => 'required|numeric|min:10|unique:users',
                'password' => 'required|min:6|confirmed',
                'city' => 'required',
                'state' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user =  new User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->password = $request->password;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->address = $request->address;
            $user->user_status = $request->status;
            $user->user_type = '2';

            $user->save();

            $role = new UserRole();
            $role->user_id = $user->id;
            $role->role_id = $request->role;
            $role->save();

            return redirect('admin/user/list')->with('success','User Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $user = User::find($id);
        if($request->method()=="GET")
        {
            $roles = Role::where('role_type','0')->get();
            return view('User::update',['user'=>$user,'roles'=>$roles]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'email' => 'unique:users',
                'name' => 'required',
                'mobile' => 'unique:users',
                'password' => 'confirmed',
                'city' => 'required',
                'state' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if($request->email != '')
            {
                $user->email = $request->email;
            }
            if($request->password != '')
            {
                $user->password = $request->password;
            }
            if($request->mobile != '')
            {
                $user->mobile = $request->mobile;
            }

            $user->name = $request->name;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->address = $request->address;
            $user->user_status = $request->status;

            $user->save();

            UserRole::where('user_id',$user->id)->delete();

            $role = new UserRole();
            $role->user_id = $user->id;
            $role->role_id = $request->role;
            $role->save();

            return redirect('admin/user/list')->with('success','User Updated Successfully!');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('admin/user/list')->with('success','User Delete Successfully!');
    }
}
