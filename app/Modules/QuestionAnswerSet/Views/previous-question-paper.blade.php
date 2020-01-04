@extends('layouts.admin')
@section('title')
Previous Question Papers
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/question-answer-set/list')}}">Question And Answer Sets</a></li>
    <li><a href="javascript:void(0)">Previous Question Papers</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Previous Question Papers Of {{$chapter->name}}</h2>
                    <h4 class="pull-right">Total Selected Questions is: <span id="total_question"></span></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="" method="post">
                          {!! csrf_field() !!}
                    <br>
                      <div class="center-margin">
                          @foreach($all_questions as $index=>$question)
                          <div class="col-md-6">
                              <div class="col-md-1">
                                  <input onclick="showTotalSelectedQuestion()" type="checkbox" value="{{$question->id}}" @if(in_array($question->id,$previous_question_ids)) checked @endif class="selected_question" name="question_ids[]">
                              </div>
                              <div class="col-md-11">
                                  {!! htmlspecialchars_decode($question->question) !!}
                               </div>
                          </div>
                          @endforeach
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary pull-right" type="submit" id='set_question'>Add</button>
                    </div>
                      </form>
                  </div>
                </div>
                {{$all_questions->links()}}
              </div>
</div>
</div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
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
</script>
@endsection

