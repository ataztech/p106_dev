<?php

namespace App\Modules\Concept\Models;

use Illuminate\Database\Eloquent\Model;

class ConceptType extends Model {

    protected $table = 'concept_types';
    public function chapter()
    {
        return $this->belongsTo('App\Modules\Chapter\Models\Chapter','chapter_id','id');
    }
}
