@extends('layouts.admin')
@section('title')
Gallery
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">View Gallery</a></li>
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
                    <h2>View Gallery</h2>
                      <div class="pull-right">
                          <a href="{{url('/admin/create/gallery')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" style="overflow-x:auto;">
                        <table id="gallery" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Sequence Number</th>
                            <th>Edit</th>
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
    $('#gallery').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/gallery/data')}}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image',
               render: function (data, type, full, meta) {
              return '<img src="{{ url("/public/img/")}}/'+ data +'" width="70"/>';

            }, 
                orderable: false,
                'defaultContent':'-',

            },
            {data: 'title', name: 'title'},
            {data: 'sequence_number', name: 'sequence_number'},
            {data: 'edit', 
            render: function (data, type, full, meta) {
            return '<button type="button" class="btn btn-success">Edit</button>';
            }, 
                orderable: false,
                'defaultContent':'-',
          },
          {data: 'delete', 
            render: function (data, type, full, meta) {
            return '<button type="button" class="btn btn-danger">Delete</button>';
            }, 
                orderable: false,
                'defaultContent':'-',
          },
      ]
    });



});


</script>
@endsection