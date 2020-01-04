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
                        <li class="nav-label">Other Videos</li>
                        
                        @foreach($other_videos as $other_video)
                                <li> 
                                    <a class="" href="{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/video/'.base64_encode($other_video->topic_id).'/'.base64_encode($other_video->id))}}" >
                                        <i class="fa fa-language"></i><span class="hide-menu">{{$other_video->name}}</span>
                                    <div class="progress m-t-30">
                                            <div class="progress-bar bg-info" style="width: 40%; height:8px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                        </div>
                                    </a>
                                    
                        @endforeach   
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
                    <h3 class="text-primary"></h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid" id="result">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-dark">
                            <div class="testimonial-widget-one p-17">
                                <div class="">
                                        <iframe width="853" height="480" src="{{$video->link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>    
                                            <h3>{{$video->name}}</h3>
                    </div>
                </div>
            <!-- End Container fluid  -->
            <!--ll footer -->
            <!-- End footer -->
        </div>
            
@endsection

@section('footer')


@endsection

