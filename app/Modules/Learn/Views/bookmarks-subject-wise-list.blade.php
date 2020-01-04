@extends('layouts.app-dashboard')
<title>Bookmarks - {{$subjectData->name}}</title>
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
    
</style>
<div class="main_dash_right blue_color">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{url('tools/bookmarks')}}">Bookmarks</a></li>
  <li class="breadcrumb-item"><a href="#" onclick="history.back()">{{$subjectData->name}}</a></li>
  
</ol>
      <div class="motion_tab">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" ><a href="#home" onclick="$('#current-tab').text('Questions')" aria-controls="home" role="tab" data-toggle="tab">Questions</a></li>
        <!--<li role="presentation"><a href="#profile" onclick="$('#current-tab').text('Videos')" aria-controls="profile" role="tab" data-toggle="tab">Videos</a></li>-->
        <li role="presentation"><a href="#settings" onclick="$('#current-tab').text('Concepts')" aria-controls="settings" role="tab" data-toggle="tab">Concepts</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home"> 
            
          @foreach($ak_question_answers as $index => $question_answer)
                
                
                    @php
                     $flag = 0;
                     $class_correct_wrong = '';
                     
                     $selected_answer = -1;
                    @endphp
                
                
                <div class="qsn_ans afq_qsn_ans {{$flag==1?'attempted-question':'unattempted-question'}} {{$class_correct_wrong}}">
                    <div class="qsn_bookmark">
      <ul>
        <li>
            <a href="javascript:void(0)" title="Bookmark" ><i class="fa fa-bookmark {{$question_answer->bookmark?'fa_active':''}}" aria-hidden="true" onclick="bookMarkQuestion({{$question_answer->id}}, this)"></i></a>
        </li>
      </ul>
    </div>
    <div class="question">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-1"> 
            <div class="qsn_number">
                <span class="af_question_number"> {{$index+1}} </span>
            </div>
          </div>
          <div class="col-md-11">
            {!! html_entity_decode($question_answer->question)!!}
          </div>
        </div>
      </div>
    </div>
    <div class="answer">
        
        <ul>
          @if(isset($question_answer->option_1))
          <li class="option1 {{$question_answer->answer2->answer == '1' ?'correct_ans':(($selected_answer=='1' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},1, this)"><span>A</span>{!!html_entity_decode($question_answer->option_1)!!}
              @if($question_answer->answer2->answer==1)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
          </li>
          @endif
          
          @if(isset($question_answer->option_2))
            <li class="option2 {{$question_answer->answer2->answer== '2' ?'correct_ans':(($selected_answer=='2' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},2, this)"><span>B</span>{!!html_entity_decode($question_answer->option_2)!!}
            @if($question_answer->answer2->answer==2)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
            </li>
         @endif
         
         @if(isset($question_answer->option_3))
         <li class="option3 {{$question_answer->answer2->answer==3?'correct_ans':(($selected_answer=='3' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},3, this)"><span>C</span>{!!html_entity_decode($question_answer->option_3)!!}
         
         @if($question_answer->answer2->answer==3)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
         </li>
         @endif
         
         @if(isset($question_answer->option_4))
           <li class="option4 {{$question_answer->answer2->answer==4?'correct_ans':(($selected_answer=='4' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},4, this)"><span>D</span>{!!html_entity_decode($question_answer->option_4)!!}
           
           @if($question_answer->answer2->answer==4)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
           </li>
        @endif
        
         @if(isset($question_answer->option_5))
           <li class="option5 {{$question_answer->answer2->answer==5?'correct_ans':(($selected_answer=='5' && $flag==1)?'wrong_ans':'')}}" onclick="checkAnswer({{$question_answer->id}},5, this)"><span>E</span>{!!html_entity_decode($question_answer->option_5)!!}
           
           @if($question_answer->answer2->answer==5)
                <div class="correct_ans_content"><div class="correct_txt">Correct Answer</div></div>
              @endif
           </li>
        @endif
        
    <li class="correct_ans solution-container" >
        <div class="correct_ans_content">
            <h5>Solution</h5>
            <p>{!!html_entity_decode($question_answer->reason)!!}</p>
        </div>
     </li>
      </ul>
      

    </div>
    </div>
                
                @endforeach
              
        @if(count($ak_question_answers)==0)
                <div class="no-record-found" ><h3>No Record Found.</h3></div>
                @endif
      </div>
          <div role="tabpanel" class="tab-pane" id="profile">
              
              
          </div>
          
          <div role="tabpanel" class="tab-pane" id="settings">
              <div class="qsn_set ">
                  
                   @foreach($concepts as $index=>$concept)
   <div class="qsn_ans conceptes_qsn_sets filter-content filter-{{$concept->concept_type}}">
        <div class="qsn_bookmark">
          <div class="point_index">
           <b>{{$index+1}}</b> {{$concept->conceptType->type}}
          </div>
          <ul>
        <li>
            <a href="javascript:void(0)" title="Bookmark" ><i class="fa fa-bookmark {{$concept->bookmark?'fa_active':''}}" aria-hidden="true" onclick="bookMarkConcept({{$concept->id}}, this)"></i></a>
        </li>
      </ul>
          </div>
          <div class="topic_description">
            {!!html_entity_decode($concept->concept)!!}
          </div>
    </div>
                   @endforeach
    
                   @if(count($concepts)==0)
                <div class="no-record-found" ><h3>No Record Found.</h3></div>
                @endif
                   <div class="no-record-found" style="display:none"><h3>No Record Found.</h3></div>
   </div>
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
    
    
    
    function bookMarkQuestion(question_id, ele)
{
    
    var status = 1
    if($(ele).hasClass('fa_active'))
    {
        status = 2;
        $(ele).removeClass('fa_active');
    }
    
    $.ajax({
                url: "{{url('bookmark/question')}}",
                method:'GET',
                type:'json',
                synch: false,
                data:{
                    question_id : question_id,
                    subject_id : {{base64_decode(Request::segment(4))}},
                    status: status
                },
                success: function(response){
                    if(status==1)
                    {
                        $(ele).addClass('fa_active');
                    }
                }});
        
}

    function bookMarkConcept(question_id, ele)
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
                    concept_id : question_id,
                    subject_id : {{base64_decode(Request::segment(4))}},
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