<?php

namespace App\Modules\LoginHistory\Models;


use Auth;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{

    protected $table = 'user_login_histories';

    public function studentName()
    {
       return $this->belongsTo('App\User','user_id','id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
