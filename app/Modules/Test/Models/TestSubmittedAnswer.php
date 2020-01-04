<?php

namespace App\Modules\Test\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
class TestSubmittedAnswer extends Model {
    protected $table = 'test_submitted_answer';
    
    public function getQuestionAnswer()
    {
            return $this->belongsTo('App\Modules\QuestionAnswer\Models\CorrectAnswer','question_id','question_answer_id');
    }
    
}
