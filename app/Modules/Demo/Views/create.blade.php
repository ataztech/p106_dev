@extends('layouts.admin')
@section('title')
Demo
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('telecaller/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('telecaller/demo/list')}}">Manage Demo</a></li>
    <li><a href="javascript:void(0)">Create Demo</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Demo</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" id="demo_form" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Student Name</label>
                                  <input class="form-control" type="text" name="name" id="name">
                                  @if ($errors->has('name'))
                                      <span><strong class="text-danger">{{ $errors->first('name') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Contact Number</label>
                                  <input class="form-control" type="text" name="contact_number" id="contact_number">
                                  @if ($errors->has('contact_number'))
                                      <span><strong class="text-danger">{{ $errors->first('contact_number') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Alternative Contact Number</label>
                                  <input class="form-control" type="text" name="alternative_contact_number" id="alternative_contact_number">
                                  @if ($errors->has('alternative_contact_number'))
                                      <span><strong class="text-danger">{{ $errors->first('alternative_contact_number') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Standard</label>
                                  <select class="form-control" name="standard" id="standard">
                                      <option value="">Select Standard</option>
                                      <option value="11th">11th</option>
                                      <option value="12th">12th</option>
                                  </select>
                                  @if ($errors->has('standard'))
                                      <span><strong class="text-danger">{{ $errors->first('standard') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Date</label>
                                  <input class="form-control" type="text" name="date" id="date">
                                  @if ($errors->has('date'))
                                      <span><strong class="text-danger">{{ $errors->first('date') }}</strong></span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Time</label>
                                  <select class="form-control" id="time" name="time">
                                     <option value="">Select Time</option>
                                      <option value="12:00 AM">12:00 AM</option>
                                      <option value="12:30 AM">12:30 AM</option>
                                      <option value="1:00 AM">1:00 AM</option>
                                      <option value="1:30 AM">1:30 AM</option>
                                      <option value="2:00 AM">2:00 AM</option>
                                      <option value="2:30 AM">2:30 AM</option>
                                      <option value="3:00 AM">3:00 AM</option>
                                      <option value="3:30 AM">3:30 AM</option>
                                      <option value="4:00 AM">4:00 AM</option>
                                      <option value="4:30 AM">4:30 AM</option>
                                      <option value="5:00 AM">5:00 AM</option>
                                      <option value="5:30 AM">5:30 AM</option>
                                      <option value="6:00 AM">6:00 AM</option>
                                      <option value="6:30 AM">6:30 AM</option>
                                      <option value="7:00 AM">7:00 AM</option>
                                      <option value="7:30 AM">7:30 AM</option>
                                      <option value="8:00 AM">8:00 AM</option>
                                      <option value="8:30 AM">8:30 AM</option>
                                      <option value="9:00 AM">9:00 AM</option>
                                      <option value="9:30 AM">9:30 AM</option>
                                      <option value="10:00 AM">10:00 AM</option>
                                      <option value="10:30 AM">10:30 AM</option>
                                      <option value="11:00 AM">11:00 AM</option>
                                      <option value="11:30 AM">11:30 AM</option>
                                      <option value="12:00 PM">12:00 PM</option>
                                      <option value="12:30 PM">12:30 PM</option>
                                      <option value="1:00 PM">1:00 PM</option>
                                      <option value="1:30 PM">1:30 PM</option>
                                      <option value="2:00 PM">2:00 PM</option>
                                      <option value="2:30 PM">2:30 PM</option>
                                      <option value="3:00 PM">3:00 PM</option>
                                      <option value="3:30 PM">3:30 PM</option>
                                      <option value="4:00 PM">4:00 PM</option>
                                      <option value="4:30 PM">4:30 PM</option>
                                      <option value="5:00 PM">5:00 PM</option>
                                      <option value="5:30 PM">5:30 PM</option>
                                      <option value="6:00 PM">6:00 PM</option>
                                      <option value="6:30 PM">6:30 PM</option>
                                      <option value="7:00 PM">7:00 PM</option>
                                      <option value="7:30 PM">7:30 PM</option>
                                      <option value="8:00 PM">8:00 PM</option>
                                      <option value="8:30 PM">8:30 PM</option>
                                      <option value="9:00 PM">9:00 PM</option>
                                      <option value="9:30 PM">9:30 PM</option>
                                      <option value="10:00 PM">10:00 PM</option>
                                      <option value="10:30 PM">10:30 PM</option>
                                      <option value="11:00 PM">11:00 PM</option>
                                      <option value="11:30 PM">11:30 PM</option>



                                  </select>
                                  @if ($errors->has('time'))
                                      <span><strong class="text-danger">{{ $errors->first('time') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Address</label>
                                  <textarea class="form-control" type="text" name="address" id="address"></textarea>
                                  @if ($errors->has('address'))
                                      <span><strong class="text-danger">{{ $errors->first('address') }}</strong></span>
                                  @endif
                              </div>

                              @if(Auth::user()->user_type == '1')
                                  <div class="form-group">
                                      <label>Assign To</label>
                                      <select class="form-control" name="counsellor" id="counsellor">
                                          <option value="">Select Counsellor</option>
                                          @foreach($counsellors as $counsellor)
                                              <option value="{{$counsellor->id}}">{{$counsellor->counsellor_name}}</option>
                                          @endforeach
                                      </select>
                                      @if ($errors->has('counsellor'))
                                          <span><strong class="text-danger">{{ $errors->first('counsellor') }}</strong></span>
                                      @endif
                                  </div>
                              @endif

                              <div class="ln_solid"></div>

                              <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <button type="submit" class="btn btn-success">Submit</button>
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
    <script>

        $(function () {
            $( "#date" ).datepicker({
                dateFormat: 'dd/mm/yy',
                changeYear: true,
                minDate: 0
            });

        });

        $('#demo_form').validate({
           errorClass: 'text-danger',
           rules:{
               'name':{
                   required: true,
               },
               'contact_number':{
                   required: true,
               },
               'standard':{
                   required: true,
               },
               'date':{
                   required: true,
               },
               'time':{
                   required: true,
               },
               'address':{
                   required: true,
               }
           },
           messages:{
               'name':{
                   required: 'Please enter student name',
               },
               'contact_number':{
                   required: 'Please enter contact number',
               },
               'standard':{
                   required: 'Please select standard',
               },
               'date':{
                   required: 'Please select date',
               },
               'time':{
                   required: 'Please select time',
               },
               'address':{
                   required: 'Please enter address',
               },
           },
           submitHandler:function (form) {

           }
        });



    </script>

@endsection

