@extends('layouts.admin')
@section('title')
Counsellor
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Counsellor</a></li>
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
                    <h2>Manage Counsellor</h2>
                      <div class="pull-right">
                          <a href="{{url('admin/counsellor/create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Mobile No</th>
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
        ajax: "{{ url('/admin/counsellor/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'counsellor_name', name: 'counsellor_name'},
            {data: 'counsellor_email_id', name: 'counsellor_email_id'},
            {data: 'counsellor_mobile_no', name: 'counsellor_mobile_no'},
            {data: "update",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-primary btn-xs" href="{{url("admin/counsellor/update/")}}/' + row.id + '"><i class="fa fa-pencil"></i> Edit</a>';
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
                        return '<form id="delete_'+row.id+'" action="{{url("admin/counsellor/delete/")}}/' + row.id + '"><button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete('+ row.id +')"><i class="fa fa-trash"></i> Delete</a></form>';
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