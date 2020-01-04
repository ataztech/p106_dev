@extends('layouts.admin')
@section('title')
    Counsellor
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/counsellor/list')}}">Manage Counsellor</a></li>
    <li><a href="javascript:void(0)">Update Counsellor</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Counsellor</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-3 pull-right">
                          <label>Document Preview</label>
                          <img id="document_preview" height="250px" width="250px" src="{{url('storage/app/public/counsellor_documents/'.$counsellor->counsellor_document)}}">
                      </div>
                      <div class="col-md-6 pull-left">
                          <form id="update_counsellor_form" class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label>Counsellor Name</label>
                                  <input class="form-control" type="text" value="{{$counsellor->counsellor_name}}" id="counsellor_name" name="counsellor_name">
                                  @if ($errors->has('counsellor_name'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_name') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Email Id</label>
                                  <input class="form-control" type="text" id="counsellor_email_id" name="counsellor_email_id" value="{{old('counsellor_email_id',$counsellor->counsellor_email_id)}}">
                                  @if ($errors->has('counsellor_email_id'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_email_id') }}</strong></span>
                                  @endif
                              </div>

                              <div class="form-group">
                                  <label>Counsellor Mobile No</label>
                                  <input class="form-control" type="text" id="counsellor_mobile_no" name="counsellor_mobile_no" value="{{old('counsellor_mobile_no',$counsellor->counsellor_mobile_no)}}">
                                  @if ($errors->has('counsellor_mobile_no'))
                                      <span><strong class="text-danger">{{ $errors->first('counsellor_mobile_no') }}</strong></span>
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
        $('#update_counsellor_form').validate({
            errorClass: 'text-danger',
            rules:{
                counsellor_name:{
                    required: true,
                    remote: {
                        url: javascript_site_path + '/check-counsellor-name-duplication',
                        data:{
                            id :'{{Request::segment(4)}}',
                        },
                        method: 'get'
                    }
                },
            },
            messages:{
                counsellor_name:{
                    required: 'Please Enter Counsellor Name',
                    remote: 'This Name Already Exists'
                },
            },
            submitHandler: function (form) {
                console.log(666);
                form.submit();
            }
        });
    </script>
@endsection

