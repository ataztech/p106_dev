@extends('layouts.admin')
@section('title')
Board
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/board/list')}}">Manage Board</a></li>
    <li><a href="javascript:void(0)">Update Board</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Board</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Board Name</label>
                                  <input class="form-control" type="text" value="{{$board->name}}" name="name">
                                  @if ($errors->has('name'))
                                      <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                  @endif
                              </div>
                              
                              <div class="form-group">
                                  <label>Board Full Form</label>
                                  <input class="form-control" type="text" name="full_form_name" value="{{$board->full_form_name}}">
                                  @if ($errors->has('full_form_name'))
                                      <span><strong class="text-danger">{{ $errors->first('full_form_name') }}</strong></span>
                                  @endif
                              </div>
                              
                              <div class="form-group">
                                  <label>Board Image</label>
                                  <input class="form-control" type="file" name="image">
                                  @if ($errors->has('file'))
                                      <span><strong class="text-danger">{{ $errors->first('file') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <img src="{{url('').$board->link.'thumb/'.$board->image}}">
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

