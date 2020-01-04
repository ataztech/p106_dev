@extends('layouts.admin')
@section('title')
    Sales
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="{{url('/')}}/public/backend/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/sales/list')}}">Manage Sales</a></li>
    <li><a href="javascript:void(0)">Create Sales</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Sales</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form id="sales_form" class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Date</label>
                                  <input class="form-control" type="text" id="date" name="date" value="{{old('date')}}">
                                  @if ($errors->has('date'))
                                      <span><strong class="text-danger">{{ $errors->first('date') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Customer Name</label>
                                  <input class="form-control" type="text" id="customer_name" name="customer_name" value="{{old('customer_name')}}">
                                  @if ($errors->has('customer_name'))
                                      <span><strong class="text-danger">{{ $errors->first('customer_name') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Contact No</label>
                                  <input class="form-control" type="text" id="contact_no" name="contact_no" value="{{old('contact_no')}}">
                                  @if ($errors->has('contact_no'))
                                      <span><strong class="text-danger">{{ $errors->first('contact_no') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Booking Value</label>
                                  <input class="form-control" type="text" id="booking_value" name="booking_value" value="{{old('booking_value')}}">
                                  @if ($errors->has('booking_value'))
                                      <span><strong class="text-danger">{{ $errors->first('booking_value') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Cash Submitted</label>
                                  <input class="form-control" type="text" id="cash_submitted" name="cash_submitted" value="{{old('cash_submitted')}}">
                                  @if ($errors->has('cash_submitted'))
                                      <span><strong class="text-danger">{{ $errors->first('cash_submitted') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>First Installment</label>
                                  <input class="form-control" type="text" id="first_installment" name="first_installment" value="{{old('first_installment')}}">
                                  @if ($errors->has('first_installment'))
                                      <span><strong class="text-danger">{{ $errors->first('first_installment') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Second Installment</label>
                                  <input class="form-control" type="text" id="second_installment" name="second_installment" value="{{old('second_installment')}}">
                                  @if ($errors->has('second_installment'))
                                      <span><strong class="text-danger">{{ $errors->first('second_installment') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Second Installment Date</label>
                                  <input class="form-control" type="text" id="second_installment_date" name="second_installment_date" value="{{old('second_installment_date')}}">
                                  @if ($errors->has('second_installment_date'))
                                      <span><strong class="text-danger">{{ $errors->first('second_installment_date') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Third Installment</label>
                                  <input class="form-control" type="text" id="third_installment" name="third_installment" value="{{old('third_installment')}}">
                                  @if ($errors->has('third_installment'))
                                      <span><strong class="text-danger">{{ $errors->first('third_installment') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Third Installment Date</label>
                                  <input class="form-control" type="text" id="third_installment_date" name="third_installment_date" value="{{old('third_installment_date')}}">
                                  @if ($errors->has('third_installment_date'))
                                      <span><strong class="text-danger">{{ $errors->first('third_installment_date') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Name</label>
                                  <select class="form-control" id="counsellor_id" name="counsellor_id">
                                      <option value=""> -- Select Counsellor Name -- </option>
                                      @foreach($counsellors as $counsellor)
                                          <option value="{{$counsellor->id}}">{{$counsellor->counsellor_name}}</option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('counsellor_id'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_id') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Mode Of Payment</label>
                                  <select class="form-control" id="mode_of_payment" name="mode_of_payment">
                                      <option value=""> -- Select Mode Of Payment -- </option>
                                      <option value="Cash">Cash</option>
                                      <option value="Cheque">Cheque</option>
                                  </select>
                                  @if ($errors->has('mode_of_payment'))
                                      <span><strong class="text-danger">{{ $errors->first('mode_of_payment') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Place</label>
                                  <input class="form-control" type="text" id="place" name="place" value="{{old('place')}}">
                                  @if ($errors->has('place'))
                                      <span><strong class="text-danger">{{ $errors->first('place') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Cheque Status</label>
                                  <input class="form-control" type="text" id="cheque_status" name="cheque_status" value="{{old('cheque_status')}}">
                                  @if ($errors->has('cheque_status'))
                                      <span><strong class="text-danger">{{ $errors->first('cheque_status') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Cheque No</label>
                                  <input class="form-control" type="text" id="cheque_no" name="cheque_no" value="{{old('cheque_no')}}">
                                  @if ($errors->has('cheque_no'))
                                      <span><strong class="text-danger">{{ $errors->first('cheque_no') }}</strong></span>
                                  @endif
                              </div>


                              <div class="ln_solid"></div>

                              <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <input type="submit" class="btn btn-success" value="Submit">
                                  </div>
                              </div>

                          </form>
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>
@endsection
@section('footer')
    <script src="{{url('/')}}/public/backend/js/jquery.validate.js"></script>
    <script src="{{url('/')}}/public/backend/js/jquery-ui.min.js"></script>

   <script>


       $('#date').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
       });

       $('#second_installment_date').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
       });

       $('#third_installment_date').datepicker({
           dateFormat: 'dd/mm/yy',
           changeYear: true,
       });

       var javascript_site_path = '{{url('/')}}'
       $(function () {

       })
       $('#counsellor_form').validate({
           errorClass: 'text-danger',
           rules:{
               counsellor_name:{
                   required: true,
                   remote: {
                       url: javascript_site_path + '/check-counsellor-name-duplication',
                       method: 'get'
                   }
               },
               counsellor_email_id:{
                   required: true,
               },
               counsellor_mobile_no:{
                   required: true,
               }
           },
           messages:{
               counsellor_name:{
                   required: 'Please Enter Counsellor Name',
                   remote: 'This Name Already Exists'
               },
               counsellor_email_id:{
                   required: 'Please Enter Counsellor Email Id',
                   //remote: 'This Name Already Exists'
               },
               counsellor_mobile_no:{
                   required: 'Please Enter Counsellor Mobile No',
                   //remote: 'This Name Already Exists'
               }
           },
           submitHandler: function (form) {
               console.log(666);
               form.submit();
           }
       });
   </script>
@endsection

