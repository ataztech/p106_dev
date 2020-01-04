@extends('layouts.app-dashboard')
<title>My Syllabus</title>
@section('content')
                   
<div class="main_dash_right">
    <div class="syllabus_outer">
        <h4>My Syllabus</h4>
          <div class="syllabs_inner">
            <div class="media">
              <div class="media-left">
                <i class="fa fa-cubes"></i>
              </div>
              <div class="media-body">
                <h5>Class</h5>
                <p>{{Auth::user()->ConfigureSyllabus->class}}</p>
              </div>
            </div>
            <div class="media">
              <div class="media-left">
                <i class="fa fa-cubes"></i>
              </div>
              <div class="media-body">
                <h5>Stream</h5>
                <p>{{Auth::user()->ConfigureSyllabus->stream==1?'Science':''}}</p>
              </div>
            </div>
              @if(Auth::user()->ConfigureSyllabus->boardData)
            <div class="media">
              <div class="media-left">
                <i class="fa fa-cubes"></i>
              </div>
              <div class="media-body">
                <h5>Board</h5>
                <p>{{Auth::user()->ConfigureSyllabus->boardData->name}}</p>
              </div>
            </div>
              @endif
              
              @if(Auth::user()->ConfigureSyllabus->exam_flag)
            <div class="media">
              <div class="media-left">
                <i class="fa fa-cubes"></i>
              </div>
              <div class="media-body">
                <h5>Exams</h5>
                <p>@php 
                                                        $strExams="";
                                                        @endphp
                                                    @foreach(Auth::user()->competetiveExam as $index=>$exam)
                                                    @php
                                                    
                                                    $strExams.=$exam->exam->name.', '
                                                    @endphp
                                                    @endforeach
                                                    {{rtrim($strExams,', ')}}</p>
              </div>
            </div>
              @endif
            <div class="row syllabus_para">
              <div class="col-md-2 text-center">
                  <!--<i class="fa fa-lightbulb-o" aria-hidden="true"></i>-->
              </div>
              <div class="col-md-10">
<!--                <p> <span>Lorem Ipsum has been the industry's standard dummy text ever
                since the 1500s</span></p> -->
              </div>
            </div>
          </div>
          <div>
              <a type="button" href="javascript:void(0)" onclick="window.location='{{url('user/configure/class')}}'" class="btn_all text-center">Change Your Syllabus</a>
         </div>
           
      </div>
  </div>
@endsection