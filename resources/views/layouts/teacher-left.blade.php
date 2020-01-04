<?php
$site_logo = \App\Modules\Models\GlobalValue::where('slug','site-logo')->pluck('value')->first();
$site_title = \App\Modules\Models\GlobalValue::where('slug','site-title')->pluck('value')->first();
$segment_value = Request::segment(2);
$segment_parameter = '';
switch ($segment_value)
    {
    case 'user':
        $segment_parameter = 'users';
        break;

    case 'student':
        $segment_parameter = 'users';
        break;

    case 'role':
        $segment_parameter = 'roles';
        break;

    case 'package-role':
        $segment_parameter = 'roles';
        break;
}
//dd($segment_value,$segment_parameter);
?>
<div class="col-md-3 left_col gradient">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a class="site_title"><img width="40px" src="{{url('/public/frontend/img/a.png')}}"> <span>{{$site_title}}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                  <img src="{{asset('/storage/app/public/admin/site-logo/'.$site_logo)}}" alt="Site Logo" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li>
                      <a href="{{url('/teacher/dashboard')}}"><i class="fa fa-home"></i> Home </a>
                  </li>
                    <li>
                        <a href="{{url('/teacher/doubt/list')}}"><i class="fa fa-comments"></i> Doubts </a>
                    </li>
                </ul>
              </div>

            </div>
      
          </div>
        </div>