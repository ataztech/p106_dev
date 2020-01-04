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
                <a class="site_title"><img width="40px" src="<?php echo e(url('/public/frontend/img/a.png')); ?>"> <span><?php echo e($site_title); ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                  <img src="<?php echo e(asset('/storage/app/public/admin/site-logo/'.$site_logo)); ?>" alt="Site Logo" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo e(Auth::user()->name); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <?php if(Auth::user()->user_type == '1'): ?>
                  <li>
                      <a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-home"></i> Home </a>
                  </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo e(url('/telecaller/dashboard')); ?>"><i class="fa fa-home"></i> Home </a>
                        </li>
                     <?php endif; ?>
                  
                  <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.module')): ?>
                  <li class="<?php if($segment_value === 'module'): ?> current-page <?php endif; ?>">
                      <a href="<?php echo e(url('/admin/module/list')); ?>"><i class="fa fa-lock"></i> Manage Module </a>
                  </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.module')): ?>
                    <li class="<?php if($segment_parameter == 'users'): ?> active <?php endif; ?>"><a><i class="fa fa-users"></i> Manage Users <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="<?php if($segment_parameter == 'users'): ?>display: block;<?php endif; ?>">
                            <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.users')): ?>
                                <li class="<?php if($segment_value === 'user'): ?> current-page <?php endif; ?>"><a href="<?php echo e(url('/admin/user/list')); ?>">Manage Admin Users</a></li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.students')): ?>
                                <li class="<?php if($segment_value === 'student'): ?> current-page <?php endif; ?>"><a href="<?php echo e(url('/admin/student/list')); ?>">Manage Students</a></li>
                            <?php endif; ?>

	       <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.teachers')): ?>
                                <li class="<?php if($segment_value === 'teacher'): ?> current-page <?php endif; ?>"><a href="<?php echo e(url('/admin/teacher/list')); ?>">Manage Teachers</a></li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.teachers')): ?>
                                    <li class="<?php if($segment_value === 'telecaller'): ?> current-page <?php endif; ?>"><a href="<?php echo e(url('/admin/telecaller/list')); ?>">Manage Telecaller</a></li>
                                <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.module')): ?>
                    <li class="<?php if($segment_parameter == 'roles'): ?> active <?php endif; ?>"><a><i class="fa fa-lock"></i> Manage Roles <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="<?php if($segment_parameter == 'users'): ?>display: block;<?php endif; ?>">

                            <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.role')): ?>
                                <li class="<?php if($segment_value === 'role'): ?> current-page <?php endif; ?>">
                                    <a href="<?php echo e(url('/admin/role/list')); ?>"> Manage Admin Roles </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.package-role')): ?>
                                <li class="<?php if($segment_value === 'package-role'): ?> current-page <?php endif; ?>">
                                    <a href="<?php echo e(url('/admin/package-role/list')); ?>"> Manage Package Roles </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.role')): ?>
                                    <li class="<?php if($segment_value === 'telecaller-role'): ?> current-page <?php endif; ?>">
                                        <a href="<?php echo e(url('/admin/telecaller-role/list')); ?>"> Manage Telecaller Roles </a>
                                    </li>
                                <?php endif; ?>

                        </ul>
                    </li>
                    <?php endif; ?>
	<?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.doubts')): ?>
                        <li>
                            <a href="<?php echo e(url('/admin/doubt/list')); ?>"><i class="fa fa-comments"></i> Doubts </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.global.values')): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/manage-global-value')); ?>"><i class="fa fa-globe"></i> Manage Global Values </a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.emailtemplate')): ?>
                        <li>
                            <a href="<?php echo e(url('/admin/emailtemplate/list')); ?>"><i class="fa fa-envelope"></i> Manage Email Templates </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.cms')): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/cms/list')); ?>"><i class="fa fa-file"></i> Manage Cms Pages </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.demos')): ?>
                        <li class="<?php if($segment_value === 'demo'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/telecaller/demo/list')); ?>"><i class="fa fa-file"></i> Manage Demos </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.price')): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/price/list')); ?>"><i class="fa fa-file"></i> Manage Prices </a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.contactus')): ?>
                        <li>
                            <a href="<?php echo e(url('/admin/contactus/list')); ?>"><i class="fa fa-mobile"></i> Manage Contact Us </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.faqs')): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/faq/list')); ?>"><i class="fa fa-question"></i> Manage FAQs </a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards')): ?>
                    <li class="<?php if($segment_value === 'standard'): ?> current-page <?php endif; ?>">
                        <a href="<?php echo e(url('/admin/standard/list')); ?>"><i class="fa fa-building"></i> Manage Standards</a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.subjects')): ?>
                        <li class="<?php if($segment_value === 'subject'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/subject/list')); ?>"><i class="fa fa-building"></i> Manage Subjects</a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.chapters')): ?>
                        <li class="<?php if($segment_value === 'chapter'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/chapter/list')); ?>"><i class="fa fa-building"></i> Manage Chapters</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.topics')): ?>
                        <li class="<?php if($segment_value === 'topic'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/topic/list')); ?>"><i class="fa fa-building"></i> Manage Topics</a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.concepts')): ?>
                        <li class="<?php if($segment_value === 'concept'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/concept/list')); ?>"><i class="fa fa-building"></i> Manage Concepts</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.question-answers')): ?>
                        <li class="<?php if($segment_value === 'question-answer'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/question-answer/list')); ?>"><i class="fa fa-building"></i> Manage Question & Answers</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.question-answer-sets')): ?>
                        <li class="<?php if($segment_value === 'question-answer-set'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/question-answer-set/list')); ?>"><i class="fa fa-building"></i> Question & Answer Sets</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.question-answers')): ?>
                        <li class="<?php if($segment_value === 'video'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/video/list')); ?>"><i class="fa fa-building"></i> Manage Video</a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.exams')): ?>
                    <li class="<?php if($segment_value === 'exam'): ?> current-page <?php endif; ?>">
                        <a href="<?php echo e(url('/admin/exam/list')); ?>"><i class="fa fa-book"></i> Manage Competitive Exams</a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.boards')): ?>
                    <li class="<?php if($segment_value === 'board'): ?> current-page <?php endif; ?>">
                        <a href="<?php echo e(url('/admin/board/list')); ?>"><i class="fa fa-university"></i> Manage Boards</a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards')): ?>
                        <li class="<?php if($segment_value === 'counsellor'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/counsellor/list')); ?>"><i class="fa fa-users"></i> Manage Counsellor</a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards')): ?>
                        <li class="<?php if($segment_value === 'sales'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/sales/list')); ?>"><i class="fa fa-users"></i> Manage Sales</a>
                        </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards')): ?>
                        <li class="<?php if($segment_value === 'payment'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/payment/list')); ?>"><i class="fa fa-money"></i> View Payments</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards')): ?>
                        <li class="<?php if($segment_value === 'login-history'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/login-history/list')); ?>"><i class="fa fa-users"></i> Login History</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards')): ?>
                        <li class="<?php if($segment_value === 'leads'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('/admin/leads/list')); ?>"><i class="fa fa-users"></i> Manage Leads</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->isAdmin() || Auth::user()->hasPermission('view.standards')): ?>
                        <li class="<?php if($segment_value === 'gallery'): ?> current-page <?php endif; ?>">
                            <a href="<?php echo e(url('admin/gallery/list')); ?>"><i class="fa fa-users"></i> Manage Gallery</a>
                        </li>
                    <?php endif; ?>



                </ul>
              </div>

            </div>
      
          </div>
        </div>