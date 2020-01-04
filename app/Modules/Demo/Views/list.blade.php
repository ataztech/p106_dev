@extends('layouts.admin')
@section('title')
Demo
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Demo</a></li>
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
                    <h2>Manage Demo</h2>
                      <div class="pull-right">
                          <a href="{{url('telecaller/demo/create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" style="overflow-x:auto;" >
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>id</th>
                            <th>Demo Created By</th>
                        <th>Student Name</th>
                        <th>Contact</th>
                        <th>Alternate Contact</th>
                            <th>Standard</th>
                        <th>Date</th>
                         <th>Time</th>
                            <th>Demo Assigned To</th>
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
      "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ url('/telecaller/demo/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'created_by_id', name: 'created_by_id'},
            {data: 'student_name', name: 'student_name'},
            {data: 'contact_number', name: 'contact_number'},
            {data: 'alternative_contact_number', name: 'alternative_contact_number'},
            {data: 'standard', name: 'standard'},
            {data: 'date', name: 'date'},
            {data: 'time', name: 'time'},
            {data: 'assigned_to', name: 'assigned_to'},
            {data: "update",
                render: function (data, type, row) {
                     if (type === 'display') {

                            return '<a class="btn btn-primary btn-xs" href="{{url("telecaller/demo/update/")}}/' + row.id + '"><i class="fa fa-pencil"></i> Edit</a>';
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
                        return '<form id="delete_'+row.id+'" action="{{url("telecaller/demo/delete/")}}/' + row.id + '"><button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete('+row.id+')"><i class="fa fa-trash"></i> Delete</a></form>';
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

function confirmDelete(id){
    if(confirm("Do you really want to delete this record"))
    {
        $('#delete_'+id).submit();
    }
}
</script>
@endsection