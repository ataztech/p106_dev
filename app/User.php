<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile', 'email', 'password', 'provider', 'provider_id', 'name', 'image', 'flingal_id', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function userInformation()
    {
        return $this->hasOne('App\UserInformation');
    }
    
    public function ConfigureSyllabus()
    {
        return $this->hasOne('App\Modules\Configure\Models\ConfigureSyllabus');
    }
    public function competetiveExam()
    {
        return $this->hasMany('App\Modules\Configure\Models\UserCompetetiveExam');
    }
    
    public function subject(){
        return $this->belongsTo('App\Modules\Subject\Models\Subject','subject_id','id');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Modules\Learn\Models\Bookmark','user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Modules\Role\Models\Role','user_roles','user_id','role_id');
    }
    
    public function usersActivity()
    {
        return $this->hasMany('App\Modules\LoginHistory\Models\LoginHistory','user_id','id');
    }

    public function isAdmin()
    {
        return Auth::user()->id == 1 ? 1 : 0;
    }

    public function hasPermission($action)
    {
        if(Auth::check())
        {
            $flag = 0;
            if(Auth::user()->isAdmin())
            {
                $flag = 1;
            }
            else
            {
                foreach(Auth::user()->roles as $role)
                {
                    foreach ($role->permissions as $permission)
                    {
                        if($permission->slug == $action)
                        {
                            $flag = 1;
                        }
                    }
                }
            }

            return $flag;
        }
        else
        {
            return 0;
        }
    }
}
