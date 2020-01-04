<?php

namespace App\Modules\QuestionAnswerSet\Models;

use Illuminate\Database\Eloquent\Model;

class TopTenQuestion extends Model {
    protected $fillable = ['question_id','level', 'chapter_id'];

    
    
    public function question()
    {
        return $this->hasOne('App\Modules\QuestionAnswer\Models\QuestionAnswer','id', 'question_id');
    }
}
