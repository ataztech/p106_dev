@extends('layouts.app-dashboard')

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
</style>
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Learn</li>
                        <li class="breadcrumb-item active">Physics</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-lg-12">
  <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$chapter_data->name}}</h4>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Topics</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Videos</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#question-sets" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Questions Sets</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#concepts" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Concepts</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="col-lg-9">
                        <div class="">
                            <br>
                            <div class="card-body">
                            @foreach($arr_topics as  $index=>$topic)
                            
                            
                                <div class="card-content" onclick="javascript:window.location='{{url('user/learn/'.base64_encode($chapter_data->subject_id).'/topic/'.base64_encode($topic->chapter_id).'/test/'.base64_encode($topic->id))}}'">
                                    <div class="alert alert-secondary">
                                        <h2><big><big>{{($index+1)>9?($index+1):"0".($index+1) }}</big></big></span> {{$topic->name}}</h2>
                                         <div class="col-md-9">
                                        <h5 class="m-t-30"> <span class="pull-right">&nbsp;&nbsp;65%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger wow animated progress-animated" style="width: 65%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                              @endforeach
                            </div>
                        </div>
                    </div>
                                    </div>
                                        <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                                 <div class="col-lg-9">
                        <div class="">
                            <br>
                            <div class="card-body">
                            @foreach($arr_video_topics as $index=>$topic)
                
                
                <div class="row">
                    <h3>{{$topic->name}}<span>Total Videos({{count($topic->videos)}})</span></h3>
					<div class="col-lg-12">
                    @if(count($topic->videos)>0)
                    
                    
                        <div class="card bg-dark">
                            <div class="testimonial-widget-one p-17">
                                <div class="testimonial-widget-one-{{$index}} owl-carousel owl-theme">
                    @foreach($topic->videos as $video)
                    
                    
                    <div class="item" >
                                        <div class="testimonial-content" onclick="location.href='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/video/'.base64_encode($video->topic_id).'/'.base64_encode($video->id))}}'">
                                            <img class="testimonial-author-img" src="{{url('public/theme1/images/avatar/2.jpg')}}" alt="" />
                                            <div class="testimonial-author">{{$video->id}}</div>
                                            <div class="testimonial-author-position">{{$video->name}}</div>

                                            <div class="testimonial-text">
                                                image goes here {{$index}}
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                    
                </div>
                            
                            
                    @endforeach
                    
                            </div>
                        </div>
                    </div>
                                        </div>
<div class="tab-pane p-20" id="question-sets" role="tabpanel">
    <div class="row bg-white m-l-0 m-r-0 box-shadow ">

                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!--<h4 class="card-title">Top 10 Questions By Difficulty</h4>-->
                    
                                <div class="row">
                                    <div class="col-md-3" onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/easy')}}'">
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
                    </div>
                    <div class="col-md-3" onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/medium')}}'">
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
                    <div class="col-md-3" onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/hard')}}'">
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
                    
                </div>
                                <div class="row">
                                    <div class="col-md-3" onclick="window.location='{{url('/user/learn/'.$subject_id.'/ncert/'.$chapter_id)}}'">
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
                                    
                                    
                                    <div class="col-md-3" onclick="window.location='{{url('/user/learn/'.$subject_id.'/previous-papers/'.$chapter_id)}}'">
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
                    
                    
                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->

                    <!-- column -->
                    
                    <!-- column -->
                </div>
</div>
<div class="tab-pane p-20" id="concepts" role="tabpanel">
    <div class="row bg-white m-l-0 m-r-0 box-shadow ">

                    <!-- column -->
                    <div class="col-lg-12">
                        
                            
                                <!--<h4 class="card-title">Top 10 Questions By Difficulty</h4>-->
                    
                                @foreach($concepts as $concept)
                                
                        <div class="card">
                            
                            
                            
                            <div class="card-body">
                                
                                <div class="card-content">
                                    
                                        <h4 class="alert-heading">Example</h4>
                                        <p>
                                            {!!html_entity_decode($concept->concept)!!}
                                        </p>
                                    
                                </div>
                            </div>
                        
                            
                        </div>
                        
                        
                        @endforeach
                            
                    </div>
                    <!-- column -->

                    <!-- column -->
                    
                    <!-- column -->
                </div>
</div>
                                </div>
                            </div>
                        </div>
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