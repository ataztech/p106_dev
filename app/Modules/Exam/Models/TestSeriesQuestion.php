<?php

namespace App\Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class TestSeriesQuestion extends Model {

    protected $fillable = ['question_id','test_series_id'];

    public function question()
    {
        return $this->belongsTo('\App\Modules\QuestionAnswer\Models\QuestionAnswer','question_id','id');
    }
}
