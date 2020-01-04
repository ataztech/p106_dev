<?php

namespace App\Modules\QuestionAnswerSet\Models;

use Illuminate\Database\Eloquent\Model;
class PreviousQuestionPaper extends Model {
    protected $fillable = ['chapter_id','question_id'];

    public function chapter()
    {
        return $this->belongsTo('\App\Modules\Chapter\Models\Chapter','chapter_id','id');
    }
    
     public function question()
    {
        return $this->hasOne('App\Modules\QuestionAnswer\Models\QuestionAnswer','id', 'question_id');
    }
}
