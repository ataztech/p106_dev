
@php

$question_answer = $question_answer[$index];
@endphp


@if(isset($question_answer))    
    <div class="qsn_ans">        
        <div class="question">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-1"> 
                <div class="qsn_number">
                    <span class="af_question_number"> 1 </span>
                </div>
              </div>
              <div class="col-md-11">
                {!! str_replace("undefined","",html_entity_decode($question_answer->question))!!}
              </div>
            </div>
          </div>
        </div>
        
    <div class="answer">
      <ul>
          @if(isset($question_answer->option_1))
          <li class="option1" onclick="checkAnswer({{$question_answer->id}},1, this)"><span>A</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_1))!!}</li>
          @endif
          
          @if(isset($question_answer->option_2))
            <li class="option2" onclick="checkAnswer({{$question_answer->id}},2, this)"><span>B</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_2))!!}</li>
         @endif
         
         @if(isset($question_answer->option_3))
         <li class="option3" onclick="checkAnswer({{$question_answer->id}},3, this)"><span>C</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_3))!!}</li>
         @endif
         
         @if(isset($question_answer->option_4))
           <li class="option4" onclick="checkAnswer({{$question_answer->id}},4, this)"><span>D</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_4))!!}</li>
        @endif
        
         @if(isset($question_answer->option_5))
           <li class="option5" onclick="checkAnswer({{$question_answer->id}},5, this)"><span>E</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_5))!!}</li>
        @endif
        

      </ul>
    </div>
  </div>
    <div class="text-center">
        
        
      <button class="btn_all next-btn" style="display:none" onclick="skipQuestion()">Next</button>
      <button  onclick="skipQuestion()" class="skip_btn btn_all skip-btn">Skip This Question</button>
      <button style="display:none" onclick="pauseSession()" class="skip_btn btn_all finish-btn">Finish</button>                  
    </div>
    @else
    <h1>No Record Found.</h1>
    @endif
    
 





@if(isset($question_answer))
<script>
    
    setActiveQuestion({{$question_answer->id}});
    
        index = $(".afq_active_question").data('index')
    @if($selectedAnswer)
    
    
        if(isLastQuestion(index))
          {
                        $(".next-btn").hide();
                        $(".skip-btn").hide();
                        $(".finish-btn").show();
                    }else{
        $(".next-btn").show();
        $(".skip-btn").hide();
    }
        $(".option{{$selectedAnswer->selected_answer}}").addClass('correct_ans')
        
@else
    
if(isLastQuestion(index))
          {
                        $(".next-btn").hide();
                        $(".skip-btn").hide();
                        $(".finish-btn").show();
                    }
@endif
    </script>
    @endif

