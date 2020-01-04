<?php

namespace App\Modules\Gallery\Models;
use App\Modules\Gallery\Models\Gallery;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $table = 'gallery';
     protected $fillable = ['image', 'title', 'sequence_number'];

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
