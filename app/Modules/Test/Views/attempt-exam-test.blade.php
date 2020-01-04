@extends('layouts.app-dashboard')
<title>{{$testData->exam_type}} {{$testData->name}}</title>
@section('content')
<style>
    .topic_list.left_sec ul{
        padding: 0 10px 0 20px !important;
    }
    .afq_active_question{
        background: cornflowerblue !important;
    }
    
    .afq_attempted .media-left:before{
        content:"\2713 ";
         color:greenyellow !important;
    }
    .timer-container{
        font-size: 30px;
    text-align: center;
    position: relative;
    left: -15%;
    font-family: cursive;
    }
    
    .pause-btn{
        

    float: right;
    margin-top: 8px;
    /* margin-right: 111px; */
    /* background: #c4d4d3; */
    width: 33px;
    padding: 9px;
    border-radius: pis;
    position: relative;
    left: -31%;
    z-index:99999;
    }
    
</style>
<div class="left_sec content topic_list" style="overflow: scroll; height:90%">
    <ul style=" ">
          <h5>{{$testData->exam_type}} {{$testData->name}}</h5>
          
          
          @php
          $used_subject_ids = [];
          @endphp
  @foreach($question_answer as  $index=>$qa)
      @foreach($all_test_subject_ids as  $objSubjectId)
  
  
  @if($objSubjectId == $qa->subject_id  && !in_array($qa->subject_id, $used_subject_ids))
          <h3 style="color:#ffffff">{{$qa->subject->name}}</h3>
          
          @php
            $used_subject_ids[] = $qa->subject_id;
          @endphp
     @endif
          @endforeach
          <li id="qa-{{$qa->id}}" onclick="getSelectedQuestion({{$index}})" class="other-question" data-index="{{$index}}">
            <div class="media">
              <div class="media-left">{{($index+1)>9?($index+1):"0".($index+1) }}</div>
              <div class="media-body">{!!str_replace("undefined","",html_entity_decode($qa->question))!!}
              </div>
              <div class="media-right">
                  <!--<img src="{{url('public/theme1/images/circle_progrss.png')}}">-->
              </div>
            </div>
          </li>
@endforeach
          
        </ul>
</div>
@php

$question_answer = $question_answer[0];
@endphp

<div class="main_dash_right purple_color" >
    @if(isset($question_answer))
    <a class="pause-btn" href='javascript:void(0)' onclick="pauseSession()" style="float: right; "><i class="fa fa-pause"></i></a>
    <div class="timer-container">
    <label id="minutes">00</label>:<label id="seconds">00</label>
    </div>
    <div id="result">
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
    </div>
 </div>

<div class="modal fade" id="puase_report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
         Test Summary<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
        <div class="modal-body clearfix" id="report-result">
      
        </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
@if(isset($question_answer))
<script>
    
     var answerFlag = true;
     var question_counter=1;
     var index = 0;
   
    
    function redirectToReport(){
        window.location='{{url('/topic/test/get-report/'.Request::segment(7).'/'.Request::segment(5))}}';
    }
    
    
    
    function isLastQuestion(index){
        
        return index == parseInt({{$total_question}})-1 ;
    }
    
  function disableF5(e){
      if(((e.which || e.keyCode) == 116) || (e.which || e.keyCode) == 82){
          e.preventDefault();
      }
  }
  

  $(function(){
        {{--  prevent user from refershing page --}}
      $(document).on("keydown",disableF5);
      $("html").on("contextmenu", function(e){ return false;});
  })  
  
  function showReport()
  {
      $.ajax({
                url: "{{url('topic/test/get-report')}}",
                method:'GET',
                data:{
                    topic_id : '{{Request::segment(7)}}',
                    chapter_id : '{{Request::segment(5)}}',
                },
                success: function(response){
                    $("#result").html(response);   
                }
            });
  }
  
  function endSession()
  {
      if(confirm("Are you sure to end this session?"))
      window.location='{{url('/exam/test/get-report/'.base64_encode($testData->id))}}';
  }
  
  function closeReportModal()
  {
      if(answerFlag)
      {
        timer.start()
      }
      $("#puase_report").modal('hide');
  }
  function pauseSession()
  {
      timer.stop();
      $('#puase_report').modal('show');
      $.ajax({
                url: "{{url('exam/test/ajax-puase-get-report')}}",
                method:'GET',
                data:{
                    test_id : '{{$testData->id}}',
                },
                success: function(response){
                    $("#report-result").html(response);   
                }
            });
  }
    function checkAnswer(questionId, selectedOption, ele){
        
        $(".answer li").removeClass();
                    $(ele).addClass("correct_ans");
                    $("#qa-"+questionId).addClass("afq_attempted");
                    $(".next-btn").show();
                    $(".skip-btn").hide();
                    index = $(".afq_active_question").data('index')
                    if(isLastQuestion(index))
                    {
                        $(".next-btn").hide();
                        $(".skip-btn").hide();
                        $(".finish-btn").show();
                    }
                    var test_id = '{{$testData->id}}';
         $.ajax({
                url: "{{url('exam/test/submit-answer')}}",
                method:'GET',
                type:'json',
                data:{
                    questionId : questionId,
                    selectedOption : selectedOption,
                    test_id: test_id
                    
                },
                success: function(response){
                    res = JSON.parse(response).result;
                    
                    
                    
                    
                }});
    }
    function skipQuestion1(){
        
        var index = $(".afq_active_question").data('index')
        if(!answerFlag)
        return;
        answerFlag = false;
         $.ajax({
                url: "{{url('topic/test/get-answer')}}",
                method:'GET',
                type:'json',
                data:{
                    questionId : questionId,
                },
                success: function(response){
                    var topic_id = '{{$question_answer->topic_id}}';
                    
                        res = JSON.parse(response).result;
                        submitReport(topic_id, questionId, 2);
                        $('.option'+res.answer).addClass("correct_ans");
                        $('.option'+res.answer).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>')
                    
                    
                    $(".next-btn").show();
                    $(".skip-btn").hide();
                    
                    if(isLastQuestion())
                    {
                        $(".next-btn").hide();
                        $(".skip-btn").hide();
                        $(".finish-btn").show();
                    }else{
                          index+=1;
                    }
                }});
    }
    function skipQuestion(){
        var index = $(".afq_active_question").data('index')
        $(".next-btn").hide();
        $(".skip-btn").show();
         $.ajax({
                url: "{{url('exam/test/next-question')}}",
                method:'GET',
                data:{
                    index : index+1,
                    test_id:{{$testData->id}},
                    
                },
                success: function(response){
                    $("#result").html(response);
                    answerFlag = true;                
                    $(".af_question_number").html(++question_counter);
                     $(".solution-container").hide();
                    
                }
            });
    }
    function getSelectedQuestion(index){
        if(isLastQuestion(index))
        {
                      $(".next-btn").hide();
                        $(".skip-btn").hide();
                        $(".finish-btn").show();    
        }else{
        $(".next-btn").hide();
        $(".skip-btn").show();
    }
        question_counter = index;
        
        
         $.ajax({
                url: "{{url('exam/test/next-question')}}",
                method:'GET',
                data:{
                    index : index,
                    test_id:{{$testData->id}},   
                },
                success: function(response){
                    $("#result").html(response);
                    answerFlag = true;                
                    $(".af_question_number").html(++question_counter);
                     $(".solution-container").hide(); 
                }
            });
    }
    function nextQuestion(){
        timer.reset();
        timer.start();
        
        $(".next-btn").hide();
                    $(".skip-btn").show();
         $.ajax({
                url: "{{url('topic/test/next-question')}}",
                method:'GET',
                data:{
                    index : index,
                    topic_id:{{$question_answer->topic_id}},
                    
                },
                success: function(response){
                    $("#result").html(response);
                    answerFlag = true;                
                    $(".af_question_number").html(++question_counter);
                     $(".solution-container").hide();
                    
                }
            });
    }
    
    function skipQuestion1(questionId){
         index+=1;
         $.ajax({
                url: "{{url('topic/test/next-question')}}",
                method:'GET',
                data:{
                    index : index,
                    topic_id:{{$question_answer->topic_id}}
                },
                success: function(response){
                    $("#result").html(response);
                    answerFlag = true;
                    $(".af_question_number").html(++question_counter);
                     $(".solution-container").hide();
                    $(".next-btn").hide();
                    $(".skip-btn").show();
                }
            });
    }
    
    function submitReport(topic_id, questionId, is_correct_ans)
    {
        timer.stop();
        var seconds = pad(totalSeconds % 60);
        var minutes = pad(parseInt(totalSeconds / 60))
         $.ajax({
                url: "{{url('submit/report/test')}}",
                method:'GET',
                type:'json',
                data:{
                    questionId : questionId,
                    topic_id : topic_id,
                    is_correct_ans : is_correct_ans,
                    
                    time_taken: totalSeconds,
                    
                },
                success: function(response){
                    
                }});
    }
    </script>
    <script>
    var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var totalSeconds = 0;
 var max_seconds = {{($testData->hour*60*60) + ($testData->min*60)}};
/*
setInterval(setTime, 1000);

function setTime() {
  ++totalSeconds;
  secondsLabel.innerHTML = pad(totalSeconds % 60);
  minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}

*/
function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}


function Timer(fn, t) {
    var timerObj = setInterval(fn, t);

    this.stop = function() {
        if (timerObj) {
            clearInterval(timerObj);
            timerObj = null;
        }
        return this;
    }

    // start timer using current settings (if it's not already running)
    this.start = function() {
        
        
        if (!timerObj) {
            this.stop();
            timerObj = setInterval(fn, t);
        }
        return this;
    }

    // start with new interval, stop current interval
    this.reset = function(newT) {
        totalSeconds = 0;
    }
}

var timer = new Timer(function() {
    ++totalSeconds;
    var final_second = max_seconds - (totalSeconds);
    
    if(final_second <=0)
    {
        timer.stop();
    }
  secondsLabel.innerHTML = pad(final_second % 60);
  minutesLabel.innerHTML = pad(parseInt(final_second / 60));
}, 1000);



$(function(){
    window.onbeforeunload = function() {
    return  "If you leave this page you will lose your unsaved changes." 
}
    setActiveQuestion({{$question_answer->id}});
});


function setActiveQuestion(id)
{
    $(".other-question").removeClass('afq_active_question');
    $("#qa-"+id).addClass('afq_active_question');
}


var dirty = false;




    </script>
    @endif
@endsection

