@extends('layouts.admin')
@section('title')
Global Values
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/manage-global-value')}}">Manage Global Values</a></li>
    <li><a href="javascript:void(0)">Update Global Values</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Global Values</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                             {{ csrf_field() }}   
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$global_value->name}}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="{{$global_value->slug == 'site-logo' ? 'file' : 'text'}}" value="{{$global_value->value}}" name="value">
                            @if ($errors->has('name'))
                            <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
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

