<header class="top_head" >
    
  
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2"><a href="<?php echo e(url('/')); ?>">
                    <div class="logo"><img src="<?php echo e(url('/public/theme1')); ?>/images/1.png"></div>
                </a></div>
            <div class="col-md-10 col-sm-10 col-xs-6" style="padding: 18px">

                <?php if(!Auth::check()): ?>
                    <div class="login_btn"><a type="button" data-toggle="modal" data-target="#login" href="#">Login</a>
                    </div>
                    <div class="login_btn"><a type="button" data-toggle="modal" data-target="#registration" href="#">Sign Up</a>
                    </div>
                    <?php else: ?>
                    <?php if(Auth::user()->user_type == 1): ?>

                        <div class="login_btn"><a type="button" href="admin/dashboard">Dashboard</a>
                        </div>
                        <div class="login_btn"><a type="button" href="<?php echo e(url('admin/logout')); ?>">Logout</a>
                        </div>
                        <?php else: ?>
                        <div class="login_btn"><a type="button" href="dashboard">Dashboard</a>
                        </div>
                        <div class="login_btn"><a type="button" href="<?php echo e(url('/logout')); ?>">Logout</a>
                        </div>
                        <?php endif; ?>

                <?php endif; ?>
                    <div class="login_btn"><a type="button" data-toggle="modal" data-target="#payment_detail" href="#">Pay Now</a>
                    </div>




                <nav><a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>
                    <ul class="menu">
                        <li><a href="#"> CLASSES</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo e(url('class-11')); ?>">11th</a></li>
                                <li><a href="<?php echo e(url('class-12')); ?>">12th</a></li>
                            </ul>
                        </li>
                        <li><a href="#"> EXAMS</a>
                            <ul class="sub-menu">
                                <li><a href="#">Board Exams</a>
                                    <ul>
                                        <li><a href="<?php echo e(url('cbsc')); ?>">CBSC</a></li>
                                        <li><a href="<?php echo e(url('maharashtra-board')); ?>">MAHARASHTRA BOARD</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Engineering</a>
                                    <ul>
                                        <li><a href="<?php echo e(url('jee-main')); ?>">JEE Main</a></li>
                                        <li><a href="<?php echo e(url('jee-advanced')); ?>">JEE Advanced</a></li>
                                        <li><a href="<?php echo e(url('engeering-mht-cet')); ?>">MHT CET</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Medical</a>
                                    <ul>
                                        <li><a href="<?php echo e(url('medical-neet')); ?>">NEET</a></li>
                                        <li><a href="<?php echo e(url('medical-mht-cet')); ?>">MHT CET</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(url('price/details')); ?>"> PRICING</a></li>
                        <li><a href="<?php echo e(url('/contact-us')); ?>"> CONTACT US</a></li>
                        <li><a href="<?php echo e(url('/about-us')); ?>">ABOUT US</a></li>
                    </ul>
                </nav>
            </div>
        </div>
</header>