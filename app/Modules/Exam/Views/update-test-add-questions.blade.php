@extends('layouts.admin')
@section('title')
Test
@endsection
@section('content')
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/exam/list')}}">Manage Exam</a></li>
    <li><a href="{{url('admin/exam/set/'.$exam->id)}}">Manage {{$exam->name}} Test</a></li>
    <li><a href="javascript:void(0)">Create {{$exam->name}} Test</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create {{$exam->name}} Test</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              

                              <div class="row">
                                  
                                  <div class="col-md-4 form-group">
                                      <label>Total Question</label>
                                      <input required id="total_question" min="1" type="number" name="total_question" class="form-control" onchange="checkQuestionQuntity()">
                                      @if ($errors->has('total_question'))
                                          <span><strong class="text-danger">{{ $errors->first('total_question') }}</strong></span>
                                      @endif
                                  </div>
                                  
                              </div>

                              <div class="row">
                                  
                                  <div class="col-md-4 form-group">
                                      <label>Exam Type</label>
                                      <input required type="radio" name="exam_type"  value="Full">Full &nbsp;&nbsp;
                                       <input required type="radio" name="exam_type"  value="Part">Part
                                      @if ($errors->has('exam_type'))
                                          <span><strong class="text-danger">{{ $errors->first('exam_type') }}</strong></span>
                                      @endif
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label>Select Standards</label>
                                      <select required id="standard" name="standard" disabled="" data-placeholder="Select Standards.."  multiple class="chosen-select" >
                                          
                                          @foreach($standards as $standard)
                                          <option value="{{$standard->id}}" selected="" >{{$standard->name}}</option>
                                          @endforeach
                                      </select>
                                      @if ($errors->has('standard'))
                                          <span><strong class="text-danger">{{ $errors->first('standard') }}</strong></span>
                                      @endif
                                  </div>
                                  
                                  <div class="col-md-4 form-group">
                                      <label>Select Subjects</label>
                                      <select id="subject" name="subject[]" data-placeholder="Select Subjects.." class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option> 
          
        </select>
                                      
                                  </div>
                                  
                              </div>
                              
                              
                              <div id="result-container">
                              
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
        <script>
            var arr_question_ids = [];

            $(document).ready(function(){
                totalAddedQuestion()
                getSubjects()
//                $("#standard").chosen();
            });
            function getSubjects()
            {
                var standard = $('#standard').val();
                $('#subject').html('');
                $.ajax({
                    url: "{{url('admin/test/create/get/subject')}}",
                    method:'GET',
                    data:{
                        standard : standard
                    },
                    success: function(result){
                        for(var i =0; i < result.length; i++)
                        {
                            $('#subject').append('<option value="'+result[i].id+'">'+result[i].name+'('+result[i].standard_name+')'+'</option>');
                        }
                        $("#subject").chosen().change(function(evt, params) {
                                var id = params.selected
                                
                                if(params.deselected)
                                {
                                    $('#subject-container-'+params.deselected).remove();
                                }else
                                {
                                 var subject_name = $("#subject option[value='"+id+"']").text();
                                var strHtml = "";
                                strHtml+='<div class="row" id="subject-container-'+id+'">';
                                  strHtml+='<div class="col-md-4 form-group">';
                                      strHtml+='<label>Selected Subject:</label>';
                                      strHtml+='<div>'+subject_name+'</div>';
                              
                                      
                                  strHtml+='</div>';
                                  strHtml+='<div class="col-md-4 form-group">';
                                  strHtml+='    <label>Chapter Name</label>';
                                      strHtml+='<select data-placeholder="Select Chapters.." class="chosen-select form-control" multiple required name="chapter[]"  id="chapter-'+id+'" >';
                                      strHtml+='    <option value="">Select Chapter</option>';
                                      strHtml+='</select>';
                                      
                                  strHtml+='</div>';
                              strHtml+='</div>';
                              
                              $("#result-container").append(strHtml);
                              
                              
                              getChapters(id);
                          }
  });
                    }});
            }

            function getChapters(subject_id)
            {
                var subject = subject_id;
                $('#chapter-'+subject_id).html('');
                $.ajax({
                    url: "{{url('admin/test/create/get/chapter')}}",
                    method:'GET',
                    data:{
                        subject : subject
                    },
                    success: function(result){
                        for(var i =0; i < result.length; i++)
                        {
                            $('#chapter-'+subject_id).append('<option value="'+result[i].id+'">'+result[i].name+'</option>');
                        }
                        
                        
                         $("#chapter-"+subject_id).chosen().change(function(evt, params) {
                             

                    if(params.deselected)
                    {
                             $("#test-list-"+params.deselected).remove();
                     }else{                            
            var chapter = params.selected;
                $.ajax({
                    url: "{{url('admin/test/create/get/question')}}",
                    method:'GET',
                    data:{
                        chapter : chapter
                    },
                    success: function(result){
                        $('#question').append(result);
                        addPaginate();
                    }});
                             
                             //end questions
                         }    
                             
                         });
                    }});
            }

            function getQuestions() {
                var chapter = $('#chapter').val();
                $('#question').html('');
                $.ajax({
                    url: "{{url('admin/test/create/get/question')}}",
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
                    else if(parseInt(arr_question_ids.length)==parseInt($('#total_question').val()))
                    {
                        alert(parseInt($('#total_question').val())+"-"+parseInt(arr_question_ids.length))
                        alert('You have already added '+$('#total_question').val()+' questions.');
                        $('#'+question_id).prop('checked',false);
                    }
                    else{
                        $('#question_container').append('' +
                            '<div class="selected-question" id="question_div_'+question_id+'">\n' +
                            '<button type="button" class="close" aria-label="Close" onclick="removeQuestion('+question_id+')">\n' +
                            '<span aria-hidden="true">&times;</span>\n' +
                            '</button>\n' +
                            $('#'+question_id).parent().next().text()+
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
