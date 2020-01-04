@extends('layouts.admin')
@section('title')
NCRT Solutions
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/question-answer-set/list')}}">Question & Answer Sets</a></li>
    <li><a href="javascript:void(0)">NCRT Solutions</a></li>
</ul>

@if(Session::has('success'))
    <span id="notification" data-type="success" data-msg="{{Session::get('success')}}"></span>
@endif
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    <h2>NCRT Solutions Of {{$chapter->name}}</h2>
                    <div class="pull-right">
                          <a href="{{url('admin/question-answer-sets/ncrt-solutions/'.$chapter->id.'/create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Type</th>
                        <th>Update</th>
                        <th>Delete</th>
                        </tr>
                      </thead>
                    
                    </table>
					
					
                  </div>
                </div>
              </div>

@endsection
@section('footer')
<script src="{{url('/public/backend/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#users').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url":"{{url('/admin/question-answer-set/ncrt-solution/data/'.Request::segment(4))}}"
        },
        columns: [
            {data: 'type', name: 'type'},
            {data: "update",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a href="{{url("admin/question-answer-sets/ncrt-solutions/")}}/' + row.id + '/update" class="btn btn-primary btn-xs">Update</a>';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                'defaultContent':'-'
            },
            {data: "delete",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a href="{{url("admin/question-answer-sets/ncrt-solutions/delete/")}}/' + row.id + '" class="btn btn-danger btn-xs" onclick="confirmDelete()">Update</a>';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                'defaultContent':'-'
            }
        ]
    });
});
function confirmDelete()
{
    if(confirm('Are You Sure To Delete This Record'))
    {
        return true;
    }
    return false;
}
</script>
@endsection