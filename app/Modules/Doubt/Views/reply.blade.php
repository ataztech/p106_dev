@extends('layouts.admin')
@section('title')
Doubt
@endsection
@section('content')
    <link href="{{url('/public/backend/css/doubt.css')}}" rel="stylesheet">
    <style>
        .mesgs{
            width: 100% !important;
        }
    </style>
<ul class="breadcrumb">
    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
    <li><a href="{{url('admin/doubt/list')}}">Doubt</a></li>
</ul>
<div class="messaging">
    <div class="inbox_msg">
        {{--<div class="inbox_people">--}}
            {{--<div class="headind_srch">--}}
                {{--<div class="recent_heading">--}}
                    {{--<h4>Recent</h4>--}}
                {{--</div>--}}
                {{--<div class="srch_bar">--}}
                    {{--<div class="stylish-input-group">--}}
                        {{--<input type="text" class="search-bar"  placeholder="Search" >--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="inbox_chat scroll">--}}
                {{--<div class="chat_list active_chat">--}}
                    {{--<div class="chat_people">--}}
                        {{--<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                        {{--<div class="chat_ib">--}}
                            {{--<h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>--}}
                            {{--<p>Test, which is a new approach to have all solutions--}}
                                {{--astrology under one roof.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="chat_list">--}}
                    {{--<div class="chat_people">--}}
                        {{--<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                        {{--<div class="chat_ib">--}}
                            {{--<h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>--}}
                            {{--<p>Test, which is a new approach to have all solutions--}}
                                {{--astrology under one roof.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="chat_list">--}}
                    {{--<div class="chat_people">--}}
                        {{--<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                        {{--<div class="chat_ib">--}}
                            {{--<h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>--}}
                            {{--<p>Test, which is a new approach to have all solutions--}}
                                {{--astrology under one roof.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="chat_list">--}}
                    {{--<div class="chat_people">--}}
                        {{--<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                        {{--<div class="chat_ib">--}}
                            {{--<h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>--}}
                            {{--<p>Test, which is a new approach to have all solutions--}}
                                {{--astrology under one roof.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="chat_list">--}}
                    {{--<div class="chat_people">--}}
                        {{--<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                        {{--<div class="chat_ib">--}}
                            {{--<h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>--}}
                            {{--<p>Test, which is a new approach to have all solutions--}}
                                {{--astrology under one roof.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="chat_list">--}}
                    {{--<div class="chat_people">--}}
                        {{--<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                        {{--<div class="chat_ib">--}}
                            {{--<h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>--}}
                            {{--<p>Test, which is a new approach to have all solutions--}}
                                {{--astrology under one roof.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="chat_list">--}}
                    {{--<div class="chat_people">--}}
                        {{--<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                        {{--<div class="chat_ib">--}}
                            {{--<h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>--}}
                            {{--<p>Test, which is a new approach to have all solutions--}}
                                {{--astrology under one roof.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="mesgs">
            <div class="msg_history">
                <div class="incoming_msg">
                    {{--<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="student"> </div>--}}
                    <div class="received_msg">
                        <div class="received_withd_msg">
                            <p>{!! htmlspecialchars_decode(htmlspecialchars_decode($doubt->question)) !!}</p>
                            <span class="time_date">Student  |  {{\Carbon\Carbon::parse($doubt->created_at)->format('g:i A')}}  |  {{$doubt->dateInWord($doubt->created_at)}}</span></div>
                    </div>
                </div>
                @foreach($doubt->replies as $reply)
                    @if($reply->reply_of)
                        <div class="outgoing_msg">
                            <div class="sent_msg">
                                <p>{!! htmlspecialchars_decode(htmlspecialchars_decode($reply->reply)) !!}</p>
                                <span class="time_date">Teacher  |  {{\Carbon\Carbon::parse($reply->created_at)->format('g:i A')}}  |  {{$doubt->dateInWord($reply->created_at)}}</span> </div>
                        </div>
                    @else
                        <div class="incoming_msg">
                            {{--<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="student"> </div>--}}
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p>{!! htmlspecialchars_decode(htmlspecialchars_decode($reply->reply)) !!}</p>
                                    <span class="time_date">Student  |  {{\Carbon\Carbon::parse($reply->created_at)->format('g:i A')}}  |  {{$doubt->dateInWord($reply->created_at)}}</span></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            {{--<div class="type_msg">--}}
                {{--<div class="input_msg_write">--}}
                    {{--<input type="text" class="write_msg" placeholder="Type a message" />--}}
                    {{--<button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
@endsection
@section('footer')
{{--<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>--}}
<script>
    CKEDITOR.config.toolbar_Full =
        [
            { name: 'document', items : [ 'Source'] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
            { name: 'editing', items : ['find'] },
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
            { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
        ];
    CKEDITOR.config.sharedSpaces = { top: 'toolbar1'};
    CKEDITOR.replace( 'emailtemplatedata', {
        extraPlugins: 'ckeditor_wiris',
        language: 'en',
        height : 300,
    });
</script>

@endsection


