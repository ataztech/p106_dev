<?php

namespace App\Modules\Configure\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigureSyllabus extends Model {
    protected $table = 'configure_syllabus';
    
    public function boardData()
    {
        return $this->hasOne('App\Modules\Board\Models\Board','id','board');
    }
    public function standard()
    {
        return $this->hasOne('App\Modules\Standard\Models\Standard','name','class');
    }
}
