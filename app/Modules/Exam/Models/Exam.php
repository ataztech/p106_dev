<?php

namespace App\Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model {

    //
 public function getAllTest()
 {
     return $this->hasMany('App\Modules\Exam\Models\TestSeries','exam_id', 'id');
 }
}
