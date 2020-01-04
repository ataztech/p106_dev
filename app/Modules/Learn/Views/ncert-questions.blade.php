@extends('layouts.app-dashboard')
<title>NCERT Solutions</title>
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
<div class="main_dash_right purple_color">
    <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{url('/user/learn/'.Request::segment(3))}}" >{{$chapter_data->subject->name}}</a></li>
  <li class="breadcrumb-item"><a href="{{url('/user/learn/'.Request::segment(3).'/topic/'.Request::segment(5))}}">{{$chapter_data->name}}</a></li>
  <li class="breadcrumb-item active" id="current-tab">NCERT Solutions</li>
</ol>
    
    
    <div class="question">
        
    </div>
    @foreach($question_answer as $index=>$qa)
    
    
    
    @if($qa->type == '2')
    <iframe src="{{url('public/media/ncrt/'.$qa->solution)}}"
                width="800px" height="600px" ></iframe>
    @else
    <div class="qsn_ans">
        <div class="qsn_bookmark">
          <ul>
            <li>
              <a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
        <div class="question">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-1"> 
                <div class="qsn_number">
                  <span> {{$index+1}} </span>
                </div>
              </div>
              <div class="col-md-11">
                {!! html_entity_decode($qa->question)!!}
              </div>
            </div>
          </div>
        </div>
        <div class="answer" id="solution_{{$qa->id}}" style="display:none">
          <ul>
             <li class="correct_ans">
              <div class="correct_ans_content">
                <h5><b>Solution</b></h5>
                <p>{!!html_entity_decode($qa->solution)!!}</p>
<!--                <div class="reload_btns">
                   <ul>
                     <li><a href="#"><i class="fa fa-repeat" aria-hidden="true"></i>Revise Concept</a></li>
                   </ul>
                </div>-->
              </div>
             </li>
          </ul>
    </div>
    <button type="button" class="btn btn-primary btn-block m-b-10" onclick="showSolution(this, {{$qa->id}})">Check Solution</button>
    </div>
    @endif
     @endforeach

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
    
    
    
    function showSolution(ele, id)
    {
        $("#solution_"+id).show();
        $(ele).hide();
    }
    
    
    </script>
@endsection

