@extends('layouts.app-dashboard')
<title>{{$arr_chapters[0]->subject->name}}</title>
@section('content')
<style>
    .ch_number{
            float: left;
    top: 5px;
    position: relative;
    padding: 10px;
    font-size: 25px;
    }
    </style>
<div class="main_dash_right">
    
    <div class="chaptr_outr">
    <div class="chapter_head">
        <span class="icon_outr"><i class="fa fa-cog" aria-hidden="true"></i></span>
        <h2>{{$arr_chapters[0]->subject->name}}
          <div id="progressbar" class="prog_change">
              <div></div>
          </div>
        </h2>
    </div>
      <!--<h3 class="h3_head">Resume where you left</h3>-->
<!--      <div class="chaptr_box">
        <span class="ch_number">01</span>
        <div class="chaptr_data">
          <h5>Physical World</h5>
          <div id="progressbar" class="prog_change">
              <div></div>
              <span>55%</span>
          </div>
          <p>0 / 1 completed</p>
        </div>
        <div class="arrow">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        </div>
        <div class="clearfix"></div>
      </div>-->
      <h4></h4>
      
      @foreach($arr_chapters as  $index=>$chapter)
      
      
      
      
       <div class="chaptr_box" onclick="javascript:window.location='{{url('user/learn/'.base64_encode($chapter->subject_id).'/topic/'.base64_encode($chapter->id))}}'">
        <span class="ch_number">{{($index+1)>9?($index+1):"0".($index+1) }}</span>
        <div class="chaptr_data">
          <h5>{{$chapter->name}}</h5>
          <div id="progressbar" class="prog_change">
              <div style="width:{{App\Modules\Learn\Models\QuestionReport::getChapterReport($chapter->id)}}% !important;"></div>
              <span>{{App\Modules\Learn\Models\QuestionReport::getChapterReport($chapter->id)}}%</span>
          </div>
          <!--<p>0 / 1 completed</p>-->
        </div>
        <div class="arrow">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        </div>
        <div class="clearfix"></div>
      </div>
      
      @endforeach
       
    </div>
 </div>
@endsection