<?php

namespace App\Modules\Sales\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model {

    protected $table = 'sales';

   public function counsellorName()
    {
        return $this->belongsTo('App\Modules\Counsellor\Models\Counsellor','counsellor_id','id');
    }
}
