<?php

namespace App\Modules\Learn\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
class Bookmark extends Model {
    
public function bookmark()
{
    return $this->belongsTo('App\Modules\QuestionAnswer\Models\QuestionAnswer','b_id', 'id');
}
}
