<?php

namespace App\Modules\Standard\Models;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model {

   public function subjects()
    {
        return $this->hasMany('App\Modules\Subject\Models\Subject','standard_id','id');
    }
}
