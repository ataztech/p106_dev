@extends('layouts.admin')
@section('title')
Question And Answers
@endsection
@section('content')
<link href="{{url('/')}}/public/backend/css/multiselect-styles.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/question-answer/list')}}">Manage Question And Answers</a></li>
    <li><a href="javascript:void(0)">Create Question And Answer</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Question And Answers</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="row">
                              <div class="col-md-3 form-group">
                                  <label>Select Standards</label>
                                  <select name="standard" id="standard" class="form-control" onchange="getSubjects()">
                                      @foreach($standards as $standard)
                                          <option value="{{$standard->id}}">{{$standard->name}}</option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('standard'))
                                      <span><strong class="text-danger">{{ $errors->first('standard') }}</strong></span>
                                  @endif
                              </div>
                              <div class="col-md-3 form-group">
                                  <label>Select Subject</label>
                                  <select name="subject" class="form-control" id="subject" onChange="getChapters()">
                                  </select>
                                  @if ($errors->has('subject'))
                                  <span><strong class="text-danger">{{ $errors->first('subject') }}</strong></span>
                                  @endif
                              </div>
                              <div class="col-md-3 form-group">
                                  <label>Chapter Name</label>
                                  <select name="chapter" class="form-control" id="chapter" onchange="getTopic()">
                                  </select>
                                  @if ($errors->has('chapter'))
                                  <span><strong class="text-danger">{{ $errors->first('chapter') }}</strong></span>
                              @endif
                              </div>
                                  <div class="col-md-3 form-group">
                                  <label>Topic Name</label>
                                  <select name="topic" class="form-control" id="topic">
                                  </select>
                                  @if ($errors->has('topic'))
                                  <span><strong class="text-danger">{{ $errors->first('topic') }}</strong></span>
                              @endif
                              </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 form-group">
                                  <h4>Add Question</h4>
                                  <textarea contenteditable="true" id="editor_question" name="editor_question"></textarea>
                              </div>
                              <div class="col-md-6 form-group">
                                  <h4>Answer Type</h4>
                                  <label for=""><input checked type="radio" value="0" name="answer_type" id="answer_type">Single</label>
                                  <label for=""><input type="radio" value="1" name="answer_type">Multiple</label>
                              </div>
                            </div>
                              <div class="row">
                              <div class="col-md-6 form-group">
                                  <h4>Option 1</h4>
                                  <textarea contenteditable="true" id="editor_option1" name="editor_option1"></textarea>
                              </div>
                              <div class="col-md-6 form-group">
                                  <h4>Option 2</h4>
                                  <textarea contenteditable="true" id="editor_option2" name="editor_option2"></textarea>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 form-group">
                                  <h4>Option 3</h4>
                                  <textarea contenteditable="true" id="editor_option3" name="editor_option3"></textarea>
                              </div>
                              <div class="col-md-6 form-group">
                                  <h4>Option 4</h4>
                                  <textarea contenteditable="true" id="editor_option4" name="editor_option4"></textarea>
                              </div>
                                <div class="col-md-6 form-group">
                                  <h4>Option 5 (Optional)</h4>
                                  <textarea contenteditable="true" id="editor_option5" name="editor_option5"></textarea>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 form-group">
                                  <h4>Reason</h4>
                                  <textarea contenteditable="true" id="editor_reason" name="editor_reason"></textarea>
                              </div>
                              <div class="col-md-6 form-group">
                                  <h4>Correct Answer</h4>
                                  <select name="answer[]" multiple id="answer" class="form-control">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                  </select>
                              </div>
                            <div>
                                <input type="hidden" name="question" id="input_question">
                                <input type="hidden" name="option1" id="input_option1">
                                <input type="hidden" name="option2" id="input_option2">
                                <input type="hidden" name="option3" id="input_option3">
                                <input type="hidden" name="option4" id="input_option4">
                                <input type="hidden" name="option5" id="input_option5">
                                <input type="hidden" name="reason" id="input_reason">

                              <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <button type="submit" onClick="return collectData()" class="btn btn-success">Submit</button>
                                  </div>
                              </div>
                          </form>
                        <div>
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>
@endsection
@section('footer')
<script src="{{url('/')}}/public/backend/js/multi-select.js"></script>
    <script>
        CKEDITOR.config.toolbar_Full =
                [
                { name: 'document', items : [ 'Source'] },
                { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                { name: 'editing', items : ['find'] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
                ];
            // CKEDITOR.config.removePlugins= 'toolbar';
            CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.config.imageUploadUrl = "{{url('/get/ck/image')}}";

        CKEDITOR.config.filebrowserUploadUrl = "{{url('/get/ck/image')}}";
            CKEDITOR.config.sharedSpaces = { top: 'toolbar1'};
            CKEDITOR.replace('editor_question', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 100,
            });
              CKEDITOR.replace('editor_option1', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 100,

            });
          
          CKEDITOR.replace('editor_option2', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 100,
            });
          CKEDITOR.replace('editor_option3', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 100,
            });
          CKEDITOR.replace('editor_option4', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 100,
            });
            CKEDITOR.replace('editor_option5', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 100,
            });

          CKEDITOR.replace('editor_reason', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 100,
            });

          function collectData()
          {
            
             var question_data = CKEDITOR.instances.editor_question.getData();
             var question_data_code = (question_data.replace(/</g, "&lt;")).trim();
            

            var option1_data = CKEDITOR.instances.editor_option1.getData();
            var option1_data_code = (option1_data.replace(/</g, "&lt;")).trim();

            var option2_data = CKEDITOR.instances.editor_option2.getData();
            var option2_data_code = (option2_data.replace(/</g, "&lt;")).trim();

            var option3_data = CKEDITOR.instances.editor_option3.getData();
            var option3_data_code = (option3_data.replace(/</g, "&lt;")).trim();

            var option4_data = CKEDITOR.instances.editor_option4.getData();
            var option4_data_code = (option4_data.replace(/</g, "&lt;")).trim();
            
            var option5_data = CKEDITOR.instances.editor_option5.getData();
            var option5_data_code = (option5_data.replace(/</g, "&lt;")).trim();

            var reason_data = CKEDITOR.instances.editor_reason.getData();
            var reason_data_code = (reason_data.replace(/</g, "&lt;")).trim();

            $("#input_question").val(question_data_code);
            $("#input_option1").val(option1_data_code);
            $("#input_option2").val(option2_data_code);
            $("#input_option3").val(option3_data_code);
            $("#input_option4").val(option4_data_code);
            $("#input_option5").val(option5_data_code);
            $("#input_reason").val(reason_data_code);
            
            var standard = $('#standard').val();
            var subject = $('#subject').val();
            var chapter = $('#chapter').val();
            var topic = $('#topic').val();
            var question = $('#input_question').val();
            var option_1 = $('#input_option1').val();
            var option_2 = $('#input_option2').val();
            var option_3 = $('#input_option3').val();
            var option_4 = $('#input_option4').val();
            var reason = $('#input_reason').val();
            var answer = $('#answer').val();

            var error_code = 0;
            var error_msg = '';

            if(standard == '')
            {
                error_code = 1;
                error_msg += 'Standard,';
            }
            if(subject == '')
            {
                error_code = 1;
                error_msg += ' Subject,';
            }
            if(chapter == '')
            {
                error_code = 1;
                error_msg += ' Chapter,';
            }
            if(topic == null)
            {
                error_code = 1;
                error_msg += ' Topic,';
            }
            if(question == '')
            {
                error_code = 1;
                error_msg += ' Question,';
            }
            if(option_1 == '')
            {
                error_code = 1;
                error_msg += ' Option 1,';
            }
            if(option_2 == '')
            {
                error_code = 1;
                error_msg += ' Option 2,';
            }
            if(option_3 == '')
            {
                error_code = 1;
                error_msg += ' Option 3,';
            }
            if(option_4 == '')
            {
                error_code = 1;
                error_msg += ' Option 4,';
            }
            if(reason == '')
            {
                error_code = 1;
                error_msg += ' Reason';
            }
            if(answer == null)
            {
                error_code = 1;
                error_msg += ' Answer';
            }
            
            if(error_code)
            {
                alert(error_msg+' must be fill');
                return false;
            }
            else
            {
                return true;
            }
        }


        $(document).ready(function(){
            $('#answer').multiSelect();
            getSubjects();
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
                    getTopic();
                }});
        }
        
        function getTopic()
        {
            var chapter = $('#chapter').val();
            $('#topic').html('');
            $.ajax({
                url: "get/topic",
                method:'GET',
                data:{
                    chapter : chapter
                },
                success: function(result){
                    for(var i =0; i < result.length; i++)
                    {
                        $('#topic').append('<option value="'+result[i].id+'">'+result[i].name+'</option>');
                    }
                }});
        }
</script>
@endsection

