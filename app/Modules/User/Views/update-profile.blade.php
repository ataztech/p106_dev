@extends('layouts.app-dashboard')
<title>My Syllabus</title>
@section('content')
                   
<div class="main_dash_right">
    <div class="motion_tab profile_tab">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">Edit Profile</a></li>
        <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Change Password</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home"> 
            <form method="post" action="" enctype="multipart/form-data">
         <!--  <h4>Edit Profile</h4> -->
          <div class="profile_update">
              @if(Auth::user()->profile_img=='')
            <img src="http://atazlearning.com/public/theme1/images/1.png">
            @else
            <img src="{{url('storage/app/public/profile/'.Auth::user()->profile_img)}}">
            @endif
            <div class="cam_icon">
             <i class="fa fa-camera" aria-hidden="true"></i>
             <input type="file" name="profile">
            </div>
          </div>
          <div class="general_detl">
            <h2>General Details</h2>
            <div class="all_form">
             @if(Session::has('success'))
                
                
             <span style="color:green">{{Session::get('success')}}</span>
             <br>
                @php
                Session::forget('success');
                @endphp
                @endif
                <input type="text" required="" name="name" placeholder="Name" value="{{Auth::user()->name}}">
                <input type="text" readonly name="mobile"   placeholder="Mobile Number" value="{{Auth::user()->mobile}}">
                @if(Session::has('error'))
                <br>
                <span style="color:red">{{Session::get('error')}}</span>
                @php
                Session::forget('error');
                @endphp
                @endif
                <br>
                <button class="btn_all" type="submit">Update</button>
            </div>
          </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile">
              
              <form method="post" action="{{url('user/update-password')}}" enctype="multipart/form-data" onsubmit="return confirmPassword();">
         <!--  <h4>Edit Profile</h4> -->
          <div class="profile_update">
              @if(Auth::user()->profile_img=='')
            <img src="http://atazlearning.com/public/theme1/images/1.png">
            @else
            <img src="{{url('storage/app/public/profile/'.Auth::user()->profile_img)}}">
            @endif
            
          </div>
          <div class="general_detl">
            <h2>Change Password</h2>
            <div class="all_form">
             @if(Session::has('success'))
                
                
             <span style="color:green">{{Session::get('success')}}</span>
             <br>
                @php
                Session::forget('success');
                @endphp
                @endif
                <input type="password" required="" name="new_password" id="new_pwd"   placeholder="New Password" value="">
                <input type="password" required="" name="confirm_password" id='con_pwd' placeholder="Confirm Password" value="">
                @if(Session::has('error'))
                <br>
                <span style="color:red">{{Session::get('error')}}</span>
                @php
                Session::forget('error');
                @endphp
                @endif
                <br>
                <button class="btn_all" type="submit">Update</button>
            </div>
          </div>
            </form>
          </div>
        <div role="tabpanel" class="tab-pane" id="messages">...</div>
        <div role="tabpanel" class="tab-pane" id="settings">...</div>
      </div>

    </div>
  </div>
<script>
    function confirmPassword()
    {
        if($("#new_pwd").val() == $("#con_pwd").val())
        {
            return true;
        }
        alert("Password do not match.");
            return false;
    }
    </script>
@endsection