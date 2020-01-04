    <div id="test-list-{{$request->chapter}}">
        <table border="1" class="table">
            @foreach($all_questions as $index=>$question)
            <tr>
                <td rowspan="2" style="width:30px;">
                    <input data-subject_id="{{$question->topic->chapter->subject->id}}" class="cls_chk question_{{$question->topic->chapter->subject->id}}" onclick="showTotalSelectedQuestionSubjectWise({{$question->topic->chapter->subject->id}},{{$question->id}}),showTotalSelectedQuestion({{$question->id}}, this)" type="checkbox" value="{{$question->id}}" id="{{$question->id}}" name="{{$question->topic->chapter->subject->id}}" ></td>
                <td>
                    <p class="name" id="question_{{$question->id}}">
                    {!! htmlspecialchars_decode(htmlspecialchars_decode($question->question)) !!}
                    </p>
                </td>
                
            </tr>
            <tr>
                
                
                <td><h1>Reason:</h1> {!! htmlspecialchars_decode($question->reason) !!} </td>
                
            </tr>
            <tr>
                
                <td></td>
                <td>{{isset($question->topic->chapter->subject)?$question->topic->chapter->subject->name:''}} / {{isset($question->topic->chapter)?$question->topic->chapter->name:''}}</td>
                
            </tr>
            @endforeach
                        </table>
        <ul class="pagination" onclick="checkQuestionIsAdded()"></ul>
    </div>

<div class="col-md-12">

</div>