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
                    <h2>Create {{$exam->name}} Test  <button id='btn_submit2' disabled type="button" class="btn btn-success" >Submit</button></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data" id="exam_form">
                              {{ csrf_field() }}
                              

                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label>Test Name</label>
                                      <input required type="text" name="name" value="" class="form-control">
                                      @if ($errors->has('name'))
                                          <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Total Question</label>
                                      <input required id="total_question" min="1" type="number" name="total_question" class="form-control" onchange="checkQuestionQuntity()">
                                      @if ($errors->has('total_question'))
                                          <span><strong class="text-danger">{{ $errors->first('total_question') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Total Mark</label>
                                      <input required type="number" min="1" name="mark" class="form-control">
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
                                      <input required type="number" min="0" name="hours" class="form-control" placeholder="Hours">
                                      </div>
                                      <div class="col-md-6">
                                      <input required type="number" min="0" max="60" name="minute" class="form-control" placeholder="Minutes">
                                      </div>
                                      @if ($errors->has('name'))
                                          <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                      @endif
                                  </div>
                                  @if($exam->slug != 'others')
                                  <div class="col-md-4 form-group">
                                      <label>Positive Mark</label>
                                      <input required type="number" min="1" name="positive_mark" class="form-control">
                                      @if ($errors->has('positive_mark'))
                                          <span><strong class="text-danger">{{ $errors->first('positive_mark') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Negative Mark</label>
                                      <input required type="number" min="0" step="0.01" name="negative_mark" class="form-control">
                                      @if ($errors->has('negative_mark'))
                                          <span><strong class="text-danger">{{ $errors->first('negative_mark') }}</strong></span>
                                      @endif
                                  </div>
                                  @endif
                                  <div class="col-md-4 form-group">
                                      <label>Exam Start Date</label>
                                      <input required type="date" name="date" class="form-control">
                                      @if ($errors->has('date'))
                                          <span><strong class="text-danger">{{ $errors->first('date') }}</strong></span>
                                      @endif
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label>Exam End Date</label>
                                      <input required type="date" name="end_date" class="form-control">
                                      @if ($errors->has('end_date'))
                                          <span><strong class="text-danger">{{ $errors->first('end_date') }}</strong></span>
                                      @endif
                                  </div>
                                  
                                  <div class="col-md-4 form-group">
                                      <label>Exam Target Year</label>
                                      <input required type="number" name="target_year" class="form-control">
                                      @if ($errors->has('target_year'))
                                          <span><strong class="text-danger">{{ $errors->first('target_year') }}</strong></span>
                                      @endif
                                  </div>
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

                /*$('body').on('change','.select_chapter',function () {
                    //alert(111);
                    var html = "";
                    html+='<div class="col-md-2 form-group">';
                    html+='    <label>Positive Marks</label>';
                    html+='<input class="form-control" required placeholder="Positive Marks" name="positive_mark_arr[]" >';
                    html+='</div>';
                    html+='<div class="col-md-2 form-group">';
                    html+='    <label>Negative Marks</label>';
                    html+='<input class="form-control" placeholder="Negative Marks" required name="negative_mark_arr[]"  >';
                    html+='</div>';

                    $(".positive_negative_div").append(html);
                })*/

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
                                        /*var string = subject_name.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');*/
                                      strHtml+='<div>'+subject_name+' <input type="text" name="question_count_'+id+'" id="question_count_'+id+'" placeholder="Total Ques in '+subject_name+'"></div>';
                                      strHtml+='<div>Selected Question:- <span id="count_'+id+'">0</span></div>';

                              
                                      
                                  strHtml+='</div>';
                                  strHtml+='<div class="col-md-4 form-group">';
                                  strHtml+='    <label>Chapter Name</label>';
                                      strHtml+='<select data-placeholder="Select Chapters.." class="chosen-select form-control select_chapter" multiple required name="chapter[]"  id="chapter-'+id+'" >';
                                      strHtml+='    <option value="">Select Chapter</option>';
                                      strHtml+='</select>';
                                      
                                  strHtml+='</div>';
                                 /* strHtml+='<div class="col-md-4 form-group positive_negative_div">';
                                    strHtml+='</div>';*/
                                 var slug = '{{$exam_slug}}';
                                  if(slug == 'others')
                                  {
                                      strHtml+='<div class="col-md-2 form-group">';
                                    strHtml+='    <label>Positive Marks</label>';
                                strHtml+='<input class="form-control" required placeholder="Positive Marks" name="positive_mark_arr['+id+'][]" data-subject_id="'+id+'"  id="positive_mark_arr'+id+'" >';
                                strHtml+='</div>';
                                      strHtml+='<div class="col-md-2 form-group">';
                                      strHtml+='    <label>Negative Marks</label>';
                                      strHtml+='<input class="form-control" placeholder="Negative Marks" required name="negative_mark_arr['+id+'][]" data-subject_id="'+id+'"  id="negative_mark_arr'+id+'" >';
                                      strHtml+='</div>';
                                  }


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
                    url: "get/chapter",
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
                    url: "get/question",
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
                //$('.total-added-question').text(arr_question_ids.length);
                $('.total-added-question').text(parseInt($('.question-ids').length));
            }

            // added by sohel to count question subject wise
            function showTotalSelectedQuestionSubjectWise(subject_id,question_id)
            {

                $('#count_'+subject_id).text(parseInt($('input.question_'+subject_id+':checked').length));
                var assigned_question_count = $('#question_count_'+subject_id+'').val();
                var actual_question_count = $('#count_'+subject_id+'').text();
                console.log('AssignedQuestion '+assigned_question_count);
                console.log('ActualQuestion '+actual_question_count);
                if(parseInt(assigned_question_count) < parseInt(actual_question_count) )
                {
                    $('#count_'+subject_id).text(parseInt(assigned_question_count));
                    alert('limit expired');
                    $('#'+question_id).prop('checked',false);
                }

            }

            function showTotalSelectedQuestion(question_id,_this){
                var index = arr_question_ids.indexOf(question_id);
                var subject_id = $(_this).attr('data-subject_id'); // getting subject id of selected question
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
                        //$('#count_'+subject_id).text($('input.question_'+subject_id+':checked').length);
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
                checkQuestionQuntity(subject_id);
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

            function checkQuestionQuntity(subject_id){
                /* if(arr_question_ids.length == parseInt($('#total_question').val()))
                {
                    $('#btn_submit').prop('disabled',false);
                    $("#btn_submit2").prop('disabled',false);
                }
                else
                {
                    $('#btn_submit').prop('disabled',true);
                    $("#btn_submit2").prop('disabled',true);
                }*/
                // sohel
                // this check whethere the total question count is correct
                if($('.question-ids').length == parseInt($('#total_question').val()))
                {
                    $('#btn_submit').prop('disabled',false);
                    $("#btn_submit2").prop('disabled',false);
                }
                else
                {
                    $('#btn_submit').prop('disabled',true);
                    $("#btn_submit2").prop('disabled',true);
                }


            }
            
            $(function(){
                
                $("#btn_submit2").click(function(){
               $("#exam_form").submit();
                })
            })

        </script>
    @endsection
