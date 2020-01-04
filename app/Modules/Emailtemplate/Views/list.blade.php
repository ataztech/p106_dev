@extends('layouts.admin')
@section('title')
Email Templates
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Email Templates</a></li>
</ul>
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Email Templates</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
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
        ajax: "{{ url('/admin/emailtemplate/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: "update",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-primary btn-xs" href="{{url("admin/emailtemplate/update/")}}/' + row.id + '"><i class="fa fa-pencil"></i> Edit</a>';
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