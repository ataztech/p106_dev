<?php

namespace App\Modules\QuestionAnswer\Models;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model {
    protected  $fillable = ['question_answer_id','answer'];
    
    
    public function question()
    {
        return $this->hasOne('App\Modules\QuestionAnswer\Models\QuestionAnswer','id','question_answer_id');
    }
}
