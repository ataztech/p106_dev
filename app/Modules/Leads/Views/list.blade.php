@extends('layouts.admin')
@section('title')
Leads
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">View Leads</a></li>
</ul>

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        {{Session::get('success')}}
    </div>
@endif

   <div class="col-md-12 col-sm-12 col-xs-12">
       {{--<div class="pull-right">
           <h1 style="color: black">Total Payment:- <span id="total_payment"></span><span>/-</span></h1>
       </div>--}}
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Leads</h2>
                      {{--<div class="pull-right">
                          <a href="{{url('admin/payment/create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>--}}
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" style="overflow-x:auto;">
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Email Id</th>
                            <th>City</th>
                            <th>Registration Date</th>
                            <th>Expiration Date</th>
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
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/leads/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'mobile', name: 'mobile'},
            {data: 'email', name: 'email'},
            {data: 'city', name: 'city'},
            {data: 'account_registration_date', name: 'account_registration_date'},
            {data: 'account_expiration_date', name: 'account_expiration_date'},
            {data: 'action',
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-success btn-xs" href="{{url("/make/permanent")}}/' + row.id + '"><i class="fa fa-lock"></i> Make it permanent</a>';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                'defaultContent':'-',
            },

        ]
    });



});


</script>
@endsection