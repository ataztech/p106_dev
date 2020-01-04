@extends('layouts.admin')
@section('title')
Login History
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">View Login History</a></li>
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
                    <h2>View Login History</h2>
                      {{--<div class="pull-right">
                          <h4>Total Payment:- <span id="total_payment"></span><span>/-</span></h4>
                      </div>--}}
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
                            <th>Student Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th>Date</th>
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
        ajax: "{{ url('/admin/login-history/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'start_time', name: 'start_time'},
            {data: 'end_time', name: 'end_time'},
            {data: 'active_time', name: 'active_time'},
            {data: 'date', name: 'date'},

        ]
    });
});



</script>
@endsection