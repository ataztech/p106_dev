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
                    <h3 class="text-primary">NCERT Solutions</h3> </div>
             
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid" id="result">
                <!-- Start Page Content -->
                <div class="row" >
                    <div class="col-lg-9">
                        @foreach($question_answer as $qa)
                        <div class="card">
                            <div class="card-title">
                                
                                <h4>{!! html_entity_decode($qa->question)!!}</h4>
                            </div>
                            
                            <div class="card solution-container" id="solution_{{$qa->id}}" style="display:none">
                            <div class="card-body">
                                
                                <div class="card-content">
                                    <div class="alert alert-success solution">
                                        <h4 class="alert-heading">Solution</h4>
                                        <p>
                                            {!!html_entity_decode($qa->solution)!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <button type="button" class="btn btn-primary btn-block m-b-10" onclick="showSolution(this, {{$qa->id}})">Check Solution</button>
                        </div>
                        
                        
                        @endforeach
                       
                    </div>
                    
                </div>

                


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
    
    
    
    function showSolution(ele, id)
    {
        $("#solution_"+id).show();
        $(ele).hide();
    }
    
    
    </script>
@endsection

