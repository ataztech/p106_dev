@extends('layouts.admin')
@section('title')
permission
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/role/list')}}">Manage Role</a></li>
    <li><a href="javascript:void(0)">Set permission</a></li>
</ul>
<div class="">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <h2>Set Permissions For {{$role->name}}</h2>
            </div>
        </div>
    </div>
    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @foreach($permissions as $permission)
<div class="">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$permission->module_name}}</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-12 center-margin">
                            <div class="row permission">
                                @foreach($permission->permission($permission->module_name) as $action)
                                    <input type="checkbox" @if($action->hasRole($role->id,$action->id)) checked @endif name="permission[]" value="{{$action->id}}">{{$action->permission}}
                                    @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
        @endforeach

        <div class="">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="col-md-12 center-margin">
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                        <button type="submit" class="btn btn-success">Set Permissions</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

