<?php
$site_logo = \App\Modules\Models\GlobalValue::where('slug','site-logo')->pluck('value')->first();
?>
<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(asset('/storage/app/public/admin/site-logo/'.$site_logo)); ?>" alt="Site Logo"><?php echo e(Auth::user()->name); ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <?php if(Auth::user()->user_type == '1'): ?>
                      <li><a href="<?php echo e(url('/admin/profile')); ?>"><i class="fa fa-home pull-right"></i> Profile</a></li>
                      <li><a href="<?php echo e(url('/admin/logout')); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <?php else: ?>
                      <li><a href="<?php echo e(url('/telecaller/logout')); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <?php endif; ?>
                  </ul>
                </li>
              </ul>
            </nav> 
          </div>
        </div>