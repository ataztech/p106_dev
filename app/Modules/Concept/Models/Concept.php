<?php

namespace App\Modules\Concept\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Concept extends Model {

    public function chapter()
    {
        return $this->belongsTo('App\Modules\Chapter\Models\Chapter','chapter_id','id');
    }
    public function conceptType()
    {
        return $this->belongsTo('App\Modules\Concept\Models\ConceptType','concept_type','id');
    }
    
    
    public function bookmark()
    {
        return $this->hasOne('App\Modules\Learn\Models\Bookmark','b_id','id')->where('user_id',Auth::user()->id);
    }
}
