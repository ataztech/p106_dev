<?php

namespace App\Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class TestSeriesSubject extends Model {
    
    public function question()
    {
        return $this->belongsTo('\App\Modules\QuestionAnswer\Models\QuestionAnswer','question_id','id');
    }
    
    public function subject()
    {
        return $this->belongsTo('App\Modules\Subject\Models\Subject','subject_id','id');
    }
}
