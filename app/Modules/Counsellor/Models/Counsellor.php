<?php

namespace App\Modules\Counsellor\Models;

use Illuminate\Database\Eloquent\Model;

class Counsellor extends Model {

    protected $table = 'counsellors';

   /*public function subjects()
    {
        return $this->hasMany('App\Modules\Subject\Models\Subject','standard_id','id');
    }*/
}
