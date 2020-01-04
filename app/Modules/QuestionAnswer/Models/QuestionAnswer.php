<?php
namespace App\Modules\QuestionAnswer\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model {

    public function topic()
    {
        return $this->belongsTo('App\Modules\Topic\Models\Topic','topic_id','id');
    }

    public function answer()
    {
        return $this->hasOne('App\Modules\QuestionAnswer\Models\CorrectAnswer','id','question_answer_id');
    }
    
    public function bookmark()
    {
        return $this->hasOne('App\Modules\Learn\Models\Bookmark','b_id','id');
    }
    
    public function answer2()
    {
        return $this->hasOne('App\Modules\QuestionAnswer\Models\CorrectAnswer','question_answer_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo('App\Modules\Subject\Models\Subject','subject_id','id');
    }

}
