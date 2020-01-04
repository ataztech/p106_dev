<?php

namespace App\Modules\Subscribers\Models;
use App\Modules\Subscribers\Models\Subscribers;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{

    protected $table = 'subscribers';
     protected $fillable = ['subscribers_number'];

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
