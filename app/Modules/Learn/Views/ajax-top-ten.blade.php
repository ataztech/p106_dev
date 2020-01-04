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
          <li class="option1" onclick="checkAnswer({{$question_answer->id}},1, this)"><span>A</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_1))!!}</li>
         <li class="option2" onclick="checkAnswer({{$question_answer->id}},2, this)"><span>B</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_2))!!}
             
         </li>
          <li class="option3" onclick="checkAnswer({{$question_answer->id}},3, this)"><span>C</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_3))!!}
         
          </li>
          <li class="option4" onclick="checkAnswer({{$question_answer->id}},4, this)"><span>D</span>{!!str_replace("undefined","",html_entity_decode($question_answer->option_4))!!}</li>
           <li class="correct_ans solution-container" style='display:none'>
               <div class="correct_ans_content">
            <h5>Solution</h5>
            <p>{!!str_replace("undefined","",html_entity_decode($question_answer->reason))!!}</p>

            
          </div>
           </li>
      </ul>


    </div>
    </div>
    <div class="text-center">
      <button class="btn_all next-btn" style="display:none" onclick="nextQuestion()">Next</button>
      <button  onclick="skipQuestion()" class="skip_btn btn_all skip-btn">Skip This Question</button>
      <button style="display:none" onclick="redirectToMainPage()" class="skip_btn btn_all finish-btn">Finish</button>                  
    </div>