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
                        
                        
                        @foreach($arr_other_video_topics as $topic)
                                <li> <a class="" href="javascript:void(0)" ><i class="fa fa-language"></i><span class="hide-menu">{{$topic->name}}</span>
                                    
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
                
                @foreach($arr_video_topics as $topic)
                
                
                <div class="row">
                    <h3>{{$topic->name}}</h3>
					<div class="col-lg-12">
                    @if(count($topic->videos)>0)
                    
                    
                        <div class="card bg-dark">
                            <div class="testimonial-widget-one p-17">
                                <div class="testimonial-widget-one owl-carousel owl-theme">
                    @foreach($topic->videos as $video)
                    
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <img class="testimonial-author-img" src="images/avatar/2.jpg" alt="" />
                                            <div class="testimonial-author">John</div>
                                            <div class="testimonial-author-position">{{$video->name}}</div>

                                            <div class="testimonial-text">
                                                image goes here
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                    
                    @endforeach
                    
                </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <!-- End footer -->
        </div>
            
@endsection

@section('footer')


<script>
    $('.video-slider').owlCarousel({
	  loop:true,
	  items:3,
	  nav:true,
	  dots:false,
	  autoplay:true,
	  margin:10,
	  autoplayTimeout:5000,
	  smartSpeed:2500,
	  
			   
});
    </script>
@endsection

