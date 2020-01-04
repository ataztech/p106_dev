@extends('layouts.app-dashboard')
<title>Practice/Concepts/Question Sets</title>
@section('content')
<style>
    .top-10, .conceptes_qsn_sets{
        width:100%;
    }
    .motion_tab .tab-content{
        width:90%;
    }
    .afq_filter{
        padding: 0px 20px 0px 50px;
    }
    
    
    .fa_active{
        font-size: 18px;
        color: #31708f !important;
    }
    .chaptr_box{
        padding-top: 20px;
        padding-bottom: 20px;
    }
    
</style>
<div class="main_dash_right blue_color" style="margin-top:56px">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{url('examiner/user/learn/'.base64_encode($chapter_data->subject_id))}}" >{{$chapter_data->subject->name}}</a></li>
  <li class="breadcrumb-item"><a href="#">{{$chapter_data->name}}</a></li>
  <li class="breadcrumb-item active" id="current-tab">Practice</li>
</ol>
      <div class="motion_tab">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" ><a href="#home" onclick="$('#current-tab').text('Practice')" aria-controls="home" role="tab" data-toggle="tab">Practice</a></li>
        <!--<li role="presentation"><a href="#profile" onclick="$('#current-tab').text('Videos')" aria-controls="profile" role="tab" data-toggle="tab">Videos</a></li>-->
        <li role="presentation"><a href="#settings" onclick="$('#current-tab').text('Concepts')" aria-controls="settings" role="tab" data-toggle="tab">Concepts</a></li>
        <li role="presentation"><a style="width:135px;" onclick="$('#current-tab').text('Questions Sets')" href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Questions Sets</a></li>
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
                  <li><i class="fa fa-clock" aria-hidden="true"></i> <span>{{$time_taken}}</span>Time Taken</li>
                  <li><i class="fa fa-eye" aria-hidden="true"></i> <span>{{$accuracy}} %</span> Accuracy</li>
                  <li><i class="fa fa-bolt" aria-hidden="true"></i> <span>{{$speed>200?'200+':$speed}}</span> Questions/Hour</li>
                </ul>
              </div>
        </div>
        <h3 class="h3_head"></h3>
        
        <div class="row">
             @foreach($arr_topics as  $index=>$topic)
 @if(App\Modules\Learn\Models\QuestionReport::getTopicReport($topic->id)==100)            
        <div class="col-md-6" onclick="javascript:window.location='{{url('topic/test/get-report/'.base64_encode($topic->id).'/'.base64_encode($topic->chapter_id))}}'">
            @else
        <div class="col-md-6" onclick="javascript:window.location='{{url('examiner/user/learn/'.base64_encode($chapter_data->subject_id).'/topic/'.base64_encode($topic->chapter_id).'/test/'.base64_encode($topic->id))}}'">
            
            @endif
          <div class="media chaptr_box">
              <div class="media-left">{{($index+1)>9?($index+1):"0".($index+1) }}</div>
              <div class="media-body" style="font-size:13px"><h5>{{ucwords($topic->name)}}</h5>
              <p><span>{{App\Modules\Learn\Models\QuestionReport::getTopicReport($topic->id)}}%</span> Completed   &nbsp;&nbsp;&nbsp;<span>{{App\Modules\Learn\Models\QuestionReport::getAccuracyReport($topic->id)}}%</span> Accuracy</p></div>
              
              
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
       <div class="owl-carousel owl-theme video_slider1 video_common">
                  
                  @foreach($arr_video_topics as $index=>$topic)
           
           @foreach($topic->videos as $video)
          <div class="item" onclick="location.href='{{url('/examiner/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/video/'.base64_encode($video->topic_id).'/'.base64_encode($video->id))}}'">
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
                  @endforeach
      </div>
    </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="messages">
              <div class="qsn_set top-10">
   <h3 class="h3_head"></h3>
   <h4 class="qset_head">Top 10 Questions</h4>
      <div class="row"> 
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/examiner/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/easy')}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_pink">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
<!--                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>-->
                <p>Top 10 Easy Questions</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/examiner/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/medium')}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_blue">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
<!--                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>-->
                <p>Top 10 Medium Questions</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/examiner/user/learn/'.$subject_id.'/topic/'.$chapter_id.'/questions/hard')}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_purple">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
<!--                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>-->
                <p>Top 10 Hard Questions</p>
            </div>
          </div>
          
      </div>
   @if(Request::segment(3)!='NA==')
     <h4 class="qset_head">Mandatory Solve Questions</h4>
     
     <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/examiner/user/learn/'.$subject_id.'/ncert/'.$chapter_id)}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_pink">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>
<!--                <div class="qset_progress">
                  <img src="{{url('public/theme1/images/circle_progrss.png')}}">
                </div>-->
                <p>NCERT Solutions</p>
            </div>
          </div>
<!--          <div class="col-md-4 col-sm-4 col-xs-12" onclick="window.location='{{url('/examiner/user/learn/'.$subject_id.'/previous-papers/'.$chapter_id)}}'">
            <div class="qset_outr">
                <div class="qset_icon bg_blue">
                  <i class="fa fa-balance-scale" aria-hidden="true"></i>
                </div>

                <p>Previous Papers</p>
            </div>
          </div>-->
          
          
      
   </div>
     @endif
   
          </div>
          </div>
        <div role="tabpanel" class="tab-pane" id="settings" style="width:120%">
              
              @if(isset($concepts[0]->concept_type) && $concepts[0]->concept_type != '5')
              <div class="qsn_set " style="width:70% !important;">
                  @else
              <div class="qsn_set " style="width:100% !important;">
                  
                  @endif
                  
                   @foreach($concepts as $index=>$concept)
                   
                   @if($concept->concept_type == '5')
                   <iframe src="{{url('public/media/concept/'.$concept->concept)}}"
                width="800px" height="600px" ></iframe>
                   @else
   <div class="qsn_ans conceptes_qsn_sets filter-content filter-{{$concept->concept_type}}">
        <div class="qsn_bookmark">
          <div class="point_index">
           <b>{{$index+1}}</b> {{$concept->conceptType->type}}
          </div>
          <ul>
        <li>
            <a href="javascript:void(0)" title="Bookmark" ><i class="fa fa-bookmark {{$concept->bookmark?'fa_active':''}}" aria-hidden="true" onclick="bookMarkQuestion({{$concept->id}}, this)"></i></a>
        </li>
      </ul>
          </div>
          <div class="topic_description">
            {!!html_entity_decode($concept->concept)!!}
          </div>
    </div>
                   
                   @endif
                   @endforeach
    
                   <div class="no-record-found" style="display:none"><h3>No Record Found.</h3></div>
   </div>
              
              @if(isset($concepts[0]->concept_type) && $concepts[0]->concept_type != '5')
   <div class="filter afq_filter"> 
    <h4 class="qset_head">Filters</h4>
      <div class="text-left">
        
            
        <div class="checkbox_container">
        <h5>By Concept Type</h5>
        @foreach($conceptType as $ctype)
          <div class="material-checkbox">
              <input type="checkbox" name="checkbox" class="filter-checkbox" value="{{$ctype->id}}" id="checkbox-{{$ctype->id}}">
            <label for="checkbox-{{$ctype->id}}">{{$ctype->type}}</label>
          </div>
        @endforeach
          
        </div>
          
        
        
      </div>
   </div>
              
              @endif
              
          </div>
      </div>

    </div>
     </div>
@endsection
@section('footer')
<script>
    $(".filter-checkbox").click(function(){
        $(".no-record-found").hide();
        $(".filter-content").hide();
      $(".filter-checkbox").each(function(index, obj){
          if($(obj).prop('checked'))
          {
              var val = $(obj).val();
              $(".filter-"+val).show();
          }
      })
      
      if($(".filter-checkbox:checked").length==0)
      {
          $(".filter-content").show();
      }
      
      if($(".filter-content:visible").length==0)
      {
          $(".no-record-found").show();
      }
    })
    
    
    function bookMarkQuestion(concept_id, ele)
{
    
    var status = 1
    if($(ele).hasClass('fa_active'))
    {
        status = 2;
        $(ele).removeClass('fa_active');
    }
    
    $.ajax({
                url: "{{url('bookmark/concept')}}",
                method:'GET',
                type:'json',
                synch: false,
                data:{
                    concept_id : concept_id,
                    subject_id : {{$chapter_data->subject_id}},
                    status: status
                },
                success: function(response){
                    if(status==1)
                    {
                        $(ele).addClass('fa_active');
                    }
                }});
        
}
    </script>
@endsection