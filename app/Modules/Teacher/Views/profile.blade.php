@extends('layouts.admin')
@section('title')
    Profile
@endsection
@section('content')
    <ul class="breadcrumb">
        <li><a href="{{url('admnin/dashboard')}}">Dashboard</a></li>
        <li><a href="javascript:void(0)">Profile</a></li>
    </ul>

    <div class="">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profile</h2>

                        <div class="clearfix"></div>
                    </div>
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <div class="x_content">
                        <br>
                        <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input required type="text" value="{{old('name',Auth::user()->name)}}" name="name" placeholder="Name" class="form-control">
                                    @if ($errors->has('name'))
                                        <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" value="{{old('contact')}}" name="email" placeholder="{{Auth::user()->email}}" class="form-control">
                                    <p class="text text-info">Note: Enter email if you want to change</p>
                                    @if ($errors->has('email'))
                                        <span><strong class="text-danger">{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Number</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" value="{{old('contact')}}" name="mobile" placeholder="{{Auth::user()->mobile}}" class="form-control">
                                    <p class="text text-info">Note: Enter mobile number if you want to change</p>
                                    @if ($errors->has('mobile'))
                                        <span><strong class="text-danger">{{ $errors->first('mobile') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea required  name="address" placeholder="Address" class="form-control">{{old('address',Auth::user()->address)}}</textarea>
                                    @if ($errors->has('address'))
                                        <span><strong class="text-danger">{{ $errors->first('address') }}</strong></span>
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
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Password Setting</h2>

                        <div class="clearfix"></div>
                    </div>
                    @if(Session::has('password_success'))
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{Session::get('password_success')}}
                        </div>
                    @endif
                    @if(Session::has('password_error'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{Session::get('password_error')}}
                        </div>
                    @endif
                    <div class="x_content">
                        <br>
                        <form class="form-horizontal form-label-left" action="{{url('/admin/password')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Old Password</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input required type="password" value="" name="old_password" placeholder="Old Password" class="form-control">
                                    @if ($errors->has('old_password'))
                                        <span><strong class="text-danger">{{ $errors->first('old_password') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input required type="password" value="" name="password" placeholder="New Password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span><strong class="text-danger">{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Change Password</button>
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

@endsection
