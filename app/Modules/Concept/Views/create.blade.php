@extends('layouts.admin')
@section('title')
Concept
@endsection
@section('content')
<link href="{{url('/')}}/public/backend/css/multiselect-styles.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/concept/list')}}">Manage Concept</a></li>
    <li><a href="javascript:void(0)">Create Concept</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Concept</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="center-margin">
                          <form id="concept_submit_form" class="form-horizontal form-label-left" enctype="multipart/form-data">
                              <div class="row">
                              <div class="col-md-4 form-group">
                                  <label>Select Standards</label>
                                  <select name="standard" id="standard" class="form-control" onchange="getSubjects()">
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
                                  <select name="subject" class="form-control" id="subject" onChange="getChapters()">
                                  </select>
                                  @if ($errors->has('subject'))
                                  <span><strong class="text-danger">{{ $errors->first('subject') }}</strong></span>
                                  @endif
                              </div>
                              <div class="col-md-4 form-group">
                                  <label>Chapter Name</label>
                                  <select name="chapter" class="form-control" id="chapter" onchange="getTopic()">
                                  </select>
                                  @if ($errors->has('chapter'))
                                  <span><strong class="text-danger">{{ $errors->first('chapter') }}</strong></span>
                              @endif
                              </div>
                                  
                                  
                                  <div class="col-md-4 form-group">
                                  <label>Select Concept Type</label>
                                  <select name="concept_type" id="concept_type" class="form-control" >
                                      @foreach($conceptType as $ctype)
                                          <option value="{{$ctype->id}}">{{$ctype->type}}</option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('concept_type'))
                                      <span><strong class="text-danger">{{ $errors->first('concept_type') }}</strong></span>
                                  @endif
                              </div>
                            </div>
                              <div class="col-md-12 form-group" id="file-container" style="display:none">
                                  <h4>Upload PDF</h4>
                                  <input type="file" name="pdf" id="pdf" >
                              </div>
                              
                              <div class="row" id="editor-container" >
                            <div class="col-md-12 form-group">
                                  <h4>Add Content</h4>
                                  <textarea contenteditable="true" id="editor_concept" name="editor_concet"></textarea>
                              </div>
                            </div>
                              
                                <input type="hidden" name="concept" id="input_concept">
                                <input type="hidden"  id="hidden_concept_type" value="1">
                                

                                <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <button type="button" onClick="return collectData()" class="btn btn-success">Submit</button>
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
        
        var javascript_site_path = '{{url('/')}}';
        $(function(){
            $("#concept_type").change(function(){
                
                if($(this).val() == '5')
                {
                    $("#file-container").show();
                    $("#editor-container").hide();
                    $("#hidden_concept_type").val(2);
                    
                }else{
                    
                    $("#hidden_concept_type").val(1);
                    $("#editor-container").show();
                    $("#file-container").hide();
                }
            } )
        })
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
            CKEDITOR.replace('editor_concept', {
                 extraPlugins: 'ckeditor_wiris',
                 language: 'en',
                 height : 300,
            });
              
          function collectData()
          {
             var concept_data = CKEDITOR.instances.editor_concept.getData();
             var concept_data_code = (concept_data.replace(/</g, "&lt;")).trim();

            $("#input_concept").val(concept_data_code);
            
            var standard = $('#standard').val();
            var subject = $('#subject').val();
            var chapter = $('#chapter').val();
            var concept = $('#input_concept').val();

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
            if(concept == '' && $("#hidden_concept_type").val()=='1')
            {
                error_code = 1;
                error_msg += ' Question,';
            }
            if(error_code)
            {
                alert(error_msg+' must be fill');
                return false;
            }
            else
            {
                // Get form
                var form = $('#concept_submit_form')[0];
                // Create an FormData object
                var data = new FormData(form);
                $.ajax({
                    url: javascript_site_path+'/admin/concept/create',
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    data: data,
                    success: function(result)
                    {
                        CKEDITOR.instances.editor_concept.setData('');
                        $('#pdf').val('');
                    }
                })
                //return true;
            }
        }


        $(document).ready(function(){
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
                }});
        }
</script>
@endsection

