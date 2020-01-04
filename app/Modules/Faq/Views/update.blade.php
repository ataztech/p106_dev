@extends('layouts.admin')
@section('title')
Faq
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/faq/list')}}">Manage Faq</a></li>
    <li><a href="javascript:void(0)">Update Faq</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Faq</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Question</label>
                                  <input class="form-control" type="text" value="{{$faq->question}}" name="question">
                                  @if ($errors->has('question'))
                                      <span><strong class="text-danger">{{ $errors->first('question') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Answer</label>
                                  <textarea class="form-control" name="answer">{{$faq->answer}}</textarea>
                                  @if ($errors->has('answer'))
                                      <span><strong class="text-danger">{{ $errors->first('answer') }}</strong></span>
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

