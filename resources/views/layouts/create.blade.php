@extends('layouts.admin')
@section('title')
Gallery
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/gallery/list')}}">Manage Gallery</a></li>
    <li><a href="javascript:void(0)">Create Gallery</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Gallery</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              
                              <div class="form-group row">
                                  <label for="image" class="col-md-2 col-form-label text-md-right">Image</label>
                                  <div class="col-md-6">
                                  <input id="image" type="file" class="form-control" name="image">
                                    @if (auth()->user()->image)
                                    <code>{{ auth()->user()->image }}</code>
                                    @endif
                                    </div>
                              </div>






                              <div class="form-group">
                                  <label class="col-md-2">Title</label>
                                  <div class="col-md-6">
                                  <input class="form-control" type="text" name="title" value="{{old('title')}}">
                                  @if ($errors->has('title'))
                                      <span><strong class="text-danger">{{ $errors->first('title') }}</strong></span>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-2">Sequence Number</label>
                                  <div class="col-md-6">
                                  <input class="form-control" type="text" name="sequence_number">
                                  @if ($errors->has('sequence_number'))
                                      <span><strong class="text-danger">{{ $errors->first('sequence_number') }}</strong></span>
                                  @endif
                                </div>
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

