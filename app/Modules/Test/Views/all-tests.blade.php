@extends('layouts.app-dashboard')
<title>Tests</title>
@section('content')

<style>
    .paper_outer{
        width: 82%;
    }
    .afq_text_outer
    {
        background: #9575cd;
    width: 42%;
    /* margin: 6%; */
    position: relative;
    left: 29%;
    padding: 2%;
    color: #ffff;
    }
    </style>



<div class="main_dash_right">
    <div class="paper_outer">
      <div class="paper_block">
        <h3 class="h3_head">Test Series</h3>
        <p class="sub_para">
            All-India tests to help you monitor your progress, and gauge how well prepared you are for D-day. Compete with students from all over the country and compare your scores to find out where you stand.</p>
        <div class="row">
            
            
            @if(count($all_exam)>0)
            
            
            @foreach($all_exam as $key=>$exam)
            
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="text_outr " style="min-height:10px;">
                    <div class="qset_icon bg_purple">
                        <!--<i class="fa fa-book" aria-hidden="true"></i>-->
                        <img width="30px" height="30px" src="{{url('storage/app/public/exam/'.$exam->image)}}" />
                    </div>
                    <div class="text_data">
                        <h3>{{$exam->name}}</h3>
                        <p>{{$exam->exam_full_form}}</p>
                        <h5 style="background:#9575cd" class="afq_text_outer">{{count($exam->getAllTest)}} Tests</h5>
                        <a href="{{url('tools/test-series/'.base64_encode($exam->id))}}" class="btn_all">View All Exam</a>
                    </div>
                </div>
          </div>
          
            @endforeach
            
            @else
            
            
            @foreach($userExams as $key=>$obj)
            
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="text_outr " style="min-height:10px;">
                    <div class="qset_icon bg_purple">
                        <!--<i class="fa fa-book" aria-hidden="true"></i>-->
                        <img width="30px" height="30px" src="{{url('storage/app/public/exam/'.$obj->exam->image)}}" />
                    </div>
                    <div class="text_data">
                        <h3>{{$obj->exam->name}}</h3>
                        <p>{{$obj->exam->exam_full_form}}</p>
                        <h5 style="background:#9575cd" class="afq_text_outer">{{count($obj->exam->getAllTest)}} Tests</h5>
                        <a href="{{url('tools/test-series/'.base64_encode($obj->exam->id))}}" class="btn_all">View All Exam</a>
                    </div>
                </div>
          </div>
          
            @endforeach
            @endif

        </div>
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

