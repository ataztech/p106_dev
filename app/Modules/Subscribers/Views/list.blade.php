@extends('layouts.admin')
@section('title')
Suscribers
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">View Subscribers</a></li>
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
                    <h2>View Subscribers</h2>
                      {{--<div class="pull-right">
                          <a href="{{url('')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>--}}
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" style="overflow-x:auto;">
                        <table id="subscribers" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Id</th>
                            <th>Mobile number</th>
                            <th>Subscribed_at</th>
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
    $('#subscribers').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/subscribers/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'subscribers_number', name: 'subscribers_number'},
            {data: 'created_at',
                className: "dt-body-center",
                orderable: false,
                'defaultContent':'-',
            },

        ]
    });



});


</script>
@endsection