<?php

namespace App\Modules\Subject\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {

    public function standard()
    {
        return $this->belongsTo('App\Modules\Standard\Models\Standard','standard_id','id');
    }

}
