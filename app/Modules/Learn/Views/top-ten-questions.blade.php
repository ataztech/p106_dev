@extends('layouts.app-dashboard')
<title>Top 10 {{ucfirst(Request::segment(7))}} Questions</title>
@section('content')



<div class="left_sec content topic_list">
        <ul>
          <h5>Top 10 {{ucfirst(Request::segment(7))}} Questions</h5>
          <li onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/easy')}}'">
            <div class="media">
              <div class="media-body">Top 10 Easy Questions</div>
              <!--<div class="media-right"><img src="{{url('public/theme1/images/circle_progrss.png')}}"></div>-->
            </div>
          </li>
          <li onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/medium')}}'">
            <div class="media">
              <div class="media-body">Top 10 Medium Questions</div>
              <!--<div class="media-right"><img src="{{url('public/theme1/images/circle_progrss.png')}}"></div>-->
            </div>
          </li>
          <li onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/hard')}}'">
            <div class="media">
              <div class="media-body">Top 10 Hard Questions</div>
              <!--<div class="media-right"><img src="{{url('public/theme1/images/circle_progrss.png')}}"></div>-->
            </div>
          </li>
          
          <li onclick="window.location='{{url('/user/learn/'.$subject_id.'/ncert/'.$chapter_id)}}'">
            <div class="media">
              <div class="media-body">NCERT Solutions</div>
              <!--<div class="media-right"><img src="{{url('public/theme1/images/circle_progrss.png')}}"></div>-->
            </div>
          </li>
<!--          <li onclick="window.location='{{url('/user/learn/'.$subject_id.'/previous-papers/'.$chapter_id)}}'">
            <div class="media">
              <div class="media-body">Previous Papers</div>
              <div class="media-right"><img src="{{url('public/theme1/images/circle_progrss.png')}}"></div>
            </div>
          </li>-->
</ul>
</div>
<div class="main_dash_right purple_color" >
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{url('/user/learn/'.base64_encode($chapter_data->subject->id))}}" >{{$chapter_data->subject->name}}</a></li>
  <li class="breadcrumb-item"><a href="{{url('/user/learn/'.base64_encode($chapter_data->subject->id).'/topic/'.base64_encode($chapter_data->id))}}">{{$chapter_data->name}}</a></li>
  <li class="breadcrumb-item active" id="current-tab">Top 10 {{ucfirst(Request::segment(7))}} Questions</li>
</ol>
<div  id="result">
    
    
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
    @else
    
    <h2>No Record Found.</h2>
    @endif
    <div class="text-center">
      <button class="btn_all next-btn" style="display:none" onclick="nextQuestion()">Next</button>
      <button style="display:none" onclick="skipQuestion()" class="skip_btn btn_all skip-btn">Skip This Question</button>
      <button style="display:none" onclick="redirectToMainPage()" class="skip_btn btn_all finish-btn">Finish</button>                  
    </div>
 </div>
</div>
@endsection

@section('footer')
<script>
    
     var answerFlag = true;
     var question_counter=1;
     var index = 0;
    $(function(){
//       $(".answer-option").click(function(){
////           $(".answer-option").removeClass('active');
////           $(this).addClass('active');
//       }) 
    });
    function redirectToMainPage(){
        window.location="{{url('user/learn/'.Request::segment(3).'/topic/'.Request::segment(5))}}";
    }
    
    function isLastQuestion(){
        return index == 9 ;
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
                    
                    res = JSON.parse(response).result;
                    
                    
                    if(parseInt(res.answer) == parseInt(selectedOption))
                    {
                        
                     $(ele).addClass("correct_ans");
                    $(ele).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>')


                    
                    
                    }else{
                    $(ele).addClass('wrong_ans');    
                    $(ele).append('<div class="wrong_txt">Wrong Answer</div>')
                    
                    $(".option"+res.answer).addClass("correct_ans"); 
                     $(".option"+res.answer).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>');     
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
    function nextQuestion(){
         $.ajax({
                url: "{{url('topic/top-ten/next-question/'.$level.'/'.$chapter_id)}}",
                method:'GET',
                data:{
                    index : index,
                   
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
    
    function skipQuestion(){
        
         index+=1;
         $.ajax({
                url: "{{url('topic/top-ten/next-question/'.$level.'/'.$chapter_id)}}",
                method:'GET',
                data:{
                    index : index,
                },
                success: function(response){
                    $("#result").html(response);
                    answerFlag = true;
                    $(".af_question_number").html(++question_counter);
                    $(".solution-container").hide();
                    $(".next-btn").hide();
                    $(".skip-btn").show();
                    
                    if(isLastQuestion())
                    {
                        $(".next-btn").hide();
                        $(".skip-btn").hide();
                        $(".finish-btn").show();
                    }else{
                          
                    }
                }
            });
    }
    </script>
@endsection

