@extends('layouts.admin')
@section('title')
Exams
@endsection
@section('content')
<ul class="breadcrumb">
    <li><a href="{{url('customer/dashboard')}}">Dashboard</a></li>
    <li><a href="javascript:void(0)">Manage Exams</a></li>
</ul>

@if(Session::has('success'))
    <span id="notification" data-type="success" data-msg="{{Session::get('success')}}"></span>
@endif

   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Exams</h2>
                      <div class="pull-right">
                          <a href="{{url('admin/test/add-new-questions/'.Request::segment(4).'/'.Request::segment(5))}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Questions</a>
                          <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteSelectedCheckbox();"><i class="fa fa-trash"></i> Delete Selected Questions</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">
                        <table id="users" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <th>Question</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
        @php
          $used_subject_ids = [];
          @endphp
  @foreach($question_answer as  $index=>$qa)
      @foreach($all_test_subject_ids as  $objSubjectId)
  @if( !in_array($qa->topic->chapter->subject->name, $used_subject_ids))
  <tr>
      <td colspan="2">
          <h3>{{$qa->topic->chapter->subject->name}}</h3>
          
      </td>
</tr>    
          @php
            $used_subject_ids[] = $qa->topic->chapter->subject->name;
          @endphp
     @endif
          @endforeach
          <tr>
              <td id="qa-{{$qa->id}}"  data-index="{{$index}}">
                  <input type="checkbox" value="{{$qa->id}}" name="question_id[]" class="checkbox_ids"> {{($index+1)>9?($index+1):"0".($index+1) }}
              </td>
              <td>{!!str_replace("undefined","",html_entity_decode($qa->question))!!}
                  <br>
                  <h3>{{$qa->topic->chapter->subject->standard->name}} /{{$qa->topic->chapter->subject->name}} / {{$qa->topic->chapter->name}} </h3>
              </td>
          </tr>
@endforeach
                          
                      </tbody>
                    </table>

          
          
          
        
					
					
                  </div>
                </div>
              </div>
@endsection
@section('footer')
<script src="{{url('/public/backend/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#users').DataTable();
});

function confirmDelete(){
    if(confirm("Do you really want to delete this record"))
    {
        $('#delete').submit();
    }
}

function deleteSelectedCheckbox()
{
    if($(".checkbox_ids:checked").length==0)
    {
        alert("Please select atleast one question?");
        return;
    }
    
    var questions = [];
    
    $(".checkbox_ids:checked").each(function () {
    questions.push($(this).val());
});

            $.ajax({
                    url: "{{url('admin/delete/test/question')}}",
                    method:'POST',
                    data:{
                        questions : questions,
                        exam_id: {{Request::segment(4)}},
                        test_id: {{Request::segment(5)}},
                    },
                    success: function(result){
                        window.location.reload();
                    }});
}

</script>
@endsection