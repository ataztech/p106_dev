@extends('layouts.admin')
@section('title')
Test Series
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/exam/list')}}">Manage Exams</a></li>
    <li><a href="javascript:void(0)">Manage Test</a></li>
</ul>

@if(Session::has('success'))
    <span id="notification" data-type="success" data-msg="{{Session::get('success')}}"></span>
@endif

   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage {{$exam->name}} Test</h2>
                      <div class="pull-right">
                          <a href="{{url('admin/test/create/'.$exam->id)}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Test Name</th>
                        <th>Exam Date</th>
                        <th>Syllabus</th>
                        <th>Total Question</th>
                        <th>Duration</th>
                        <th>Total Mark</th>
                        <th style="width:50px;">Positive Mark/Question</th>
                        <th style="width:50px;">Negative Mark/Question</th>
                        <th>Delete Question</th>
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
        ajax: "{{ url('/admin/exam/set/test/'.$exam->id) }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'exam_date', name: 'exam_date'},
            {data: 'exam_type', name: 'exam_type'},
            {data: 'total_question', name: 'total_question'},
            {data: 'duration', name: 'duration'},
            {data: 'mark', name: 'mark'},
            {data: 'positive_mark', name: 'positive_mark'},
            {data: 'negative_mark', name: 'negative_mark'},
            {data: "update",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a class="btn btn-danger btn-xs" href="{{url("admin/exam/delete-question/")}}/' + row.exam_id + '/' + row.id + '"><i class="fa fa-trash"></i> Delete Question</a>';
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
                        return '<form id="delete" action="{{url("admin/exam/delete/")}}/' + row.id + '"><button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete()"><i class="fa fa-trash"></i> Delete</a></form>';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                'defaultContent':'-'
            }
        ]
    });
});

function confirmDelete(){
    if(confirm("Do you really want to delete this record"))
    {
        $('#delete').submit();
    }
}
</script>
@endsection