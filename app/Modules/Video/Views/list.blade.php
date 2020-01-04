@extends('layouts.admin')
@section('title')
Video
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Video</a></li>
</ul>

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        {{Session::get('success')}}
    </div>
@endif

   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Video</h2>
                      <div class="pull-right">
                          <a href="{{url('admin/video/create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Video Name</th>
                        <th>Video Link</th>
                        <th>Topic Name</th>
                        <th>Chapter Name</th>
                        <th>Subject Name</th>
                        <th>Class</th>
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
        ajax: "{{ url('/admin/video/data') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'link', name: 'link'},
            {data: 'topic_name', name: 'topic_name'},
            {data: 'chapter_name', name: 'chapter_name'},
            {data: 'subject_name', name: 'subject_name'},
            {data: 'standard_name', name: 'standard_name'},
            {data: "update",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-primary btn-xs" onclick="return checkUpdate()" href="{{url("admin/video/update/")}}/' + row.id + '"><i class="fa fa-pencil"></i> Edit</a>';
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
                        return '<a href="{{url("admin/video/delete/")}}/' + row.id + '" class="btn btn-danger btn-xs" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</a>';
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
    if(confirm("Do you really want to delete this video"))
    {
        $('#delete').submit();
    }
}
</script>
@endsection