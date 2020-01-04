<?php

namespace App\Modules\Doubt\Models;

use Illuminate\Database\Eloquent\Model;

class Doubt extends Model {
    public function subject(){
        return $this->belongsTo('App\Modules\Subject\Models\Subject','subject_id','id');
    }
    public function student(){
        return $this->belongsTo('App\User','student_id','id');
    }
    public function teacher(){
        return $this->belongsTo('App\User','teacher_id','id');
    }
    public function replies(){
        return $this->hasMany('App\Modules\Doubt\Models\DoubtReply','doubt_id','id');
    }
    public function dateInWord($date){
        $dt = \Carbon\Carbon::parse($date)->format('dmY');
        if(\Carbon\Carbon::now()->format('dmY') == $dt){
            $d = 'Today';
        }elseif (\Carbon\Carbon::now()->subDay()->format('dmY') == $dt){
            $d = 'Yesterday';
        }else{
            $d = \Carbon\Carbon::parse($date)->format('d/m/Y');
        }
        return $d;
    }
}
