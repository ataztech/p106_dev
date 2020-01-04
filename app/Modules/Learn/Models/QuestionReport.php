<?php

namespace App\Modules\Learn\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\QuestionAnswer\Models\QuestionAnswer;
use App\Modules\QuestionAnswer\Models\QuestionsAnswersFilter;

class QuestionReport extends Model {
    protected $table = 'question_reports';
    
    public static function getApiTopicReport($topic_id,$user_id)
    {
        $total_topic_questions = QuestionAnswer::where('topic_id',$topic_id)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', $user_id)
                ->count();
        
        
        
        if($total_topic_questions>0)
        {
            $overall_progress = round(($total_question_answered/$total_topic_questions)*100,2);
        }else{
            $overall_progress = 0;
        }
        
        return $overall_progress;
    }
    public static function getTopicReport($topic_id)
    {
        $total_topic_questions = QuestionsAnswersFilter::where('topic_id',$topic_id)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->count();
        
        
        
        if($total_topic_questions>0)
        {
            $overall_progress = round(($total_question_answered/$total_topic_questions)*100,2);
        }else{
            $overall_progress = 0;
        }
        
        return $overall_progress;
    }
    
    public static function getAccuracyReport($topic_id)
    {
        $total_question_correct_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('is_correct', '1')
                ->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->count();
        
        
        
        
    
        
        if($total_question_answered>0)
        {
            $accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
            $accuracy = 0;
        }
        return $accuracy;
    }
    public static function getApiAccuracyReport($topic_id, $user_id)
    {
        $total_question_correct_answer = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)
                ->where('user_id', $user_id)
                ->where('is_correct', '1')
                ->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('topic_id',$topic_id)->where('user_id', $user_id)->count();
        
        
        
        
    
        
        if($total_question_answered>0)
        {
            $accuracy = round(($total_question_correct_answer/$total_question_answered)*100,2);
        }else{
            $accuracy = 0;
        }
        return $accuracy;
    }
    
    public static function getChapterReport($chapter_id)
    {
        $arr_topics = \App\Modules\Topic\Models\Topic::where('chapter_id', $chapter_id)->where('related_with','0')->get();
        $arr_topic_ids = $arr_topics->pluck('id');
        $total_chapters_questions = QuestionAnswer::whereIn('topic_id',$arr_topic_ids)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',$chapter_id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->count();
        
        if($total_chapters_questions>0)
        {
        $overall_progress = round(($total_question_answered/$total_chapters_questions)*100,2);
        }else{
        $overall_progress = 0;
        }
        
        return $overall_progress;
    }
    public static function getApiChapterReport($chapter_id, $user_id)
    {
        $arr_topics = \App\Modules\Topic\Models\Topic::where('chapter_id', $chapter_id)->where('related_with','0')->get();
        $arr_topic_ids = $arr_topics->pluck('id');
        $total_chapters_questions = QuestionAnswer::whereIn('topic_id',$arr_topic_ids)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::where('chapter_id',$chapter_id)
                ->where('user_id', $user_id)
                ->count();
        
        if($total_chapters_questions>0)
        {
        $overall_progress = round(($total_question_answered/$total_chapters_questions)*100,2);
        }else{
        $overall_progress = 0;
        }
        
        return $overall_progress;
    }
    
    public static function getApiSubjectReport($subject_id,$user_id)
    {
        
        // new code
        
        $subject_data = \App\Modules\Subject\Models\Subject::where('id', $subject_id)->first();
           
           
           $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();
           if($subject_data->name=="Biology")
           {
               
               
            $chapters = \App\Modules\Chapter\Models\Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();    
           }else{
            
            $chapters = \App\Modules\Chapter\Models\Chapter::where('subject_id', $subject_id)->get();

           }
        //end new code
        $chpaterIds = $chapters->pluck('id');
        
        
        $arr_topics = \App\Modules\Topic\Models\Topic::whereIn('chapter_id', $chpaterIds)->where('related_with','0')->get();
        $arr_topic_ids = $arr_topics->pluck('id');
        
        
        $total_chapters_questions = QuestionAnswer::whereIn('topic_id',$arr_topic_ids)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::whereIn('chapter_id',$chpaterIds)
                ->where('user_id', $user_id)
                ->count();
        
        
        if($total_chapters_questions>0)
        {  
            $overall_progress = round(($total_question_answered/$total_chapters_questions)*100,2);
        }else{
            $overall_progress = 0;
        }   
        return $overall_progress;
    }
    public static function getSubjectReport($subject_id)
    {
        
        // new code
        
        $subject_data = \App\Modules\Subject\Models\Subject::where('id', $subject_id)->first();
           
           
           $subjects = \App\Modules\Subject\Models\Subject::where('name','like','%'.$subject_data->name.'%')->get()->pluck('id')->toArray();
           if($subject_data->name=="Biology")
           {
               
               
            $chapters = \App\Modules\Chapter\Models\Chapter::whereIn('subject_id',$subjects)->where('board_id',2)->where('extra', '2')->get();    
           }else{
            
            $chapters = \App\Modules\Chapter\Models\Chapter::where('subject_id', $subject_id)->get();

           }
        //end new code
        $chpaterIds = $chapters->pluck('id');
        
        
        $arr_topics = \App\Modules\Topic\Models\Topic::whereIn('chapter_id', $chpaterIds)->where('related_with','0')->get();
        $arr_topic_ids = $arr_topics->pluck('id');
        
        
        $total_chapters_questions = QuestionAnswer::whereIn('topic_id',$arr_topic_ids)->count();
        $total_question_answered = \App\Modules\Learn\Models\QuestionReport::whereIn('chapter_id',$chpaterIds)
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->count();
        
        
        if($total_chapters_questions>0)
        {
            
            
        $overall_progress = round(($total_question_answered/$total_chapters_questions)*100,2);
        }else{
        $overall_progress = 0;
        }   
        return $overall_progress;
    }
    
    public static function getTotalVideoTopicsReport($subject_id)
    {
        $chapters = \App\Modules\Chapter\Models\Chapter::where('subject_id', $subject_id)->get();
        $chpaterIds = $chapters->pluck('id');
        
        $arr['topics'] = \App\Modules\Topic\Models\Topic::whereIn('chapter_id', $chpaterIds)->where('related_with','0')->count();
        $arr['videos'] = \App\Modules\Topic\Models\Topic::whereIn('chapter_id', $chpaterIds)->where('related_with','1')->count();
           
        return $arr;
    }
}
