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
                  @if(Auth::user()->user_type == '1')
                  <li>
                      <a href="{{url('/admin/dashboard')}}"><i class="fa fa-home"></i> Home </a>
                  </li>
                    @else
                        <li>
                            <a href="{{url('/telecaller/dashboard')}}"><i class="fa fa-home"></i> Home </a>
                        </li>
                     @endif
                  
                  @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.module'))
                  <li class="@if($segment_value === 'module') current-page @endif">
                      <a href="{{url('/admin/module/list')}}"><i class="fa fa-lock"></i> Manage Module </a>
                  </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.module'))
                    <li class="@if($segment_parameter == 'users') active @endif"><a><i class="fa fa-users"></i> Manage Users <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="@if($segment_parameter == 'users')display: block;@endif">
                            @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.users'))
                                <li class="@if($segment_value === 'user') current-page @endif"><a href="{{url('/admin/user/list')}}">Manage Admin Users</a></li>
                            @endif

                            @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.students'))
                                <li class="@if($segment_value === 'student') current-page @endif"><a href="{{url('/admin/student/list')}}">Manage Students</a></li>
                            @endif

	       @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.teachers'))
                                <li class="@if($segment_value === 'teacher') current-page @endif"><a href="{{url('/admin/teacher/list')}}">Manage Teachers</a></li>
                            @endif
                            
                            @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.teachers'))
                                    <li class="@if($segment_value === 'telecaller') current-page @endif"><a href="{{url('/admin/telecaller/list')}}">Manage Telecaller</a></li>
                                @endif
                        </ul>
                    </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.module'))
                    <li class="@if($segment_parameter == 'roles') active @endif"><a><i class="fa fa-lock"></i> Manage Roles <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="@if($segment_parameter == 'users')display: block;@endif">

                            @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.role'))
                                <li class="@if($segment_value === 'role') current-page @endif">
                                    <a href="{{url('/admin/role/list')}}"> Manage Admin Roles </a>
                                </li>
                            @endif

                            @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.package-role'))
                                <li class="@if($segment_value === 'package-role') current-page @endif">
                                    <a href="{{url('/admin/package-role/list')}}"> Manage Package Roles </a>
                                </li>
                            @endif
                            
                            @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.role'))
                                    <li class="@if($segment_value === 'telecaller-role') current-page @endif">
                                        <a href="{{url('/admin/telecaller-role/list')}}"> Manage Telecaller Roles </a>
                                    </li>
                                @endif

                        </ul>
                    </li>
                    @endif
	@if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.doubts'))
                        <li>
                            <a href="{{url('/admin/doubt/list')}}"><i class="fa fa-comments"></i> Doubts </a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.global.values'))
                    <li>
                        <a href="{{url('/admin/manage-global-value')}}"><i class="fa fa-globe"></i> Manage Global Values </a>
                    </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.emailtemplate'))
                        <li>
                            <a href="{{url('/admin/emailtemplate/list')}}"><i class="fa fa-envelope"></i> Manage Email Templates </a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.cms'))
                    <li>
                        <a href="{{url('/admin/cms/list')}}"><i class="fa fa-file"></i> Manage Cms Pages </a>
                    </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.demos'))
                        <li class="@if($segment_value === 'demo') current-page @endif">
                            <a href="{{url('/telecaller/demo/list')}}"><i class="fa fa-file"></i> Manage Demos </a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.price'))
                    <li>
                        <a href="{{url('/admin/price/list')}}"><i class="fa fa-file"></i> Manage Prices </a>
                    </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.contactus'))
                        <li>
                            <a href="{{url('/admin/contactus/list')}}"><i class="fa fa-mobile"></i> Manage Contact Us </a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.faqs'))
                    <li>
                        <a href="{{url('/admin/faq/list')}}"><i class="fa fa-question"></i> Manage FAQs </a>
                    </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards'))
                    <li class="@if($segment_value === 'standard') current-page @endif">
                        <a href="{{url('/admin/standard/list')}}"><i class="fa fa-building"></i> Manage Standards</a>
                    </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.subjects'))
                        <li class="@if($segment_value === 'subject') current-page @endif">
                            <a href="{{url('/admin/subject/list')}}"><i class="fa fa-building"></i> Manage Subjects</a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.chapters'))
                        <li class="@if($segment_value === 'chapter') current-page @endif">
                            <a href="{{url('/admin/chapter/list')}}"><i class="fa fa-building"></i> Manage Chapters</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.topics'))
                        <li class="@if($segment_value === 'topic') current-page @endif">
                            <a href="{{url('/admin/topic/list')}}"><i class="fa fa-building"></i> Manage Topics</a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.concepts'))
                        <li class="@if($segment_value === 'concept') current-page @endif">
                            <a href="{{url('/admin/concept/list')}}"><i class="fa fa-building"></i> Manage Concepts</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.question-answers'))
                        <li class="@if($segment_value === 'question-answer') current-page @endif">
                            <a href="{{url('/admin/question-answer/list')}}"><i class="fa fa-building"></i> Manage Question & Answers</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.question-answer-sets'))
                        <li class="@if($segment_value === 'question-answer-set') current-page @endif">
                            <a href="{{url('/admin/question-answer-set/list')}}"><i class="fa fa-building"></i> Question & Answer Sets</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.question-answers'))
                        <li class="@if($segment_value === 'video') current-page @endif">
                            <a href="{{url('/admin/video/list')}}"><i class="fa fa-building"></i> Manage Video</a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.exams'))
                    <li class="@if($segment_value === 'exam') current-page @endif">
                        <a href="{{url('/admin/exam/list')}}"><i class="fa fa-book"></i> Manage Competitive Exams</a>
                    </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.boards'))
                    <li class="@if($segment_value === 'board') current-page @endif">
                        <a href="{{url('/admin/board/list')}}"><i class="fa fa-university"></i> Manage Boards</a>
                    </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards'))
                        <li class="@if($segment_value === 'counsellor') current-page @endif">
                            <a href="{{url('/admin/counsellor/list')}}"><i class="fa fa-users"></i> Manage Counsellor</a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards'))
                        <li class="@if($segment_value === 'sales') current-page @endif">
                            <a href="{{url('/admin/sales/list')}}"><i class="fa fa-users"></i> Manage Sales</a>
                        </li>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards'))
                        <li class="@if($segment_value === 'payment') current-page @endif">
                            <a href="{{url('/admin/payment/list')}}"><i class="fa fa-money"></i> View Payments</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards'))
                        <li class="@if($segment_value === 'login-history') current-page @endif">
                            <a href="{{url('/admin/login-history/list')}}"><i class="fa fa-users"></i> Login History</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards'))
                        <li class="@if($segment_value === 'leads') current-page @endif">
                            <a href="{{url('/admin/leads/list')}}"><i class="fa fa-users"></i> Manage Leads</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards'))
                        <li class="@if($segment_value === 'gallery') current-page @endif">
                            <a href="{{url('admin/gallery/list')}}"><i class="fa fa-users"></i> Manage Gallery</a>
                        </li>
                    @endif



                </ul>
              </div>

            </div>
      
          </div>
        </div>