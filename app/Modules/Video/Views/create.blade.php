@extends('layouts.admin')
@section('title')
Video
@endsection
@section('content')
<link href="{{url('/')}}/public/backend/css/multiselect-styles.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/video/list')}}">Manage Video</a></li>
    <li><a href="javascript:void(0)">Create Video</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Video</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="row col-md-8">
                              <div class="form-group">
                                  <label>Select Standards</label>
                                  <select name="standard" required id="standard" class="form-control" onchange="getSubjects()">
                                      @foreach($standards as $standard)
                                          <option value="{{$standard->id}}">{{$standard->name}}</option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('standard'))
                                      <span><strong class="text-danger">{{ $errors->first('standard') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Select Subject</label>
                                  <select name="subject" required class="form-control" id="subject" onChange="getChapters()">
                                  </select>
                                  @if ($errors->has('subject'))
                                  <span><strong class="text-danger">{{ $errors->first('subject') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Chapter Name</label>
                                  <select name="chapter" required class="form-control" id="chapter" onchange="getTopic()">
                                  </select>
                                  @if ($errors->has('chapter'))
                                  <span><strong class="text-danger">{{ $errors->first('chapter') }}</strong></span>
                              @endif
                              </div>
                                  <div class="form-group">
                                  <label>Topic Name</label>
                                  <select name="topic" required class="form-control" id="topic">
                                  </select>
                                  @if ($errors->has('topic'))
                                  <span><strong class="text-danger">{{ $errors->first('topic') }}</strong></span>
                              @endif
                              </div>
                                  <div class="form-group">
                                  <label>Video Name</label>
                                  <input name="name" required class="form-control">
                                  @if ($errors->has('name'))
                                  <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                              @endif
                              </div>
                                  <div class="form-group">
                                  <label>Video Link</label>
                                  <input type="url" required name="link" class="form-control">
                                  @if ($errors->has('link'))
                                  <span><strong class="text-danger">{{ $errors->first('link') }}</strong></span>
                              @endif
                              </div>
                            </div>
                            </div>
                              
                              
                            
                              
                              <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <button type="submit"  class="btn btn-success">Submit</button>
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
<script>
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

