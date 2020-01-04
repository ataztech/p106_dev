<!DOCTYPE html>
<html>
    <head> 
    <link rel="icon" type="image/png" href="<?php echo asset('public/theme1/images/1.png'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/theme1/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/theme1/css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/theme1/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/theme1/css/fontawesome.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/theme1/css/jquery.mCustomScrollbar.css')); ?>">
    <link href="<?php echo e(url('public/theme1/css/font-awesome.min.css')); ?>" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/theme1/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/theme1/css/responsive.css')); ?>">
    <title>Index</title><meta name="viewport" content="width=device-width,initial-scale=1.0">
    </head>
    <style>    
    .breadcrumb{     
    background:   rgba(0, 0, 0, 0) !important;     
    margin-bottom: 0px;    
    }    
    .breadcrumb-item{        
    font-weight:600;    
    }        
    .top_head{        
    padding: 0px 0px 0px 0px !important;    
    }        
    .logo-name{        
    float: right;    
    /* left: -47px; */   
    padding-top: 10px;    
    color: skyblue;    
    /* font-size: 23px; */    
    font-weight: 700;    
    }    
    </style>        
    <?php if(Request::segment(2)!='configure'): ?>
    <body class="dashboard">    
    <?php else: ?><body class="color_bg">        
    <?php endif; ?>
    <header class="top_head">  
    <div class="container-fluid">    
    <div class="row">      
    <div class="col-xs-3 col-sm-3 col-md-3">        
    <a href="http://localhost/ataz_live">                                              
    <div class="logo" style="width:242px"> <img src="<?php echo e(url('public/theme1/images/1.png')); ?>">           
    </a>              
    <?php if(Request::segment(2)=='configure'): ?>              
    <h3 class="logo-name" style="color:#2c86a2">ATAZ Learning</h3>              
    <?php else: ?>              <h3 class="logo-name" >ATAZ Learning</h3>              
    <?php endif; ?>          
    </div>              
    </div>        
    <div class="col-xs-9 col-sm-9 col-md-9" style="padding-top: 20px;">        
    <div class="prof_outer">          
    <div class="profile_pic">            
    <?php if(Auth::user()->profile_img==''): ?>            
    <img src="http://atazlearning.com/public/theme1/images/1.png">           
    <?php else: ?>            
    <img src="<?php echo e(url('storage/app/public/profile/'.Auth::user()->profile_img)); ?>">            
    <?php endif; ?>          
    </div>          
    <div class="profile_menu">                  
    <div class="media" style="cursor:pointer" onclick="window.location.href='<?php echo e(url('user/profile')); ?>'">                
    <div class="media-left text-left">                  
    <div class="profile_pic">                
    <?php if(Auth::user()->profile_img==''): ?>            
    <img src="http://atazlearning.com/public/theme1/images/1.png">           
    <?php else: ?>            
    <img src="<?php echo e(url('storage/app/public/profile/'.Auth::user()->profile_img)); ?>">            
    <?php endif; ?>                  
    </div>                
    </div>                
    <div class="media-body"><?php echo e(Auth::user()->name); ?><br/>                
    <?php if(isset(Auth::user()->ConfigureSyllabus)): ?>                    
    Class: <?php echo e(Auth::user()->ConfigureSyllabus->class); ?>                
    <?php endif; ?>                
    </div>                
    <div class="media-right">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>            
        </div>            
        <ul>              
        <li><a href="<?php echo e(url('user/syllabus')); ?>"><i class="fa fa-cubes" aria-hidden="true"></i>My Syllabus</a></li>
        <!--              <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>              
        <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Invite and Earn</a></li>              
        <li><a href="#"><i class="fa fa-facebook"></i>Share on Facebook</a></li>              
        <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Take a Tour</a></li>              
        <li><a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i>Updarde</a></li>-->              
        <!--<li><a href="<?php echo e(url('logout')); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>-->            
        </ul>          
        </div>         
        </div>          
        <div class="shadow_effect">            
        <div class="round">              
        <i class="fa fa-bell"></i>            
        </div>          
        </div>      
        </div>   
        </div>  
        </header>                
        <?php if(Request::segment(2)!='configure' ): ?>        
        <?php echo $__env->make('layouts.left-bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>        
        <?php endif; ?>        
        <?php echo $__env->yieldContent('content'); ?>                                
        <script src="<?php echo e(url('public/theme1/js/jquery.js')); ?>"></script> 
        <script src="<?php echo e(url('public/theme1/js/bootstrap.min.js')); ?>"></script> 
        <script src="<?php echo e(url('public/theme1/js/owl.carousel.min.js')); ?>"></script> 
        <script src="<?php echo e(url('public/theme1/js/custom.js')); ?>"></script>
        <script src="<?php echo e(url('public/theme1/js/jquery.mCustomScrollbar.min.js')); ?>"></script>
        <?php echo $__env->yieldContent('footer'); ?>
        <script>    
        (function($){        
        $(window).load(function(){
        // $(".content").mCustomScrollbar();        
        });    
            })(jQuery);        
        $('.profile_pic').click(function(){        
        $('body').toggleClass('open_prof');    
        });
        </script>
        </body>
        </html>