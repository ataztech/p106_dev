@extends('layouts.admin')
@section('title')
NCRT Question And Solutions
@endsection
@section('content')
<link href="{{url('/')}}/public/backend/css/multiselect-styles.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/question-answer-set/list')}}">Question & Answer Sets</a></li>
    <li><a href="{{url('admin/question-answer-sets/ncrt-solutions/'.$ncrt->chapter_id)}}">NCRT Solutions</a></li>
    <li><a href="javascript:void(0)">Update NCRT Question And Solutions</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update NCRT Question And Solutions For {{$ncrt->chapter->name}}</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="row">
                              <div class="row">
                            <div class="col-md-12 form-group">
                                  <h4>Add Question</h4>
                                  <textarea contenteditable="true" id="editor_question" name="editor_question">{{$ncrt->question}}</textarea>
                              </div>
                            </div>
                              <div class="row">
                              <div class="col-md-12 form-group">
                                  <h4>Solution</h4>
                                  <textarea contenteditable="true" id="editor_option1" name="editor_option1">{{$ncrt->solution}}</textarea>
                              </div>
                              </div>
                              </div>
                              <input type="hidden" name="question" id="input_question">
                              <input type="hidden" name="solution" id="input_option1">
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
          function collectData()
          {
            
             var question_data = CKEDITOR.instances.editor_question.getData();
             var question_data_code = (question_data.replace(/</g, "&lt;")).trim();
            

            var option1_data = CKEDITOR.instances.editor_option1.getData();
            var option1_data_code = (option1_data.replace(/</g, "&lt;")).trim();

            $("#input_question").val(question_data_code);
            $("#input_option1").val(option1_data_code);
            
            var question = $('#input_question').val();
            var option_1 = $('#input_option1').val();

            var error_code = 0;
            var error_msg = '';

            if(question == '')
            {
                error_code = 1;
                error_msg += ' Question,';
            }
            if(option_1 == '')
            {
                error_code = 1;
                error_msg += ' Solution,';
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
</script>
@endsection