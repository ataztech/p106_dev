@extends('layouts.app-dashboard')
<title>{{$testData->exam->name}} - {{$testData->exam_type}} - {{$testData->name}}</title>
@section('content')

<style>
    .afq_report_outr{
        margin:0px !important;
    }
    
        .afq-media{
        padding-top: 6% !important;
    }
    
    .afq_motion_tab .tab-content{
        width:100% !important;
    }
    
    .afq_qsn_ans{
        width:90% !important
    }
</style>


<div class="main_dash_right" style="padding: 5% 6% 0 34% !important" >
    <h2>{{$testData->exam->name}} - {{$testData->exam_type}} - {{$testData->name}}</h2>
    <div class="motion_tab afq_motion_tab">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"  ><a href="#home" onclick="$('#current-tab').text('Report')" aria-controls="home" role="tab" data-toggle="tab" >Report</a></li>
        <li role="presentation"><a href="#profile" onclick="$('#current-tab').text('Answer Key')" aria-controls="profile" role="tab" data-toggle="tab" style="width:150px;">Answer Key</a></li>
        
      </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home"> 
  <div class="row">
    <div class="col-md-9">
    
    <h4>Report Card</h4>
    <!--<h5>dsxdxszxds</h5>--> 
      <div class="report_outr afq_report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                      <div class="media-body">
                          @if($testData->positive_mark > 0)
                            <h5><b>{{$score}}/{{$total_question * $testData->positive_mark}}</b></h5>
                          @else
                              <h5><b>{{$score}}/{{$testData->mark}}</b></h5>
                          @endif
                        <p>Score</p>
                      </div>
                    </div>
                    <div class="media">
                    <div class="media-left"><i class="fa fa-question" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$total_question_attempted}}/ {{$total_question}}</h5>
                        <p>Questions Attempted</p>
                      </div>
                  </div> 
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="media">
                    <div class="media-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="media-body">
                        <h5><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></h5>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                      </div>
                    </div>
                    <div class="media">
                    <div class="media-left"><i class="fa fa-check" aria-hidden="true"></i></div>
                      <div class="media-body">
                          @if($testData->positive_mark > 0)
                              <h5>{{$total_subject_correct_answer}}</h5>
                          @else
                              <h5>{{$total_subject_correct_answer_other}}</h5>
                          @endif
                        <p>Total Correct Answer</p>
                      </div>
                  </div>

              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="media">
                    <div class="media-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="media-body">
                        <h5><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></h5>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                      </div>
                    </div>
                    <div class="media">
                    <div class="media-left"><i class="fa fa-times" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$total_subject_wrong_answer}}</h5>
                        <p>Total Wrong Answer</p>
                      </div>
                  </div>

              </div>
              
            </div>
          </div>
      </div>
      
      
      <div class="report_outr afq_report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-eye"></i></div>
                      <div class="media-body">
                        <h5><b>Accuracy</b></h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                        <h5>{{$accuracy}}%</h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                         
                      </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
<!--    <div class="report_outr afq_report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-left"><i class="fa fa-bolt"style="background-color: #1a237e"></i></div>
                      <div class="media-body">
                        <h5><b>Speed</b></h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                          <h5> <span>Questions/Hour</span></h5>  
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                         
                      </div>
                  </div>
              </div>
            </div>
            
          </div>
      </div>-->
    </div>
      
      <div class="col-md-9">
          <br>
    <h4>Score Distribution</h4>
          @if($testData->positive_mark > 0)
              @foreach($subject_questions as $skey=>$sq)
                  <div class="report_outr afq_report_outr">
                      <div class="report_in">
                          <div class="row">
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-left"><i class="fa fa-cubes"style="background-color: #1a237e"></i></div>
                                      <div class="media-body">
                                          <h5><b>{{$skey}}</b></h5>

                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-body">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-body">

                                          <h5> <span>{{$subject_marks[$skey]}}/{{count(array_unique($sq)) * $testData->positive_mark}}</span></h5>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
              @endforeach
          @else
              @php
                  $subject_ids =  \App\Modules\Exam\Models\TestSeriesSubject::select('subject_id')->where('test_series_id',$testData->id)->groupBy('subject_id')->get();
              @endphp
              @foreach($subject_ids as $skey => $subject_id)
                  @php
                    $subject_name = \App\Modules\Subject\Models\Subject::find($subject_id->subject_id);
                  @endphp
                  <div class="report_outr afq_report_outr">
                      <div class="report_in">
                          <div class="row">
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-left"><i class="fa fa-cubes"style="background-color: #1a237e"></i></div>
                                      <div class="media-body">
                                          <h5><b>{{$subject_name->name}}</b></h5>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-body">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-body">
                                          @php
                                              $positive_marks = array_sum(\App\Modules\Exam\Models\TestSeriesSubject::where('subject_id',$subject_id->subject_id)->where('test_series_id',$testData->id)->get()->pluck('positive_mark')->toArray());
                                          @endphp
                                          <h5> <span>{{$subject_marks[$subject_name->name]}}/{{count(array_unique($subject_questions[$subject_name->name])) * $positive_marks}}</span></h5>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
              @endforeach
          @endif
    <div class="report_outr afq_report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media afq-media">
                      <div class="media-left"><i class="fa fa-cube"style="background-color: #1a237e"></i></div>
                      <div class="media-body">
                          <h3 style="margin-top: 5px"><b>Total</b></h3>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                          @if($testData->positive_mark > 0)
                          <h3> <span>{{$score}}/{{$total_question * $testData->positive_mark}}</span></h3>
                          @else
                              <h3> <span>{{$score}}/{{$testData->mark}}</span></h3>
                          @endif
                      </div>
                  </div>
              </div>
            </div>
            
          </div>
      </div>
    
    <br><br><br>  
          @if($testData->positive_mark > 0)
              @foreach($subject_questions as $skey=>$sq)
                  <div class="report_outr afq_report_outr">
                      <div class="report_in">
                          <div class="row">
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-left"><i class="fa fa-cubes"style="background-color: #1a237e"></i></div>
                                      <div class="media-body">
                                          <h5><b>{{$skey}}</b></h5>

                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-body">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <div class="media">
                                      <div class="media-body">

                                          <h5> <span></span></h5>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <div class="media">
                                      <br>
                                      <div class="media-left"><i class="fa fa-check" aria-hidden="true"></i></div>
                                      <div class="media-body">
                                          <h5><b>{{$subject_correct_answers[$skey]}}</b></h5>
                                          <p>Correct Answer</p>
                                      </div>
                                  </div>






                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <div class="media">
                                      <br>
                                      <div class="media-left"><i style="background:#9575cd" class="fa fa-times" aria-hidden="true"></i></div>
                                      <div class="media-body">
                                          <h5><b>{{$subject_wrong_answers[$skey]}}</b></h5>
                                          <p>Wrong Answer</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <div class="media">
                                      <br>
                                      <div class="media-left"><i class="fa fa-cube"style="background-color: #1a237e"></i></div>
                                      <div class="media-body">
                                          <h5><b>{{$subject_marks[$skey]}}/{{count(array_unique($sq)) * $testData->positive_mark}}</b></h5>
                                          <p>Total</p>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>

              @endforeach
            @else
              @php
                  $subject_ids =  \App\Modules\Exam\Models\TestSeriesSubject::select('subject_id')->where('test_series_id',$testData->id)->groupBy('subject_id')->get();
              @endphp
              @foreach($subject_ids as $skey => $subject_id)
                  @php
                      $subject_name = \App\Modules\Subject\Models\Subject::find($subject_id->subject_id);
                  @endphp
                      <div class="report_outr afq_report_outr">
                          <div class="report_in">
                              <div class="row">
                                  <div class="col-md-4 col-sm-4 col-xs-4">
                                      <div class="media">
                                          <div class="media-left"><i class="fa fa-cubes"style="background-color: #1a237e"></i></div>
                                          <div class="media-body">
                                              <h5><b>{{$subject_name->name}}</b></h5>

                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-sm-4 col-xs-4">
                                      <div class="media">
                                          <div class="media-body">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-sm-4 col-xs-4">
                                      <div class="media">
                                          <div class="media-body">

                                              <h5> <span></span></h5>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 col-sm-4 col-xs-12">
                                      <div class="media">
                                          <br>
                                          <div class="media-left"><i class="fa fa-check" aria-hidden="true"></i></div>
                                          <div class="media-body">
                                              <h5><b>{{$subject_correct_answers[$subject_name->name]}}</b></h5>
                                              <p>Correct Answer</p>
                                          </div>
                                      </div>






                                  </div>
                                  <div class="col-md-4 col-sm-4 col-xs-12">
                                      <div class="media">
                                          <br>
                                          <div class="media-left"><i style="background:#9575cd" class="fa fa-times" aria-hidden="true"></i></div>
                                          <div class="media-body">
                                              <h5><b>{{$subject_wrong_answers[$subject_name->name]}}</b></h5>
                                              <p>Wrong Answer</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-sm-4 col-xs-12">
                                      <div class="media">
                                          <br>
                                          <div class="media-left"><i class="fa fa-cube"style="background-color: #1a237e"></i></div>
                                          <div class="media-body">
                                              @php
                                                  $positive_marks = array_sum(\App\Modules\Exam\Models\TestSeriesSubject::where('subject_id',$subject_id->subject_id)->where('test_series_id',$testData->id)->get()->pluck('positive_mark')->toArray());
                                              @endphp

                                              <h5> <b>{{$subject_marks[$subject_name->name]}}/{{count(array_unique($subject_questions[$subject_name->name])) * $positive_marks}}</b></h5>
                                              <p>Total</p>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>
              @endforeach

            @endif
  </div>
    
</div>
</div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="row">
                    <div  class="col-md-9">   
                @foreach($ak_question_answers as $index => $question_answer)
                
                
                    @php
                     $flag = 0;
                     $class_correct_wrong = '';
                     
                     $selected_answer = -1;
                    @endphp
                @if($submittedAnswer->where('question_id', $question_answer->id)->first())
                
                    @php
                     $flag = 1;
                     $selected_answer = $submittedAnswer->where('question_id', $question_answer->id)->first()->selected_answer;
                     
                     
                     if($question_answer->answer2->answer == $selected_answer)
                     {
                        $class_correct_wrong = 'correct-answer';
                     }else{
                        $class_correct_wrong = 'wrong-answer';
                     }
                    @endphp
                @endif
                
                <div class="qsn_ans afq_qsn_ans {{$flag==1?'attempted-question':'unattempted-question'}} {{$class_correct_wrong}}">
    <div class="question">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-1"> 
            <div class="qsn_number">
                <span class="af_question_number"> {{$index+1}} </span>
            </div>
          </div>
          <div class="col-md-11">
            {!! html_entity_decode($question_answer->question)!!}
          </div>
        </div>
      </div>
    </div>
    <div class="answer">
        
        <ul>
          @if(isset($question_answer->option_1))
          <li class="option1 {{$question_answer->answer2->answer == '1' ?'correct_ans':(($selected_answer=='1' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},1, this)"><span>A</span>{!!html_entity_decode($question_answer->option_1)!!}
              @if($question_answer->answer2->answer==1)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
          </li>
          @endif
          
          @if(isset($question_answer->option_2))
            <li class="option2 {{$question_answer->answer2->answer== '2' ?'correct_ans':(($selected_answer=='2' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},2, this)"><span>B</span>{!!html_entity_decode($question_answer->option_2)!!}
            @if($question_answer->answer2->answer==2)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
            </li>
         @endif
         
         @if(isset($question_answer->option_3))
         <li class="option3 {{$question_answer->answer2->answer==3?'correct_ans':(($selected_answer=='3' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},3, this)"><span>C</span>{!!html_entity_decode($question_answer->option_3)!!}
         
         @if($question_answer->answer2->answer==3)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
         </li>
         @endif
         
         @if(isset($question_answer->option_4))
           <li class="option4 {{$question_answer->answer2->answer==4?'correct_ans':(($selected_answer=='4' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},4, this)"><span>D</span>{!!html_entity_decode($question_answer->option_4)!!}
           
           @if($question_answer->answer2->answer==4)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
           </li>
        @endif
        
         @if(isset($question_answer->option_5))
           <li class="option5 {{$question_answer->answer2->answer==5?'correct_ans':(($selected_answer=='5' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},5, this)"><span>E</span>{!!html_entity_decode($question_answer->option_5)!!}
           
           @if($question_answer->answer2->answer==5)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
           </li>
        @endif
        
    <li class="correct_ans solution-container" >
        <div class="correct_ans_content">
            <h5>Solution</h5>
            <p>{!!html_entity_decode($question_answer->reason)!!}</p>
        </div>
     </li>
      </ul>
      

    </div>
    </div>
                
                @endforeach
                
                
                
                </div>
                
                <div class="col-md-3">
                <div class="filter afq_filter"> 
    <h4 class="qset_head">Filters</h4>
    <div class="text-left" style="width: 200px">
        
            
        <div class="checkbox_container">
        <h5>By Concept Type</h5>
        
          
          <div class="material-checkbox">
              <input type="checkbox" name="checkbox" class="filter-checkbox" value="correct-answer" id="checkbox-correct">
            <label for="checkbox-correct">Correct</label>
          </div>
          <div class="material-checkbox">
              <input type="checkbox" name="checkbox" class="filter-checkbox" value="wrong-answer" id="checkbox-wrong">
            <label for="checkbox-wrong">Wrong</label>
          </div>
          <div class="material-checkbox">
              <input type="checkbox" name="checkbox" class="filter-checkbox" value="attempted-question" id="checkbox-attempted">
            <label for="checkbox-attempted">Attempted</label>
          </div>
        
          <div class="material-checkbox">
              <input type="checkbox" name="checkbox" class="filter-checkbox" value="unattempted-question" id="checkbox-unattempted">
            <label for="checkbox-unattempted">Unttempted</label>
          </div>
        
          
        </div>
          
        
        
      </div>
   </div>
                </div>
                    </div>
            </div>
</div>
@endsection

@section('footer')
<script>
    
    
    
  function disableF5(e){
      if(((e.which || e.keyCode) == 116) || (e.which || e.keyCode) == 82){
          e.preventDefault();
      }
  }
  

  $(function(){
      
        $(".filter-checkbox").click(function(){
        $(".afq_qsn_ans").hide();    
            $(".filter-checkbox:checked").each(function(index, obj){
                if($(this).prop('checked'))
                {
                    $("."+$(this).val()).show();
                }
         })
        if($(".filter-checkbox:checked").length==0)
        {
            $(".afq_qsn_ans").show();    
        }
    })
        {{--  prevent user from refershing page --}}
      $(document).on("keydown",disableF5);
      $("html").on("contextmenu", function(e){ return false;});
  })  
  
  </script>
@endsection

