@extends('layouts.admin')
@section('title')
Exam
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/exam/list')}}">Manage Exam</a></li>
    <li><a href="javascript:void(0)">Create Exam</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Exam</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Exam Name</label>
                                  <input class="form-control" type="text" name="name">
                                  @if ($errors->has('name'))
                                      <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                  @endif
                              </div>
                              
                              <div class="form-group">
                                  <label>Exam Full Form</label>
                                  <input class="form-control" type="text" name="exam_full_form">
                                  @if ($errors->has('exam_full_form'))
                                      <span><strong class="text-danger">{{ $errors->first('exam_full_form') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Image</label>
                                  <input class="form-control" type="file" name="image">
                                  @if ($errors->has('file'))
                                      <span><strong class="text-danger">{{ $errors->first('file') }}</strong></span>
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
@endsection

