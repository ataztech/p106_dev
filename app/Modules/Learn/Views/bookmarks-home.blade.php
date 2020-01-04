@extends('layouts.app-dashboard')
<title>Bookmarks</title>
@section('content')


<style>
    h4.text-center{
       font-size: 34px;
    }
    p span, .sub p{
        font-size: 20px;
    }
    
    .sub{
        cursor: pointer;
    }
    </style>
<div class="main_dash_right">
    
 
 <h4>Bookmarks</h4>
 <div class="container-fluid">
    <div class="row">
       @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[0])) 
       <div class="col-md-5 col-sm-5 col-xs-12" onclick="window.location='{{url('tools/bookmarks/subject/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id))}}'">
            <div class="sub dash_colr1">
              <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Auth::user()->ConfigureSyllabus->standard->subjects[0]->name}}
                  </div>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="sub_img">
                        <img src="{{url('public/theme1/images/icon1.png')}}">
                      </div>
                  </div>
              </div>
                
              <h4 class="text-center">{{Auth::user()->ConfigureSyllabus->standard->subjects[0]->name}}</h4>
              <p>
                  <span>{{count(Auth::user()->bookmarks->where('type',1)->where('subject_id', Auth::user()->ConfigureSyllabus->standard->subjects[0]->id))}}</span> Questions &nbsp;&nbsp;
                  <span>{{count(Auth::user()->bookmarks->where('type',3)->where('subject_id', Auth::user()->ConfigureSyllabus->standard->subjects[0]->id))}}</span> Concept &nbsp;&nbsp;
                  <!--<i class="fa fa-video-camera" aria-hidden="true"></i><span>0</span> Videos-->  
              </p>
            </div>
        </div>
        @endif
        @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[1])) 
         <div class="col-md-5 col-sm-5 col-xs-12" onclick="window.location='{{url('tools/bookmarks/subject/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id))}}'">
             <div class="sub dash_colr2">
              <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Auth::user()->ConfigureSyllabus->standard->subjects[1]->name }}
                  </div>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="sub_img">
                        <img src="{{url('public/theme1/images/icon1.png')}}">
                      </div>
                  </div>
              </div>
              <h4 class="text-center">{{Auth::user()->ConfigureSyllabus->standard->subjects[1]->name }}</h4>
              
              <p>
                  <span>{{count(Auth::user()->bookmarks->where('type',1)->where('subject_id', Auth::user()->ConfigureSyllabus->standard->subjects[1]->id))}}</span> Questions &nbsp;&nbsp;
                  <span>{{count(Auth::user()->bookmarks->where('type',3)->where('subject_id', Auth::user()->ConfigureSyllabus->standard->subjects[1]->id))}}</span> Concept &nbsp;&nbsp;
                  <!--<i class="fa fa-video-camera" aria-hidden="true"></i><span>0</span> Videos-->  
              </p>
            </div>
        </div>
        @endif
        @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[2]))
        <div class="col-md-5 col-sm-5 col-xs-12" onclick="window.location='{{url('tools/bookmarks/subject/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id))}}'">
            <div class="sub dash_colr3">
              <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Auth::user()->ConfigureSyllabus->standard->subjects[2]->name }}
                  </div>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="sub_img">
                        <img src="{{url('public/theme1/images/icon1.png')}}">
                      </div>
                  </div>
              </div>
              <h4 class="text-center">{{Auth::user()->ConfigureSyllabus->standard->subjects[2]->name}}</h4>
              
              <p>
                  <span>{{count(Auth::user()->bookmarks->where('type',1)->where('subject_id', Auth::user()->ConfigureSyllabus->standard->subjects[2]->id))}}</span> Questions &nbsp;&nbsp;
                  <span>{{count(Auth::user()->bookmarks->where('type',3)->where('subject_id', Auth::user()->ConfigureSyllabus->standard->subjects[2]->id))}}</span> Concept &nbsp;&nbsp;
                  <!--<i class="fa fa-video-camera" aria-hidden="true"></i><span>0</span> Videos-->  
              </p>
            </div>
        </div>
        @endif
        @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[3]))
        <div class="col-md-5 col-sm-5 col-xs-12" onclick="window.location='{{url('tools/bookmarks/subject/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id))}}'">
             <div class="sub dash_colr4">
              <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    {{Auth::user()->ConfigureSyllabus->standard->subjects[3]->name}}
                  </div>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="sub_img">
                        <img src="{{url('public/theme1/images/icon1.png')}}">
                      </div>
                  </div>
              </div>
                 <h4 class="text-center" >{{Auth::user()->ConfigureSyllabus->standard->subjects[3]->name}}</h4>
              
              <p>
                  <span>{{count(Auth::user()->bookmarks->where('type',1)->whereIn('subject_id', ['4','11']))}}</span> Questions &nbsp;&nbsp;
                  <span>{{count(Auth::user()->bookmarks->where('type',3)->where('subject_id', Auth::user()->ConfigureSyllabus->standard->subjects[3]->id))}}</span> Concept &nbsp;&nbsp;
                  <!--<i class="fa fa-video-camera" aria-hidden="true"></i><span>0</span> Videos-->  
              </p>
            </div>
        </div>
        @endif
    </div>
  </div>
 </div>

@endsection