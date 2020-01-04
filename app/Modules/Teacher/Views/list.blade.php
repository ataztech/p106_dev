@extends('layouts.admin')
@section('title')
Teachers
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Teachers</a></li>
</ul>

@if(Session::has('success'))
    <span id="notification" data-type="success" data-msg="{{Session::get('success')}}"></span>
@endif

   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Teachers</h2>
                      <div class="pull-right">
                          <a href="{{url('admin/teacher/create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">
                        <table id="teachers" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
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
    $('#teachers').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/teacher/data') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'subject', name: 'subject'},
            {data: 'email', name: 'email'},
            {data: 'mobile', name: 'mobile'},
            {data: 'status', name: 'status',orderable: false},
            {data: "update",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-primary btn-xs" href="{{url("admin/teacher/update/")}}/' + row.id + '"><i class="fa fa-pencil"></i> Edit</a>';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
            },
            {data: "delete",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<form id="delete" action="{{url("admin/teacher/delete/")}}/' + row.id + '"><button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete()"><i class="fa fa-trash"></i> Delete</a></form>';
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

function confirmDelete(){
    if(confirm("Do you really want to delete this record"))
    {
        $('#delete').submit();
    }
}
</script>
@endsection