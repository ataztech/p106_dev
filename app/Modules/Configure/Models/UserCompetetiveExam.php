<?php

namespace App\Modules\Configure\Models;

use Illuminate\Database\Eloquent\Model;

class UserCompetetiveExam extends Model {
    protected $table = 'user_competetive_exam';
    
     public function exam()
    {
        return $this->hasOne('App\Modules\Exam\Models\Exam','id','exams_id');
    }
}
