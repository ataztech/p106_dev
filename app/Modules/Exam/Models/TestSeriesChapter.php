<?php

namespace App\Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class TestSeriesChapter extends Model {

    

    public function question()
    {
        return $this->belongsTo('\App\Modules\QuestionAnswer\Models\QuestionAnswer','question_id','id');
    }
    
    public function chapter()
    {
        return $this->belongsTo('\App\Modules\Chapter\Models\Chapter','chapter_id','id');
    }
}
