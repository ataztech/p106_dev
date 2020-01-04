@extends('layouts.admin')
@section('title')
Question & Answer Sets
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Question & Answer Sets</a></li>
</ul>

@if(Session::has('success'))
    <span id="notification" data-type="success" data-msg="{{Session::get('success')}}"></span>
@endif
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Question & Answer Sets</h2>
                    <div class="clearfix"></div>
                  </div>
                    
                    <div>
                        <div class="col-md-4">
                            <label class="control-label">Select Standard</label>
                            <select class="form-control" id="standard" onchange="getSubjects()">
                                @foreach($standards as $standard)
                                <option value="{{$standard->id}}">{{$standard->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Select Subject</label>
                            <select class="form-control" id="subject" onchange="getChapters()">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Select Chapter</label>
                            <select class="form-control" id="chapter" name="chapter_id">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <div class="pull-right">
                                <button class="btn btn-primary" onclick="getResult()"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Chapter Name</th>
                        <th>Subject Name</th>
                        <th>Class</th>
                        <th>Top 10 Questions</th>
                        <th>NCRT Solution</th>
                        <th>Previous Question Papers</th>
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
    var queTable = '';
$(document).ready(function () {
    getSubjects();
    queTable = $('#users').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url":"{{url('/admin/question-answer-set/data')}}",
            data:function(d){
                d.chapter_id = $('#chapter').val();
            }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'subject', name: 'subject'},
            {data: 'standard', name: 'standard'},
            {data: 'topten', name: 'topten'},
            {data: "ncrt",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a href="{{url("admin/question-answer-sets/ncrt-solutions/")}}/' + row.id + '" class="btn btn-warning btn-xs">NCRT Solutions</a>';
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                'defaultContent':'-'
            },
            {data: "previous_questions",
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<a href="{{url("admin/question-answer-sets/previous-questions/")}}/' + row.id + '" class="btn btn-green btn-xs">Previous Question Paper</a>';
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

function getSubjects()
        {
            var standard = $('#standard').val();
            $('#subject').html('');
            $.ajax({
                url: "get/subject",
                method:'GET',
                data:{
                    standard : standard
                },
                success: function(result){
                    for(var i =0; i < result.length; i++)
                    {
                        $('#subject').append('<option value="'+result[i].id+'">'+result[i].name+'</option>');
                    }
                    getChapters();
                }});
        }
        
        function getChapters()
        {
            var subject = $('#subject').val();
            $('#chapter').html('');
            $.ajax({
                url: "get/chapter",
                method:'GET',
                data:{
                    subject : subject
                },
                success: function(result){
                    for(var i =0; i < result.length; i++)
                    {
                        $('#chapter').append('<option value="'+result[i].id+'">'+result[i].name+'</option>');
                    }
                    getResult();
                }});
        }
        
        function getResult()
        {
            var chapter = $('#chapter').val();
            
            if(chapter == null)
            {
                alert('Please Select all Three Fields');
            }
            else
            {
                queTable.draw();
            }
        }
</script>
@endsection