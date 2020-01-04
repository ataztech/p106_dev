<?php

namespace App\Modules\Video\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    public function topic()
    {
        return $this->belongsTo('App\Modules\Topic\Models\Topic','topic_id','id');
    }

}
