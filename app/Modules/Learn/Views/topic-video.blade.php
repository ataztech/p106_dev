@extends('layouts.app-dashboard')

@section('content')
<style>
    .top_vd:after, .gal_outer:after{
        position:relative !important;
    }
    </style>
<div class="left_sec content topic_list">
        <ul>
          
          <h5>Other Videos</h5>
@foreach($other_videos as $other_video)
          <li onclick="javascript:window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/video/'.base64_encode($other_video->topic_id).'/'.base64_encode($other_video->id))}}'">
            <div class="media">
              <div class="media-left"></div>
              <div class="media-body">{{$other_video->name}}
              </div>
              <div class="media-right">
                  <!--<img src="{{url('public/theme1/images/circle_progrss.png')}}">-->
              </div>
            </div>
          </li>
@endforeach   
          
        </ul>
</div>


<div class="main_dash_right">
    <div class="video_gallary">
      <div class="top_vd_outer">
        <div class="top_vd">
        <!--<iframe width="100%" height="480" src="https://www.youtube.com/embed/t3uWKgn4ps4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
        <iframe width="853" height="480" src="{{$video->link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
      </div>
      <div class="vd_detail_info">
        <!--<p>In publishing and graphic design</p>-->
        <h5>
            <h3>{{$video->name}}</h3>
        </h5>
<!--        <div class="rating_div">
        <div class="row">
          <div class="col-md-6">
            <p><span>Language</span>  <a>aa</a><a>bb</a></p> 
          </div>
          <div class="col-md-6">
            <p class="text-right rating"><span>Rate Lecture</span>  
            <a type="button" data-toggle="modal" data-target="#vd_modal" href="#" ><i class="fa fa-smile-o" aria-hidden="true"></i></a> <a type="button" data-toggle="modal" data-target="#vd_modal" href="#" ><i class="fa fa-smile-o" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-frown-o" aria-hidden="true"></i></a></p>
          </div>
        </div>
        </div>
        <p class="vd_para">In publishing and graphic design Generate Lorem Ipsum</p>-->
      </div>
    </div>
 </div>
@endsection

@section('footer')

@endsection

