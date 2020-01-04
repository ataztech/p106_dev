@extends('layouts.admin')
@section('title')
    Sales
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Sales</a></li>
</ul>

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        {{Session::get('success')}}
    </div>
@endif



   <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="pull-right">
           <h1 style="color: black">Total Sale:- <span id="total_sales"></span>/-</h1>
       </div>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Sales</h2>
                      <div class="pull-right">
                          <a href="{{url('admin/sales/create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" style="overflow-x:auto;" >

                          <table  id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                              <tr>
                                  <th>Recipt No</th>
                                  <th>Date</th>
                                  <th>Customer Name</th>
                                  <th>Contact No</th>
                                  <th>Booking Value</th>
                                  <th>Cash Submitted</th>
                                  <th>First Installment</th>
                                  <th>Second Installment</th>
                                  <th>Second Installment Date</th>
                                  <th>Third Installment</th>
                                  <th>Third Installment Date</th>
                                  <th>Counsellor Name</th>
                                  <th>Mode Of Payment</th>
                                  <th>Place</th>
                                  <th>Cheque Status</th>
                                  <th>Cheque No</th>
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
        ajax: "{{ url('/admin/sales/data') }}",
        columns: [
            {data: 'recipt_no', name: 'recipt_no'},
            {data: 'date', name: 'date'},
            {data: 'customer_name', name: 'customer_name'},
            {data: 'contact_no', name: 'contact_no'},
            {data: 'booking_value', name: 'booking_value'},
            {data: 'cash_submitted', name: 'cash_submitted'},
            {data: 'first_installment', name: 'first_installment'},
            {data: 'second_installment', name: 'second_installment'},
            {data: 'second_installment_date', name: 'second_installment_date'},
            {data: 'third_installment', name: 'third_installment'},
            {data: 'third_installment_date', name: 'third_installment_date'},
            {data: 'counsellor_id', name: 'counsellor_id'},
            {data: 'mode_of_payment', name: 'mode_of_payment'},
            {data: 'place', name: 'place'},
            {data: 'cheque_status', name: 'cheque_status'},
            {data: 'cheque_no', name: 'cheque_no'},
            {data: "update",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-primary btn-xs" href="{{url("admin/sales/update/")}}/' + row.id + '"><i class="fa fa-pencil"></i> Edit</a>';
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
                        return '<form id="delete_'+row.id+'" action="{{url("admin/sales/delete/")}}/' + row.id + '"><button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete('+ row.id +')"><i class="fa fa-trash"></i> Delete</a></form>';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                'defaultContent':'-'
            }
        ]
    });
    getTotalSales();
});

var javascript_site_path = '{{url('/')}}';

function getTotalSales()
{
    $.ajax({
        url: javascript_site_path+'/admin/total-sales',
        method:'get',
        dataType:'json',
        success:function (result) {
            $('#total_sales').text(result);

        }
    })
}

function confirmDelete(id){
    if(confirm("Do you really want to delete this record"))
    {
        $('#delete_'+id).submit();
    }
}
</script>
@endsection