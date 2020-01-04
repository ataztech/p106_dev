@extends('layouts.admin')
@section('title')
Email Template
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/emailtemplate/list')}}">Manage Email Template</a></li>
    <li><a href="javascript:void(0)">Update Email Template</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update {{$emailtemplate->name}} Email Template</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                             {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" class="form-control" value="{{old('value',$emailtemplate->name)}}">
                                @if ($errors->has('value'))
                                    <span><strong class="text-danger">{{ $errors->first('value') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="value" id="emailtemplatedata">{!!old('value',$emailtemplate->value)!!}</textarea>
                            @if ($errors->has('value'))
                            <span><strong class="text-danger">{{ $errors->first('value') }}</strong></span>
                            @endif
                        </div>
                      </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Parameters</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control">
                                    @foreach(explode(',',$emailtemplate->parameter) as $parameter)
                                    <option>{{$parameter}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('value'))
                                    <span><strong class="text-danger">{{ $errors->first('value') }}</strong></span>
                                @endif
                            </div>
                        </div>
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
@endsection
@section('footer')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'emailtemplatedata' );
</script>

@endsection


