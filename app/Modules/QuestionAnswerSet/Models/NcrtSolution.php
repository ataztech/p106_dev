<?php

namespace App\Modules\QuestionAnswerSet\Models;

use Illuminate\Database\Eloquent\Model;

class NcrtSolution extends Model {
    protected $fillable = ['chapter_id','question','solution'];

    public function chapter()
    {
        return $this->belongsTo('\App\Modules\Chapter\Models\Chapter','chapter_id','id');
    }
    
    
}
