@extends('layouts.admin')
@section('title')
User
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/user/list')}}">Manage User</a></li>
    <li><a href="javascript:void(0)">Update User</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update User</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Name</label>
                                  <input class="form-control" type="text" value="{{$user->name}}" name="name">
                                  @if ($errors->has('name'))
                                      <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Email</label>
                                  <input class="form-control" type="email" name="email" placeholder="{{$user->email}}">
                                  <span class="text text-warning">Note: Enter email if you want to change</span>
                                  @if ($errors->has('email'))
                                      <span><strong class="text-danger">{{ $errors->first('email') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Password</label>
                                  <input class="form-control" type="password" name="password">
                                  <span class="text text-warning">Note: Enter password if you want to change</span>
                                  @if ($errors->has('password'))
                                      <span><strong class="text-danger">{{ $errors->first('password') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Confirm Password</label>
                                  <input class="form-control" type="password" name="password_confirmation">
                                  <span class="text text-warning">Note: Enter password if you want to change</span>
                                  @if ($errors->has('password_confirmation'))
                                      <span><strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group form-group has-feedback">
                                  <label>Mobile</label>
                                  <input class="form-control" type="number" name="mobile" placeholder="{{$user->mobile}}">
                                  <span class="text text-warning">Note: Enter mobile if you want to change</span>
                                  @if ($errors->has('mobile'))
                                      <span><strong class="text-danger">{{ $errors->first('mobile') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group form-group has-feedback">
                                  <label>Select Role</label>
                                  <select class="form-control" name="role">
                                      @foreach($roles as $role)
                                          <option value="{{$role->id}}" @if($role->id == $user->roles[0]->role_id) selected @endif>{{$role->name}}</option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('role'))
                                      <span><strong class="text-danger">{{ $errors->first('role') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>City</label>
                                  <input class="form-control" type="text" name="city" value="{{$user->city}}">
                                  @if ($errors->has('city'))
                                      <span><strong class="text-danger">{{ $errors->first('city') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>State</label>
                                  <input class="form-control" type="text" name="state" value="{{$user->state}}">
                                  @if ($errors->has('state'))
                                      <span><strong class="text-danger">{{ $errors->first('state') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Address</label>
                                  <textarea class="form-control" name="address">{{$user->address}}</textarea>
                                  @if ($errors->has('address'))
                                      <span><strong class="text-danger">{{ $errors->first('address') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Status</label>
                                  <input type="radio" name="status" value="1" @if($user->user_status == 1) checked @endif>Active
                                  <input type="radio" name="status" value="0" @if($user->user_status == 0) checked @endif>Inactive
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

