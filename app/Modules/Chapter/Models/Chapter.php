<?php

namespace App\Modules\Chapter\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model {

       public function subject()
    {
        return $this->belongsTo('App\Modules\Subject\Models\Subject','subject_id','id');
    }
       public function questionCount()
    {
        return $this->hasMany('App\Modules\QuestionAnswer\Models\QuestionAnswer', 'chapter_id', 'id');
    }
       public function questionCount2()
    {
        return $this->hasMany('App\Modules\QuestionAnswer\Models\QuestionAnswer', 'chapter_id', 'id')->count;
    }
}
