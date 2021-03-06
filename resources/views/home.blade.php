@extends('layouts.app-dashboard')

<title>Dashboard</title>

@section('content')


<style>
    .sub{
       cursor: pointer; 
    }
</style>



<div class="main_dash_right">

    

 <h2>Hello {{ucwords(Auth::user()->name)}},</h2>

 <h4>What would you like to learn today?</h4>
 

 <div class="container-fluid">

    <div class="row">

       @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[0])) 

       <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='{{url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id))}}'">

            <div class="sub dash_colr1">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    {{Auth::user()->ConfigureSyllabus->standard->subjects[0]->name}}

                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">
                          <img width="40px" height="46px" src="{{url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[0]->name.'.jpg')}}">
                      </div>

                  </div>

              </div>

              <h4 class="text-center">{{Auth::user()->ConfigureSyllabus->standard->subjects[0]->name}}</h4>

              <div id="progressbar">

                  <div style="width:{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)}}% !important;"></div>

                <span>{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)}}%</span>

              </div>

              <p>

                  

                  <!--<i class="fa fa-video-camera" aria-hidden="true"></i><span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)['videos']}}</span> Videos-->  

                  

                  

                  

                  <span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)['topics']}}</span> Practice</p>

            </div>

        </div>

        @endif

        @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[1])) 

         <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='{{url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id))}}'">

             <div class="sub dash_colr2">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    {{Auth::user()->ConfigureSyllabus->standard->subjects[1]->name }}

                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">

                        <img width="40px" height="46px" src="{{url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[1]->name.'.jpg')}}">

                      </div>

                  </div>

              </div>

              <h4 class="text-center">{{Auth::user()->ConfigureSyllabus->standard->subjects[1]->name }}</h4>

              <div id="progressbar">

                <div style="width:{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)}}% !important;"></div>

                <span>{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)}}%</span>

              </div>

              <p>

                  

<!--                  <i class="fa fa-video-camera" aria-hidden="true"></i><span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)['videos']}}</span> Videos  -->

                  

                  

                  <span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)['topics']}}</span> Practice</p>

            </div>

        </div>

        @endif

        @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[2]))

        <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='{{url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id))}}'">

            <div class="sub dash_colr3">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    {{Auth::user()->ConfigureSyllabus->standard->subjects[2]->name }}

                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">

                        <img width="40px" height="46px" src="{{url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[2]->name.'.jpg')}}">

                      </div>

                  </div>

              </div>

              <h4 class="text-center">{{Auth::user()->ConfigureSyllabus->standard->subjects[2]->name}}</h4>

              <div id="progressbar">

                <div style="width:{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)}}% !important;"></div>

                <span>{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)}}%</span>

              </div>

              <p>

<!--                  <i class="fa fa-video-camera" aria-hidden="true"></i><span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)['videos']}}</span> Videos  -->

                  

                  <span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)['topics']}}</span> Practice</p>

            </div>

        </div>

        @endif

        @if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[3]) && Auth::user()->mobile!='9822982298')

        <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='{{url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id))}}'">

             <div class="sub dash_colr4">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    {{Auth::user()->ConfigureSyllabus->standard->subjects[3]->name}}

                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">

                        <img width="40px" height="46px" src="{{url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[3]->name.'.jpg')}}">

                      </div>

                  </div>

              </div>

              <h4 class="text-center">{{Auth::user()->ConfigureSyllabus->standard->subjects[3]->name}}</h4>

              <div id="progressbar">

                <div style="width:{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id)}}% !important;"></div>

                <span>{{App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id)}}%</span>

              </div>

              <p>

<!--                  <i class="fa fa-video-camera" aria-hidden="true"></i><span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id)['videos']}}</span> Videos  -->

                  <span>{{App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(4)['topics']}}</span> Practice</p>

            </div>

        </div>

        @endif

    </div>

  </div>

 </div>



@endsection
@section('footer')
    <script>

        $(function () {
            
        });


    </script>
    @endsection