@extends('layouts.admin')
@section('title')
Topic
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/topic/list')}}">Manage Topic</a></li>
    <li><a href="javascript:void(0)">Update Topic</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Topic</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Subject Name</label>
                                  <select name="subject" class="form-control" id="subject" onchange="getChapters()">
                                      @foreach($subjects as $subject)
                                          <option value="{{$subject->id}}" @if($subject->id == $topic->chapter->subject_id) selected @endif>{{$subject->name}} ({{$subject->standard->name}} Standard)</option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('subject'))
                                      <span><strong class="text-danger">{{ $errors->first('subject') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Chapter Name</label>
                                  <select name="chapter" class="form-control" id="chapter">
                                  </select>
                                  @if ($errors->has('chapter'))
                                      <span><strong class="text-danger">{{ $errors->first('chapter') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Topic Name</label>
                                  <input class="form-control" type="text" value="{{$topic->name}}" name="name">
                                  @if ($errors->has('name'))
                                      <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Related With</label>
                                  <div>
                                  <input type="radio" name="related_with" value="0" @if(old('related_with',$topic->related_with) == 0) checked @endif>Question And Answers
                                  </div>
                                  <div>
                                  <input type="radio" name="related_with" value="1" @if(old('related_with',$topic->related_with) == 1) checked @endif>Videos
                                  </div>
                                  @if ($errors->has('name'))
                                      <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                  @endif
                              </div>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <button type="submit" class="btn btn-success">Submit</button>
                                  </div>
                              </div>

                          </form>
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
        getChapters();
    });
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

