@extends('layouts.admin')
@section('title')
Cms Page
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/cms/list')}}">Manage Cms Page</a></li>
    <li><a href="javascript:void(0)">Update Cms Page</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update {{$cms->name}} Cms Page</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                             {{ csrf_field() }}   
                        <div class="form-group">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <textarea name="value" id="cmsdata">{!!old('value',$cms->value)!!}</textarea>
                            @if ($errors->has('value'))
                            <span><strong class="text-danger">{{ $errors->first('value') }}</strong></span>
                            @endif
                        </div>
                      </div>
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
@endsection
@section('footer')
    <script>
        CKEDITOR.config.toolbar_Full =
            [
                { name: 'document', items : [ 'Source'] },
                { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                { name: 'editing', items : ['find'] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
            ];
        // CKEDITOR.config.removePlugins= 'toolbar';
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.config.imageUploadUrl = "{{url('/get/ck/image')}}";

        CKEDITOR.config.filebrowserUploadUrl = "{{url('/get/ck/image')}}";
        CKEDITOR.config.sharedSpaces = { top: 'toolbar1'};
        CKEDITOR.replace('cmsdata', {
            extraPlugins: 'ckeditor_wiris',
            language: 'en',
            height : 300,
        });
    </script>

@endsection


