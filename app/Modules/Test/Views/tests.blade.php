@extends('layouts.app-dashboard')
<title>Tests</title>
@section('content')





<div class="main_dash_right">
   <div class="text_set">
   <h2 class="h3_head">Tests</h2>
   
      <div class="row">
          
           <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="text_outr">
                <div class="qset_icon bg_purple">
                  <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <div class="text_data">
                <h3>Test Series</h3>
                <p>All-India tests to help you monitor your progress, and know how well prepared you are for the exam.</p>
                <div class="media">
                  <div class="media-left">
                    <b>12</b>
                    <span>Oct</span>
                  </div>
                  <div class="media-body">
                  <b>AAM Main</b>
                  <p>Post Test-09</p>
                  </div>
<!--                  <div class="media-right"><a href="#">New<i class="fa fa-angle-right"></i></a>
                  </div>-->
                </div>
                <div class="media">
                  <div class="media-left">
                    <b>12</b>
                    <span>Oct</span>
                  </div>
                  <div class="media-body">
                  <b>AAM Main</b>
                  <p>Post Test-09</p>
                  </div>
<!--                  <div class="media-right"><a href="#">New<i class="fa fa-angle-right"></i></a></div>-->
                </div>
                <a href="{{url('tools/tests/all')}}" class="btn_all">View All Exam</a>
                </div>
            </div>
          </div>
          
<!--          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="text_outr">
                <div class="qset_icon bg_blue">
                  <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <div class="text_data">
                <h3>Lorem ipsum</h3>
                <p>Increase your preparations by practicing previous years' papers up to the past 10 years.</p>
                <div class="media">
                  <div class="media-left">
                    <b>12</b>
                    <span>Oct</span>
                  </div>
                  <div class="media-body">
                  <b>AAM Main</b>
                  <p>Post Test-09</p>
                  </div>
                  <div class="media-right"><a href="#">New<i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
                <div class="media">
                  <div class="media-left">
                    <b>12</b>
                    <span>Oct</span>
                  </div>
                  <div class="media-body">
                  <b>AAM Main</b>
                  <p>Post Test-09</p>
                  </div>
                  <div class="media-right"><a href="#">New<i class="fa fa-angle-right"></i></a></div>
                </div>
                <a href="#" class="btn_all">Create Test</a>
                </div>
            </div>
          </div>-->
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
        {{--  prevent user from refershing page --}}
      $(document).on("keydown",disableF5);
      $("html").on("contextmenu", function(e){ return false;});
  })  
  
  
    
    </script>
@endsection

