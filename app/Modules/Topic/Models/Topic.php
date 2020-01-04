<?php

namespace App\Modules\Topic\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

    public function chapter()
    {
        return $this->belongsTo('App\Modules\Chapter\Models\Chapter','chapter_id','id');
    }
    
    public function videos()
    {
        return $this->hasMany('App\Modules\Video\Models\Video','topic_id','id');
    }

}
