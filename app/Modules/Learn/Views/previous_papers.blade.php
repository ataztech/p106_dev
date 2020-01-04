@extends('layouts.app-dashboard')

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
          <li onclick="window.location='{{url('/user/learn/'.$subject_id.'/previous-papers/'.$chapter_id)}}'">
            <div class="media">
              <div class="media-body">Previous Papers</div>
              <!--<div class="media-right"><img src="{{url('public/theme1/images/circle_progrss.png')}}"></div>-->
            </div>
          </li>
</ul>
</div>


<div class="main_dash_right purple_color" >
    
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{url('/user/learn/'.Request::segment(3))}}" >{{$chapter_data->subject->name}}</a></li>
  <li class="breadcrumb-item"><a href="{{url('/user/learn/'.Request::segment(3).'/topic/'.Request::segment(5))}}">{{$chapter_data->name}}</a></li>
  <li class="breadcrumb-item active" id="current-tab">Previous Papers</li>
</ol>
<div  id="result">
    
  @foreach($question_answer as $index=>$qa)  
    <div class="qsn_ans">
    <div class="question">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-1"> 
            <div class="qsn_number">
                <span > {{$index+1}} </span>
            </div>
          </div>
          <div class="col-md-11">
            {!! html_entity_decode($qa->question->question)!!}
          </div>
        </div>
      </div>
    </div>
    <div class="answer">
      <ul>
          <li class="option1_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},1, this)"><span>A</span>{!!html_entity_decode($qa->question->option_1)!!}</li>
         <li class="option2_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},2, this)"><span>B</span>{!!html_entity_decode($qa->question->option_2)!!}</li>
         <li class="option3_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},3, this)"><span>C</span>{!!html_entity_decode($qa->question->option_3)!!}</li>
         <li class="option4_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},4, this)"><span>D</span>{!!html_entity_decode($qa->question->option_4)!!}</li>
          
           <li id="solution_{{$qa->question->id}}" class="correct_ans solution-container" style='display:none'>
               <div class="correct_ans_content">
            <h5>Solution</h5>
            <p>{!!html_entity_decode($qa->question->reason)!!}</p>

            
          </div>
           </li>
      </ul>

    </div>
    </div>
  @endforeach
    
 </div>
</div>
@endsection

@section('footer')
<script>
    
     var answerFlag = true;
     var index = 0;
    $(function(){
//       $(".answer-option").click(function(){
////           $(".answer-option").removeClass('active');
////           $(this).addClass('active');
//       }) 
    });
    
    
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
        var url = '{{url('topic/test/get-answer')}}';
        
         $.ajax({
                url: url,
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
                        
                        $(ele).find('.correct_ans_content').remove();
                        $(ele).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>')
                    }else{
                        console.log(ele);
                        $(ele).find('.wrong_txt').remove();
                        $(ele).addClass('wrong_ans');    
                        $(ele).append('<div class="wrong_txt">Wrong Answer</div>');     
                        $(".option"+res.answer+"_"+questionId).addClass("correct_ans"); 
                        $(".option"+res.answer+"_"+questionId).find('.correct_ans_content').remove();
                        $(".option"+res.answer+"_"+questionId).append('<div class="correct_ans_content" ><div class="correct_txt">Correct Answer</div></div>');
                    }
                    
                    $("#solution_"+questionId).show();
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
    
    </script>
@endsection

