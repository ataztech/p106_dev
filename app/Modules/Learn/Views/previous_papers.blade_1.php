@extends('layouts.assess.app')

@section('content')

<style>
    .m-t-30 {
    margin-top: 20px!important;
}
h5 {
    line-height: 9px;
}
.alert-secondary{
    
    background-color: cornflowerblue ;
}
.alert{
        margin-bottom: 2rem;
}
.container-fluid {
    padding: 0 30px 25px;
    /*margin: auto 12%;*/
}
.card-content{
    cursor: pointer;
}
.nav-item .active {
        background-color: lightcoral !important;
}

.answer-option:hover{
   background-color: lightblue;
    cursor: pointer;
    border-top: darkblue;
    border-top-style: solid;
}

.answer-option.active{
   background-color: lightblue;
    cursor: pointer;
    border-top: darkblue;
    border-top-style: solid;
}

.wrong-answer{
        background-color: pink;
}

.wrong-answer .badge-answer{
        float: right;
        color:darkred;
}

.correct-answer{
        background-color: lightgreen;
}
.correct-answer .badge-answer {
        float: right;
        color:darkgreen;
}

.answers td{
    color:#000000;
}

.solution{
    
   background-color: lightgreen;
}
.solution p{
   color: #000000;;
}
.assess-btn{
    width:143px;
}
</style>

<div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Other Topics</li>
                        <li><div onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/easy')}}'">
                        <div class="card bg-success p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-bar-chart-alt f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    
                                    <p class="m-b-0">Top 10 Easy Questions</p>
                                </div>
                            </div>
                        </div>
                    </div></li>
                    <li>
                    <div  onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/medium')}}'">
                        <div class="card bg-warning p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-bar-chart-alt f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    
                                    <p class="m-b-0">Top 10 Medium Questions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    <li>
                    <div onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/hard')}}'">
                        <div class="card bg-danger p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-bar-chart-alt f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    
                                    <p class="m-b-0">Top 10 Hard Questions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                        <div class="" onclick="window.location='{{url('/user/learn/'.$subject_id.'/ncert/'.$chapter_id)}}'">
                        <div class="card bg-pink p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-bar-chart-alt f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    
                                    <p class="m-b-0">NCERT Solutions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>              
                    <li>
                                    <div  onclick="window.location='{{url('/user/learn/'.$subject_id.'/previous-papers/'.$chapter_id)}}'">
                        <div class="card bg-primary p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-bar-chart-alt f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    
                                    <p class="m-b-0">Previous Papers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
       <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Previous Papers</h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid" id="result">
                <!-- Start Page Content -->
                
                @foreach($question_answer as $qa)
                <div class="row" >
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-title">
                                
                                <h4>{!! html_entity_decode($qa->question->question)!!}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table answers">
                                      
                                        <tbody>

                                            <tr class="answer-option option1_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},1, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">1</span>
                                                </td>
                                                    <td colspan="4" style="text-align: left">{!!html_entity_decode($qa->question->option_1)!!}<span class="badge badge-answer"></span></td>
                                                
                                            </tr>
                                            <tr class="answer-option option2_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},2, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">2</span>
                                                </td>
                                                <td colspan="4" style="text-align: left">{!!html_entity_decode($qa->question->option_2)!!} <span class="badge badge-answer"></span></td>
                                                
                                            </tr>
                                            <tr class="answer-option option3_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},3, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">3</span>
                                                </td>
                                                <td colspan="4" style="text-align: left">{!!html_entity_decode($qa->question->option_3)!!} <span class="badge badge-answer"></span></td>
                                                
                                            </tr>
                                            <tr class="answer-option option4_{{$qa->question->id}}" onclick="checkAnswer({{$qa->question->id}},4, this)">
                                                <td style="width: 10px;">
                                                    <span class="badge badge-dark">4</span>
                                                </td>
                                                <td colspan="4" style="text-align: left">{!!html_entity_decode($qa->question->option_4)!!} <span class="badge badge-answer"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="card-content solution-container" style="display:none" id="solution_{{$qa->question->id}}">
                                    <div class="alert alert-success solution">
                                        <h4 class="alert-heading">Solution</h4>
                                        <p>
                                            {!!html_entity_decode($qa->question->reason)!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                       
                    </div>
                    
                </div>

                @endforeach


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
            <!-- End footer -->
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
        
//        if(!answerFlag)
//        return;
//        answerFlag = false;
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
                     $(ele).addClass("correct-answer");
                     $(".option"+res.answer+"_"+questionId+" .badge-answer").text('Correct Answer');     
                    }else{
                    $(ele).addClass('wrong-answer');    
                    
                    $(".option"+res.answer+"_"+questionId).addClass('correct-answer'); 
                     $(".option"+res.answer+"_"+questionId+" .badge-answer").text('Correct Answer');     
                    }
                    
                    $("#solution_"+questionId).show();
        
                }});
    }
    
    </script>
@endsection

