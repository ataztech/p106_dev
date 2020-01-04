@extends('layouts.admin')
@section('title')
Payments
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">View Payments</a></li>
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
                    <h2>View Payments</h2>
                      <div class="pull-right">
                          <h4>Total Payment:- <span id="total_payment"></span><span>/-</span></h4>
                      </div>
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
                            <th>Customer Name</th>
                            <th>Contact No</th>
                            <th>Email Id</th>
                            <th>Package</th>
                            <th>Validity</th>
                            <th>Amount</th>
                            <th>Razorpay Order Id</th>
                            <th>Razorpay Payment Id</th>
                            <th>Razorpay Signature</th>
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
        ajax: "{{ url('/admin/payment/data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'customer_name', name: 'customer_name'},
            {data: 'contact_no', name: 'contact_no'},
            {data: 'email', name: 'email'},
            {data: 'package', name: 'package'},
            {data: 'validity', name: 'validity'},
            {data: 'amount', name: 'amount'},
            {data: 'razorpay_order_id', name: 'razorpay_order_id'},
            {data: 'razorpay_payment_id', name: 'razorpay_payment_id'},
            {data: 'razorpay_signature', name: 'razorpay_signature'},
            {data: 'created_at', name: 'created_at'},

        ]
    });

    getTotalPayment();


});

var javascript_site_path = '{{url('/')}}';

function getTotalPayment()
{
    $.ajax({
        url: javascript_site_path+'/admin/total/payment',
        method:'get',
        dataType:'json',
        success:function (result) {
            $('#total_payment').text(result);

        }
    })
}


</script>
@endsection