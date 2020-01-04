<?php

namespace App\Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class TestSeries extends Model {

    public function exam()
    {
        return $this->belongsTo('App\Modules\Exam\Models\Exam','exam_id','id');
    }

    public function testSeriesQuestion()
    {
        return $this->hasMany('App\Modules\Exam\Models\TestSeriesQuestion','test_series_id','id');
    }
    
    public function testSeriesChapter()
    {
        return $this->hasMany('App\Modules\Exam\Models\TestSeriesChapter','test_series_id','id');
    }
    
    public function testSeriesSubject()
    {
        return $this->hasMany('App\Modules\Exam\Models\TestSeriesSubject','test_series_id','id');
    }

    public function testSeriesQuestionIds($id)
    {
        return TestSeriesQuestion::where('test_series_id',$id)->get()->pluck('question_id')->toArray();
    }

}
