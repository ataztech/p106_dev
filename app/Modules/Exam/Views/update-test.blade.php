@extends('layouts.admin')
@section('title')
Test
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
    .question-container{
        padding: 1%;
        background: lavender;
        border: 1px solid black;
    }
    .selected-question{
        float: left;
        background: #fff;
        padding-left: 1%;
        padding-top: 1%;
        margin-right: 5px;
    }
    .pagination li {
        display:inline-block;
        padding:5px;
    }
</style>
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/exam/list')}}">Manage Exam</a></li>
    <li><a href="{{url('admin/exam/set/'.$test_series->id)}}">Manage {{$test_series->exam->name}} Test</a></li>
    <li><a href="javascript:void(0)">Create {{$test_series->exam->name}} Test</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create {{$test_series->exam->name}} Test</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label>Select Standards</label>
                                      <select required name="standard" id="standard" class="form-control" onchange="getSubjects()">
                                          <option value="">Select Standard</option>
                                          @foreach($standards as $standard)
                                              <option value="{{$standard->id}}">{{$standard->name}}</option>
                                          @endforeach
                                      </select>
                                      @if ($errors->has('standard'))
                                          <span><strong class="text-danger">{{ $errors->first('standard') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Select Subject</label>
                                      <select required name="subject" class="form-control" id="subject" onChange="getChapters()">
                                          <option value="">Select Subject</option>
                                      </select>
                                      @if ($errors->has('subject'))
                                          <span><strong class="text-danger">{{ $errors->first('subject') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Chapter Name</label>
                                      <select required name="chapter" class="form-control" id="chapter" onchange="getTopic()">
                                          <option value="">Select Chapter</option>
                                      </select>
                                      @if ($errors->has('chapter'))
                                          <span><strong class="text-danger">{{ $errors->first('chapter') }}</strong></span>
                                      @endif
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label>Test Name</label>
                                      <input readonly required type="text" name="name" value="{{$test_series->exam->name}}_{{$max_part}}" class="form-control">
                                      @if ($errors->has('name'))
                                          <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Total Question</label>
                                      <input required id="total_question" min="1" type="number" name="total_question" class="form-control" value="{{$test_series->total_question}}" onchange="checkQuestionQuntity()">
                                      @if ($errors->has('total_question'))
                                          <span><strong class="text-danger">{{ $errors->first('total_question') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Total Mark</label>
                                      <input required type="number" min="1" name="mark" class="form-control" value="{{$test_series->mark}}">
                                      @if ($errors->has('mark'))
                                          <span><strong class="text-danger">{{ $errors->first('mark') }}</strong></span>
                                      @endif
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <div class="col-md-12">
                                      <label>Duration</label>
                                      </div>
                                      <div class="col-md-6">
                                      <input required type="number" min="0" name="hours" class="form-control" placeholder="Hours" value="{{$test_series->hour}}">
                                      </div>
                                      <div class="col-md-6">
                                      <input required type="number" min="0" max="60" name="minute" class="form-control" placeholder="Minutes" value="{{$test_series->min}}">
                                      </div>
                                      @if ($errors->has('name'))
                                          <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Positive Mark</label>
                                      <input required type="number" min="1" name="positive_mark" class="form-control" value="{{$test_series->positive_mark}}">
                                      @if ($errors->has('positive_mark'))
                                          <span><strong class="text-danger">{{ $errors->first('positive_mark') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Negative Mark</label>
                                      <input required type="number" min="0" step="0.01" name="negative_mark" class="form-control" value="{{$test_series->negative_mark}}">
                                      @if ($errors->has('negative_mark'))
                                          <span><strong class="text-danger">{{ $errors->first('negative_mark') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Exam Start Date</label>
                                      <input required type="date" name="date" class="form-control" value="{{$test_series->start_date}}">
                                      @if ($errors->has('date'))
                                          <span><strong class="text-danger">{{ $errors->first('date') }}</strong></span>
                                      @endif
                                  </div>
                              </div>

                              <h3 class="">Total Added Questions: <span class="total-added-question"></span></h3>
                              <!-- Button to Open the Modal -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                  View All Added Questions
                              </button>

                              <div class="row">
                                  <div class="col-md-12 form-group" id="question">
                                  </div>
                              </div>

                              <!-- The Modal -->
                              <div class="modal" id="myModal">
                                  <div class="modal-dialog" style="width: 100%">
                                      <div class="modal-content">

                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                              <h1 class="modal-title">Added Questions</h1>
                                              <h3 class="">Total Added Questions: <span class="total-added-question"></span></h3>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>

                                          <!-- Modal body -->
                                          <div class="modal-body">
                                              <div class="row question-container" id="question_container">
                                                  @foreach($test_series->testSeriesQuestion as $added)
                                                  <div class="selected-question" id="question_div_{{$added->question_id}}">
                                                      <button type="button" class="close" aria-label="Close" onclick="removeQuestion({{$added->question_id}})">
                                                          <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      {{htmlspecialchars_decode(htmlspecialchars_decode($added->question->question))}}
                                                      <input type="hidden" class="question-ids" name="added_question[]" value="{{$added->question_id}}">
                                                      </div>
                                                      @endforeach
                                              </div>
                                          </div>

                                          <!-- Modal footer -->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          </div>

                                      </div>
                                  </div>
                              </div>


                              <div class="ln_solid"></div>

                              <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <button type="submit" id="btn_submit" disabled class="btn btn-success">Submit</button>
                                  </div>
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
            var arr_question_ids = {{json_encode($test_series->testSeriesQuestionIds($test_series->id))}};

            $(document).ready(function(){
                totalAddedQuestion()
            });
            function getSubjects()
            {
                var standard = $('#standard').val();
                $('#subject').html('');
                $.ajax({
                    url: "get/subject",
                    method:'GET',
                    data:{
                        standard : standard
                    },
                    success: function(result){
                        for(var i =0; i < result.length; i++)
                        {
                            $('#subject').append('<option value="'+result[i].id+'">'+result[i].name+'</option>');
                        }
                        getChapters();
                    }});
            }

            function getChapters()
            {
                var subject = $('#subject').val();
                $('#chapter').html('');
                $.ajax({
                    url: "get/chapter",
                    method:'GET',
                    data:{
                        subject : subject
                    },
                    success: function(result){
                        for(var i =0; i < result.length; i++)
                        {
                            $('#chapter').append('<option value="'+result[i].id+'">'+result[i].name+'</option>');
                        }
                        getQuestions();
                    }});
            }

            function getQuestions() {
                var chapter = $('#chapter').val();
                $('#question').html('');
                $.ajax({
                    url: "get/question",
                    method:'GET',
                    data:{
                        chapter : chapter
                    },
                    success: function(result){
                        $('#question').html(result);
                        addPaginate();
                    }});
            }

            function totalAddedQuestion()
            {
                $('.total-added-question').text(arr_question_ids.length);
            }

            function showTotalSelectedQuestion(question_id){
                var index = arr_question_ids.indexOf(question_id);
                if($('#'+question_id).prop('checked'))
                {
                    if(parseInt($('#total_question').val()) < 0)
                    {
                        alert('Please Enter Total Questions');
                    }
                    else if(parseInt($('#total_question').val()) < parseInt(arr_question_ids.length))
                    {
                        alert('You Already Add '+$('#total_question').val()+' Questions');
                        $('#'+question_id).prop('checked',false);
                    }
                    else{
                        $('#question_container').append('' +
                            '<div class="selected-question" id="question_div_'+question_id+'">\n' +
                            '<button type="button" class="close" aria-label="Close" onclick="removeQuestion('+question_id+')">\n' +
                            '<span aria-hidden="true">&times;</span>\n' +
                            '</button>\n' +
                            $('#'+question_id).parent().text()+
                            '<input type="hidden" class="question-ids" name="added_question[]" value="'+question_id+'">\n' +
                            '</div>');
                        arr_question_ids.push(question_id);
                    }
                }
                else{
                    $('#question_div_'+question_id).remove();
                    arr_question_ids.splice(index, 1);
                }
                totalAddedQuestion();
                checkQuestionQuntity();
            }

            function removeQuestion(question_id) {
//                check id is presnt or not
                if($('#'+question_id).length)
                $('#'+question_id).attr('checked',false);

//                remove id from array if present
                var index = arr_question_ids.indexOf(question_id);
                if (index > -1)
                arr_question_ids.splice(index, 1);
                $('#question_div_'+question_id).remove();
                totalAddedQuestion();
                checkQuestionQuntity();
            }

            function addPaginate() {
                var monkeyList = new List('test-list', {
                    valueNames: ['name'],
                    page: 1,
                    pagination: true
                });
                checkQuestionIsAdded();
            }

            function checkQuestionIsAdded()
            {
                for(var i = 0; i < arr_question_ids.length; i++)
                {
                    $('#'+arr_question_ids[i]).prop('checked',true);
                }
            }

            function checkQuestionQuntity(){
                if(arr_question_ids.length == parseInt($('#total_question').val()))
                {
                    $('#btn_submit').prop('disabled',false);
                }
                else
                {
                    $('#btn_submit').prop('disabled',true);
                }
            }

        </script>
    @endsection
