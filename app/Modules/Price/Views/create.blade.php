@extends('layouts.admin')
@section('title')
Price
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/price/list')}}">Manage Price</a></li>
    <li><a href="javascript:void(0)">Create Price</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Price</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Year</label>
                                  <input class="form-control" type="text" name="year">
                                  @if ($errors->has('year'))
                                      <span><strong class="text-danger">{{ $errors->first('year') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Silver Package Price</label>
                                  <input class="form-control" type="text" name="silver">
                                  @if ($errors->has('silver'))
                                      <span><strong class="text-danger">{{ $errors->first('silver') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Gold Package Price</label>
                                  <input class="form-control" type="text" name="gold">
                                  @if ($errors->has('gold'))
                                      <span><strong class="text-danger">{{ $errors->first('gold') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Diamond Package Price</label>
                                  <input class="form-control" type="text" name="diamond">
                                  @if ($errors->has('diamond'))
                                      <span><strong class="text-danger">{{ $errors->first('diamond') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Platinum Package Price</label>
                                  <input class="form-control" type="text" name="platinum" value="Coming Soon">
                                  @if ($errors->has('platinum'))
                                      <span><strong class="text-danger">{{ $errors->first('platinum') }}</strong></span>
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

