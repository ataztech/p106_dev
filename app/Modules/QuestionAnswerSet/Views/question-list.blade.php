@extends('layouts.admin')
@section('title')
Question And Answers
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/question-answer-set/list')}}">Question And Answer Sets</a></li>
    <li><a href="javascript:void(0)">Add Top 10 {{ucfirst($level)}} Questions</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Top 10 {{ucfirst($level)}} Questions</h2>
                    <h4 class="pull-right">Total Selected {{ucfirst($level)}} Questions is: <span id="total_question"></span></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="" method="post" id="question_form">
                          {!! csrf_field() !!}
                    <br>
                      <div class="center-margin">
                          @foreach($all_questions as $index=>$question)
                          
                          <div class="row">
                          <div class="col-md-12">
                              <div class="col-md-1">
                                  {{$index+1}}) <input type="checkbox" value="{{$question->id}}" @if(in_array($question->id,$selected_questions)) checked @endif class="selected_question" name="question_ids[]">
                              </div>
                              <div class="col-md-11">
                                  {!! htmlspecialchars_decode($question->question) !!}
                               </div>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-12">
                              <div class="col-md-1">
                                  <b> Reason:</b> 
                              </div>
                              <div class="col-md-11">
                                  {!! htmlspecialchars_decode($question->reason) !!}
                               </div>
                          </div>
                          </div>
                              <hr>
                          @endforeach
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary pull-right" type="button" id='set_question'>Set</button>
                    </div>
                      </form>
                  </div>
                </div>
                
              </div>
</div>
</div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            showTotalSelectedQuestion();
        });
        
        $('.selected_question').click(function(){
            selected_question_count = countTotalQuestions();
            if(selected_question_count > 10)
            {
                alert('You Can Select Only 10 Questions');
                $(this).attr('checked',false);
            }
            showTotalSelectedQuestion();
        });
        
        function showTotalSelectedQuestion()
        {
            $('#total_question').text(countTotalQuestions());
        }
        
        function countTotalQuestions()
        {
            var all_question = $('.selected_question');
            var selected_question_count = 0;
            all_question.each(function(index,val){
                if($(val).prop('checked'))
                {
                    selected_question_count++;
                }
            });
            
            return selected_question_count;
        }
        
        $('#set_question').click(function()
        {
            question_count = countTotalQuestions();
            if(question_count != 10)
            {
                alert('Please Select Any 10 Questions');
                return false;
            }
            $('#question_form').submit();
        })
</script>
@endsection

