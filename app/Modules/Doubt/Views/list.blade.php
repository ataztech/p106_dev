@extends('layouts.admin')
@section('title')
Doubts
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Doubts</a></li>
</ul>
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Doubts</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(Session::has('success'))
                        <span id="notification" data-type="success" data-msg="{{Session::get('success')}}"></span>
                    @endif
                    <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Id</th>
                        <th>Question</th>
                        <th>Subject</th>
                        <th>Student Name</th>
                        <th>Teacher Name</th>
                        <th>Status</th>
                        <th>Rate</th>
                        <th>View</th>
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
        ajax: "{{ url('/admin/doubt/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'question', name: 'question'},
            {data: 'subject', name: 'subject'},
            {data: 'student', name: 'student'},
            {data: 'teacher', name: 'teacher'},
            {data: 'status', name: 'status'},
            {data: 'rate', name: 'rate'},
            {data: "reply",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-primary btn-xs" href="{{url("admin/doubt/view/")}}/' + row.id + '"><i class="fa fa-eye"></i> View</a>';
                    }
                    return data;
                },
                className: "dt-body-center",
                name: 'update',
                orderable: false,
                'defaultContent':'-'
            }
        ]
    });
});
</script>
@endsection