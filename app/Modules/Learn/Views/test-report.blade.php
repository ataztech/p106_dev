@extends('layouts.app-dashboard')

@section('content')

<div class="left_sec content topic_list">
        <ul>
          
          <h5>Other Topics</h5>
      @foreach($arr_topics as  $index=>$topic)
      @if(App\Modules\Learn\Models\QuestionReport::getTopicReport($topic->id)>=100)            
          <li onclick="javascript:window.location='{{url('user/learn/'.base64_encode($chapter_data->subject_id).'/topic/'.base64_encode($topic->chapter_id).'/test/'.base64_encode($topic->id))}}'">
              @else
          <li onclick="javascript:window.location='{{url('user/learn/'.base64_encode($chapter_data->subject_id).'/topic/'.base64_encode($topic->chapter_id).'/test/'.base64_encode($topic->id))}}'">
              
              @endif
            <div class="media">
              <div class="media-left">{{($index+1)>9?($index+1):"0".($index+1) }}</div>
              <div class="media-body">{{$topic->name}}
              <p><span>{{App\Modules\Learn\Models\QuestionReport::getTopicReport($topic->id)>=100?100:App\Modules\Learn\Models\QuestionReport::getTopicReport($topic->id)}}%</span> Completed</p></div>
              <div class="media-right">
                  <!--<img src="{{url('public/theme1/images/circle_progrss.png')}}">-->
              </div>
            </div>
          </li>
          @endforeach
          
        </ul>
</div>


<div class="main_dash_right" style="padding: 5% 6% 0 34% !important" >
  <div class="row">
    <div class="col-md-9">
    <h4>Report</h4>
    <!--<h5>dsxdxszxds</h5>--> 
      <div class="report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-percent" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5><b>{{$overall_progress>=100?100:$overall_progress}}%</b></h5>
                        <p>Completed</p>
                      </div>
                    </div>
                    <div class="media">
                    <div class="media-left"><i class="fa fa-question" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$total_question_answered}}</h5>
                        <p>Questions Practiced</p>
                      </div>
                  </div>
                  
                  
                  
                <div class="media">
                    <div class="media-left"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$time_taken}} mins</h5>
                        <p>Time Taken</p>
                      </div>
                  </div>
                  
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                      <div class="media-body">
                         <h5>{{$total_question_correct_answer}}</h5>
                        <p>Correct Answer</p>
                      </div>
                  </div>
                  <div class="media">
                    <div class="media-left"><i class="fa fa-star"></i></div>
                      <div class="media-body">
                        <h5>{{$total_question_wrong_answer}}</h5>
                        <p>Wrong Answer</p>
                      </div>
                  </div>
                  
                  <div class="media">
                    <div class="media-left"><i class="fa fa-star" aria-hidden="true"></i></div>
                      <div class="media-body">
                        <h5>{{$total_question_skipped_answer}}</h5>
                        <p>Skipped Answer</p>
                      </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
      
      
      <div class="report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                    <div class="media-left"><i class="fa fa-eye"></i></div>
                      <div class="media-body">
                        <h5><b>Accuracy</b></h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                        <h5>{{$accuracy}}%</h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                         
                      </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
    <div class="report_outr">
          <div class="report_in">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-left"><i class="fa fa-bolt"style="background-color: #1a237e"></i></div>
                      <div class="media-body">
                        <h5><b>Speed</b></h5>
                        
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                          <h5>{{$speed>200?'200+':$speed}} <span>Questions/Hour</span></h5>  
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="media">
                      <div class="media-body">
                         
                      </div>
                  </div>
              </div>
            </div>
            
          </div>
      </div>
    </div>
  </div>
    <div style="padding-left:12%">
      <button class="btn_all next-btn"  onclick="resetTest()">Restart</button>
      <button   class="skip_btn btn_all skip-btn" onclick="window.location='{{url('user/learn/'.base64_encode($chapter_data->subject_id).'/topic/'.Request::segment(5))}}'">Close</button>
      
    </div>
</div>
@endsection

@section('footer')
<script>
    
    function redirectToReport(){
        window.location='{{url('/topic/test/get-report/'.Request::segment(7).'/'.Request::segment(5))}}';
    }
   
   function resetTest(){
       
       if(confirm("Are you sure to restart test?"))
       window.location='{{url('topic/test/reset/'.Request::segment(4).'/'.Request::segment(5).'/'.base64_encode($chapter_data->subject_id))}}'
   }
    
  function disableF5(e){
      if(((e.which || e.keyCode) == 116) || (e.which || e.keyCode) == 82){
          e.preventDefault();
      }
  }
  

  $(function(){
        {{--  prevent user from refershing page --}}
      $(document).on("keydown",disableF5);
      $("html").on("contextmenu", function(e){ return false;});
  })  
  
  
    
    </script>
@endsection

