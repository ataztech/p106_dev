@extends('layouts.app-dashboard')

@section('content')
<style>
    .top-10, .conceptes_qsn_sets{
        width:100%;
    }
    .motion_tab .tab-content{
        width:90%;
    }
</style>
<div class="main_dash_right blue_color">

      <div class="motion_tab">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Topics</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Videos</a></li>
        <li role="presentation"><a style="width:135px;" href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Questions Sets</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Concepts</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home"> 
            <div class="overall_progress">
             <div class="row">
                <div class="col-md-6">
                  <div class="over_left">
                    <h5>Overall Progress</h5>
                    <div id="progressbar" class="prog_change">
                        <div style="width:{{$overall_progress}}%"></div>
                      <span>{{$overall_progress}}%</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
<!--                  <div class="continue">
                    <a href="#">Continue Practice <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  </div>-->
                </div>
              </div>
              <div class="over_right">
                <ul class="clearfix">
                  <li><i class="fa fa-question" aria-hidden="true"></i> <span>{{$total_question_answered}}</span> Questions Practiced</li>
                  <li><i class="fa fa-clock" aria-hidden="true"></i> <span>0</span>Time Taken</li>
                  <li><i class="fa fa-eye" aria-hidden="true"></i> <span>{{$accuracy}} %</span> Accuracy</li>
                  <!--<li><i class="fa fa-bar-chart" aria-hidden="true"></i> <span>50</span> Avg. Speed</li>-->
                </ul>
              </div>
        </div>
        <h3 class="h3_head"></h3>
        
        <div class="row">
             @foreach($arr_topics as  $index=>$topic)
 @if(App\Modules\Learn\Models\QuestionReport::getTopicReport($topic->id)==100)            
        <div class="col-md-6" onclick="javascript:window.location='{{url('topic/test/get-report/'.base64_encode($topic->id).'/'.base64_encode($topic->chapter_id))}}'">
            @else
        <div class="col-md-6" onclick="javascript:window.location='{{url('user/learn/'.base64_encode($chapter_data->subject_id).'/topic/'.base64_encode($topic->chapter_id).'/test/'.base64_encode($topic->id))}}'">
            
            @endif
          <div class="media chaptr_box">
              <div class="media-left">{{($index+1)>9?($index+1):"0".($index+1) }}</div>
              <div class="media-body"><h5>{{ucwords($topic->name)}}</h5>
              <p><span>{{App\Modules\Learn\Models\QuestionReport::getSubjectReport($topic->id)}}%</span> Completed</p></div>
              <div class="media-right">
<!--                  <img src="{{url('public/theme1/images/blue_circle_progrss.png')}}" class="mCS_img_loaded">-->
                <div class="arrow">
                  <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </div>
              </div>
            </div>
        </div>
             @endforeach
         
      </div>
      
      </div>
          <div role="tabpanel" class="tab-pane" id="profile">
              
              <div class="video_gallary">
<!--      <div class="top_vd_outer">
        <div class="top_vd">
          <div class="top_vd_img">
          <img src="images/video2.jpg">
          </div>
          <div class="video_icon">
            <i class="fa fa-play" aria-hidden="true"></i>
          </div>
        </div>
        <div class="row decription">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <h4>Decription is here</h4>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 text-right">
          <button class="btn_all pre_next">Continue</button>
          </div>
        </div>
      </div>-->
                  @foreach($arr_video_topics as $index=>$topic)
                  <h3>{{$topic->name}} <h6>Total Videos({{count($topic->videos)}})</h6> </h3>
       <div class="owl-carousel owl-theme video_slider1 video_common">
           
           @foreach($topic->videos as $video)
          <div class="item" onclick="location.href='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/video/'.base64_encode($video->topic_id).'/'.base64_encode($video->id))}}'">
             <div class="video_gallery">
                <div class="gal_outer">
                  <div class="gal_img">
                      <img src="{{url('public/theme1/images/video1.jpg')}}">
                  </div>
                  <div class="gal_icon">
                      <i class="fa fa-play" aria-hidden="true"></i>
                  </div>
                </div>
                <p>{{$video->name}}</p>
             </div>
          </div>
           @endforeach
           
           
      </div>
                  @endforeach
      <div class="owl-carousel owl-theme video_slider2 video_common">
          <div class="item">
             <div class="video_gallery">
                <div class="gal_outer">
                  <div class="gal_img">
                      <img src="images/video.jpg">
                  </div>
                  <div class="gal_icon">
                      <i class="fa fa-play" aria-hidden="true"></i>
                  </div>
                </div>
                <p>In publishing and graphic design</p>
             </div>
          </div>
           <div class="item">
             <div class="video_gallery">
                <div class="gal_outer">
                  <div class="gal_img">
                      <img src="images/video.jpg">
                  </div>
                  <div class="gal_icon">
                      <i class="fa fa-play" aria-hidden="true"></i>
                  </div>
                </div>
                <p>In publishing and graphic design</p>
             </div>
          </div>
           <div class="item">
             <div class="video_gallery">
                <div class="gal_outer">
                  <div class="gal_img">
                      <img src="images/video1.jpg">
                  </div>
                  <div class="gal_icon">
                      <i class="fa fa-play" aria-hidden="true"></i>
                  </div>
                </div>
                <p>In publishing and graphic design</p>
             </div>
          </div>
           <div class="item">
             <div class="video_gallery">
                <div class="gal_outer">
                  <div class="gal_img">
                      <img src="images/video1.jpg">
                  </div>
                  <div class="gal_icon">
                      <i class="fa fa-play" aria-hidden="true"></i>
                  </div>
                </div>
                <p>In publishing and graphic design</p>
             </div>
          </div>
           <div class="item">
             <div class="video_gallery">
                <div class="gal_outer">
                  <div class="gal_img">
                      <img src="images/video1.jpg">
                  </div>
                  <div class="gal_icon">
                      <i class="fa fa-play" aria-hidden="true"></i>
                  </div>
                </div>
                <p>In publishing and graphic design</p>
             </div>
          </div>
      </div>
    </div>
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
                                            <img class="testimonial-author-img" src="images/avatar/2.jpg" alt="" />
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
          <div role="tabpanel" class="tab-pane" id="messages">
              <div class="qsn_set top-10">
   <h3 class="h3_head"></h3>
   <h4 class="qset_head">Top 10 Questions</h4>
      <div class="row"> 
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/easy')}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_pink">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>
                <p>Top 10 Easy Questions</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/medium')}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_blue">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>
                <p>Top 10 Medium Questions</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/hard')}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_purple">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>
                <p>Top 10 Hard Questions</p>
            </div>
          </div>
          
      </div>
     <h4 class="qset_head">Mandatory Solve Questions</h4>
     <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/user/learn/'.$subject_id.'/ncert/'.$chapter_id)}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_pink">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>
                <p>NCERT Solutions</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/user/learn/'.$subject_id.'/previous-papers/'.$chapter_id)}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_blue">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>
                <p>Previous Papers</p>
            </div>
          </div>
          
          
      
   </div>
   
          </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="settings">
              <div class="qsn_set ">
                  
                   @foreach($concepts as $index=>$concept)
   <div class="qsn_ans conceptes_qsn_sets">
        <div class="qsn_bookmark">
          <div class="point_index">
           <b>{{$index+1}}</b> Description
          </div>
          <ul>
            <li>
              <a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
            </li>
          </ul>
          </div>
          <div class="topic_description">
            {!!html_entity_decode($concept->concept)!!}
          </div>
    </div>
                   @endforeach
    
   </div>
<!--   <div class="filter"> 
    <h4 class="qset_head">Lorem epsum text</h4>
      <div class="text-left">
        <div class="radio_container">
          <h5>gfgjbjkbkj</h5>
            RADIO   
          <div class="material-radio">
            <input type="radio" name="radio" id="radio" value="1">
            <label for="radio">Radio button 1</label>
          </div>
          <div class="material-radio">
            <input type="radio" name="radio" id="radio1" value="2">
            <label for="radio1">Radio button 1</label>
          </div>
          <div class="material-radio">
            <input type="radio" name="radio" id="radio2" value="3">
            <label for="radio2">Radio button 1</label>
          </div>
        </div>
          RADIO   

          CHECKBOX   
        <div class="checkbox_container">
        <h5>gfgjbjkbkj</h5>
          <div class="material-checkbox">
            <input type="checkbox" name="checkbox" id="checkbox">
            <label for="checkbox">Material checkbox.</label>
          </div>
          <div class="material-checkbox">
            <input type="checkbox" name="checkbox" id="checkbox1">
            <label for="checkbox1">Material checkbox.</label>
          </div>
          <div class="material-checkbox">
            <input type="checkbox" name="checkbox" id="checkbox2">
            <label for="checkbox2">Material checkbox.</label>
          </div>
           <div class="material-checkbox">
            <input type="checkbox" name="checkbox" id="checkbox3">
            <label for="checkbox3">Material.</label>
          </div>
           <div class="material-checkbox">
            <input type="checkbox" name="checkbox" id="checkbox3">
            <label for="checkbox3">Material.</label>
          </div>
           <div class="material-checkbox">
            <input type="checkbox" name="checkbox" id="checkbox3">
            <label for="checkbox3">Material.</label>
          </div>
        </div>
          CHECKBOX   
        
        
      </div>
   </div>-->
              
          </div>
      </div>

    </div>
     </div>
@endsection