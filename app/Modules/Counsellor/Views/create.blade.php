@extends('layouts.admin')
@section('title')
    Counsellor
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/counsellor/list')}}">Manage Counsellor</a></li>
    <li><a href="javascript:void(0)">Create Counsellor</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Counsellor</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-3 pull-right">
                          <label>Document Preview</label>
                          <img id="document_preview" height="250px" width="250px" src="{{url('public/backend/img/no-preview.png')}}">
                      </div>
                      <div class="col-md-6 pull-left">
                          <form id="counsellor_form" class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}

                              <div class="form-group">
                                  <label>Counsellor Id</label>
                                  <input class="form-control" type="text" id="counsellor_id" name="counsellor_id" value="{{old('counsellor_id')}}">
                                  @if ($errors->has('counsellor_id'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_id') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Name</label>
                                  <input class="form-control" type="text" id="counsellor_name" name="counsellor_name" value="{{old('counsellor_name')}}">
                                  @if ($errors->has('counsellor_name'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_name') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Email Id</label>
                                  <input class="form-control" type="text" id="counsellor_email_id" name="counsellor_email_id" value="{{old('counsellor_email_id')}}">
                                  @if ($errors->has('counsellor_email_id'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_email_id') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Mobile No</label>
                                  <input class="form-control" type="text" id="counsellor_mobile_no" name="counsellor_mobile_no" value="{{old('counsellor_mobile_no')}}">
                                  @if ($errors->has('counsellor_mobile_no'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_mobile_no') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Password</label>
                                  <input class="form-control" type="password" id="counsellor_password" name="counsellor_password" value="{{old('counsellor_password')}}">
                                  @if ($errors->has('counsellor_password'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_password') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Confirm Password</label>
                                  <input class="form-control" type="password" id="confirm_password" name="confirm_password" value="{{old('confirm_password')}}">
                                  @if ($errors->has('confirm_password'))
                                      <span><strong class="text-danger">{{ $errors->first('confirm_password') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Document</label>
                                  <input class="form-control" type="file" id="counsellor_document" name="counsellor_document" value="{{old('counsellor_document')}}">
                                  @if ($errors->has('counsellor_document'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_document') }}</strong></span>
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
   <script>


       function previewImage(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                   $('#document_preview').attr('src', e.target.result);
               };
               reader.readAsDataURL(input.files[0]);
           }
       }

       $("#counsellor_document").change(function() {
           previewImage(this);
       });

       var javascript_site_path = '{{url('/')}}'
       $(function () {

       })
       $('#counsellor_form').validate({
           errorClass: 'text-danger',
           rules:{
               counsellor_id:{
                   required: true
               },
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
               },
               counsellor_password:{
                   required: true,
               },
               confirm_password:{
                   required: true,
                   equalTo: '#counsellor_password'
               }
           },
           messages:{
               counsellor_id:{
                   required: 'Please Enter Counsellor Id',
               },
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
               },
               counsellor_password:{
                   required: 'Please Enter Counsellor Password',
                   //remote: 'This Name Already Exists'
               },
               confirm_password:{
                   required: 'Please Confirm Password',
                   equalTo: 'Confirm Password Should Be Same As Password'
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

