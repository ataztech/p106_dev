@extends('layouts.app-dashboard')
<title>Practice</title>
@section('content')

<style>
    .fa_active{
        font-size: 18px;
        color: #31708f !important;
    }
    
    .timer-container{
        font-size: 30px;
    text-align: center;
    position: relative;
    left: -15%;
    font-family: cursive;
    }
    
    .answer ul li.wrong_ans{
        background:#ffffff !important; 
    }
    .correct_ans_content span{
        background: #ffffff !important;
        width:100% !important;
        border-radius:0% !important;
        color:#000000 !important;
        
    }
    .correct_ans{
        background:#ffffff !important; 
    }
     .MathJax_Display {
            text-align: left!important;
            margin: 0em 0.2em!important;
            display: inline-block!important;
            width: auto!important;
        }

        .answer ul li{
            cursor: pointer;
            
        }
        .left_sec ul li{
            cursor: pointer;
            
        }
        
        
    </style>






<div class="left_sec content topic_list">
        <ul>
          <h5>Other Topics</h5>
      @foreach($arr_topics as  $index=>$topic)
          <li onclick="leaveSession('{{url('user/learn/'.base64_encode($chapter_data->subject_id).'/topic/'.base64_encode($topic->chapter_id).'/test/'.base64_encode($topic->id))}}', )" >
            <div class="media">
              <div class="media-left">{{($index+1)>9?($index+1):"0".($index+1) }}</div>
              <div class="media-body">{{$topic->name}}
              <p><span>0%</span> Completed</p></div>
              <div class="media-right">
                  <!--<img src="{{url('public/theme1/images/circle_progrss.png')}}">-->
              </div>
            </div>
          </li>
          @endforeach
          
        </ul>
</div>


<div class="main_dash_right purple_color" id="result">
    @if(isset($question_answer))
    
<!--    <div class="timer-container">
    <label id="minutes">00</label>:<label id="seconds">00</label>
    </div>-->
    <div class="timer-container" style="
     margin-top: 47px; 
">
    <label id="minutes">04</label>:<label id="seconds">35</label>
    </div>
<div class="qsn_ans" style="">
     
   <div class="qsn_bookmark">
      
      <ul>
        <li>
            <a href="javascript:void(0)" title="Bookmark" ><i class="fa fa-bookmark {{$question_answer->bookmark?'fa_active':''}}" aria-hidden="true" onclick="bookMarkQuestion({{$question_answer->id}}, this)"></i></a>
        </li>
        <li>
            <a href='javascript:void(0)' onclick="pauseSession()" ><i class="fa fa-pause" style="color: #42d684 !important; "></i></a>
        </li>
      </ul>
    </div>     
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
      <button  onclick="skipQuestion({{$question_answer->id}})" class="skip_btn btn_all skip-btn">Skip This Question</button>
      <button style="display:none" onclick="redirectToReport()" class="skip_btn btn_all finish-btn">Finish</button>                  
    </div>
    @else
    <h1>No Record Found.</h1>
    @endif
    
    <div>
        <form action="" id="report-container">
            1. Wrong Answer <input type="checkbox" id="wrong_answer" name="wrong_answer" value="1" > <br>
            2. No Solutions <input type="checkbox" id="no_solution" name="no_solution"  value="1" > <br>
            3. No Img <input type="checkbox" id="no_img" name="no_img" value="1" > <br>
            <input type="hidden" id="hidden_id" name="hidden_id" value="{{$question_answer->id}}" value="1"> <br>
            <button type="button" id='btn-submit' onclick="sendData()">Submit</button>
        </form>
        
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
    
(function (global) { 

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {            
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }

})(window);

     var answerFlag = true;
     var question_counter=1;
     var index = 0;
   
    
    function redirectToReport(){
        window.location='{{url('/topic/test/get-report/'.Request::segment(7).'/'.Request::segment(5))}}';
    }
    
    function isLastQuestion(){
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
  
  

  
function sendData()
{
          $.ajax({
                    url: "{{url('examiner/topic/test/send-report')}}",
                    method: 'GET',
                    data: {
                        question_id : $("#hidden_id").val(),
                        wrong_answer: $("#wrong_answer").prop('checked'),
                        no_solution : $("#no_solution").prop('checked'),
                             no_img : $("#no_img").prop('checked'),
                         chapter_id  : '{{Request::segment(6)}}',
                    },
                    success: function(response){
                        $("#report-container").html("");   
                    }
                });
            }
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
      window.location = '{{url("user/learn/".Request::segment(3)."/topic/".Request::segment(5))}}';
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
                url: "{{url('topic/test/ajax-puase-get-report')}}",
                method:'GET',
                data:{
                    topic_id : '{{Request::segment(7)}}',
                    chapter_id : '{{Request::segment(5)}}',
                },
                success: function(response){
                    $("#report-result").html(response);   
                }
            });
  }
  
  function leaveSession(url)
  {
      timer.stop();
      $('#puase_report').modal('show');
      $.ajax({
                url: "{{url('topic/test/ajax-puase-get-report')}}",
                method:'GET',
                data:{
                    topic_id : '{{Request::segment(7)}}',
                    chapter_id : '{{Request::segment(5)}}',
                    url : url,
                },
                success: function(response){
                    $("#report-result").html(response);   
                }
            });
  }
    function checkAnswer(questionId, selectedOption, ele){
        if(!answerFlag)
        return;
        answerFlag = false;
         $.ajax({
                url: "{{url('topic/test/get-answer')}}",
                method:'GET',
                type:'json',
                data:{
                    questionId : questionId,
                    selectedOption : selectedOption,
                    
                },
                success: function(response){
                    
                    var topic_id = '{{$question_answer->topic_id}}';
                    
                    res = JSON.parse(response).result;
                    if(parseInt(res.answer) == parseInt(selectedOption))
                    {
                        submitReport(topic_id, questionId, 1);
                        $(ele).addClass("correct_ans");
                        $(ele).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>')
                    }else{
                        $(ele).addClass('wrong_ans');    
                        $(ele).append('<div class="wrong_txt">Wrong Answer</div>');                    
                        $(".option"+res.answer).addClass("correct_ans"); 
                        $(".option"+res.answer).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>');
                        submitReport(topic_id, questionId, 0);
                    }
                    
                    $(".solution-container").show();
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
    
    
    function skipQuestion(questionId){
        if(!answerFlag)
        return;
        answerFlag = false;
         $.ajax({
                url: "{{url('topic/test/get-answer')}}",
                method: 'GET',
                type: 'json',
                data: {
                    questionId : questionId,
                },
                success: function(response){
                    var topic_id = '{{$question_answer->topic_id}}';
                    
                        res = JSON.parse(response).result;
                        submitReport(topic_id, questionId, 2);
                        $('.option'+res.answer).addClass("correct_ans");
                        $('.option'+res.answer).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>')
                    
                    $(".solution-container").show();
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
    function nextQuestion(){
        timer.reset();
        timer.start();
         $.ajax({
                url: "{{url('examiner/topic/test/next-question')}}",
                method:'GET',
                data:{
                    index : index,
                    topic_id:{{$question_answer->topic_id}},
                    chapter_id : '{{$chapter_id}}',
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
    
    function skipQuestion1(questionId){
         index+=1;
         $.ajax({
                url: "{{url('examiner/topic/test/next-question')}}",
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
                    chapter_id : '{{$chapter_id}}',
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
  secondsLabel.innerHTML = pad(totalSeconds % 60);
  minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}, 1000);

function bookMarkQuestion(question_id, ele)
{
    
    var status = 1
    if($(ele).hasClass('fa_active'))
    {
        status = 2;
        $(ele).removeClass('fa_active');
    }
    
    $.ajax({
                url: "{{url('bookmark/question')}}",
                method:'GET',
                type:'json',
                synch: false,
                data:{
                    question_id : question_id,
                    subject_id : {{$chapter_data->subject_id}},
                    status: status
                },
                success: function(response){
                    if(status==1)
                    {
                        $(ele).addClass('fa_active');
                    }
                }});
        
}
    </script>
    @endif
@endsection

