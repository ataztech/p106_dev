<?php

namespace App\Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model {

    protected $table = 'demos';

    public function createdByAdminOrTelecaller()
    {
        return $this->belongsTo('App\User','created_by_id','id');
    }

    public function counsellorName()
    {
        return $this->belongsTo('App\Modules\Counsellor\Models\Counsellor','assigned_to','id');
    }

    public function createdByCounsellor()
    {
        return $this->belongsTo('App\Modules\Counsellor\Models\Counsellor','assigned_to','id');
    }
}
