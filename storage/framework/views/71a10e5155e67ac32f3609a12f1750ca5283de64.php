<?php $__env->startSection('title'); ?>
    ATAZ Learning
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<style>
    .photostack {
    background: #9ce9f8 !important;
        
    }
    .photostack figure{
    box-shadow: -2px 0px 16px 0px rgba(0,0,0,0.75);
        
    }
</style>

 <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/css/demo.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/css/component.css')); ?>" />
        <script src="<?php echo e(url('public/js/modernizr.min.js')); ?>"></script>

<section class="first_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                
                <div>
                    <img style="width: 38%;margin-left: 34%;" src="<?php echo e(url('/public/theme1')); ?>/images/bulb.png">
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="banner_left">
                    <h1>What does it mean to teach <br/>digital literacy to today's  <br/> students?</h1>
                    <div class="phone-list">

                <form id="subscribers_form">
            					<?php echo e(csrf_field()); ?>

                        <div class="input-group phone-input">
            			<span class="input-group-btn">
              			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="type-text">91+</span> <span class="caret"></span></button>
              			<ul class="dropdown-menu" role="menu">
                <!-- <li><a class="changeType" href="javascript:;" data-type-value="phone">Phone</a></li>
                <li><a class="changeType" href="javascript:;" data-type-value="fax">Fax</a></li>
                <li><a class="changeType" href="javascript:;" data-type-value="mobile">Mobile</a></li> -->
              			</ul>
            			</span>
                            <input type="hidden" name="phone[1][type]" class="type-input" value="" />
                            <input type="text" id="subscriber_contact_number" name="subscriber_contact_number" class="form-control" placeholder="+1 (999) 999 9999" />
                            <div class="wrapper_btn clearfix">
                                <button class="btn10" type="submit" id="subscribe_btn"> Submit</button>
                            </div>

                        </div>
                        <label for="subscriber_contact_number" generated="true" class="text-danger"></label>
                            </form>
                            
                        <div class="clearfix"></div>
                        <div class="get_on clearfix">
                            <span>Download Now</span>
                            
                            <ul class="clearfix">
                                
                                <li>
                                    <a href="<?php echo e(url('/atazlearning.apk')); ?>" download><img src="<?php echo e(url('/public/theme1')); ?>/images/iconfinder2.png"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="media explor_video">
                            <div class="media-left">
                                <img src="<?php echo e(url('/public/theme1')); ?>/images/video3.jpg">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <h4>See how ATAZLearning Works</h4>
                                <p>Explore the amazing world of ATAZLearning</p>
                            </div>
                        </div>
                    </div>

                    <!-- 		<div class="wrapper_btn clearfix">
                                <a class="btn10" href="">Read More</a>
                                <a class="btn10" href="">Read More</a>
                            </div> -->
                </div>

            </div>
        </div>
    </div>
</section>
<section class="second_sec">
    <div class="container">
        <div class="learn_inner">
            <h2 class="home_head"> Easy and Proper Learning </h2>
            <p class="home_para"> Education is the passport to the future, for tomorrow belongs to those who prepare for it today. </p>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon">
                            <i class="fa fa-play"></i>
                        </div>
                        <h3>Video Lectures</h3>
                        <p>Visual learning is easy to understand and memorise. </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon learn_1">
                            <i class="fa fa-pen-square"></i>
                        </div>
                        <h3>Practice</h3>
                        <p><?php echo e(ucfirst("Let's start preparing for exam with huge question bank and know your accuracy and speed.")); ?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon learn_2">
                            <i class="fa fa-file"></i>
                        </div>
                        <h3>Test Series</h3>
                        <p><?php echo e(ucfirst('Get the live  environment of entrance exams way before the actual entrance.')); ?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="learn_block">
                        <div class="learn_icon learn_3">
                            <i class="fa fa-comments"></i>
                        </div>
                        <h3>Ask Doubts</h3>
                        <p><?php echo e(ucfirst('When you study well you get doubts but do you have mentor around ? Our mentors are  a click away.')); ?></p>
                    </div>
                </div>

            </div>
        </div>
</section>
<section class="third_sec">
    <div class="container">
        <h2 class="home_head">Easy and Proper Learning</h2>
        <p class="home_para">Learn every concept visually for a strong foundation Learn every concept visually for a strong foundation</p>
        <div class="clases_outer">
            <div class="media">
                <div class="media-left">
                    <img src="<?php echo e(url('/public/theme1')); ?>/images/class-11.svg">
                </div>
                <div class="media-body">
                    <h4>Class 11</h4>
                    <p>11th is the base of 12th . If you want to score good in 12th then focus on 11th .</p>
                    
                        
                        
                        
                    
                    <div class="classes_btns wrapper_btn">
                        
                        <a href="<?php echo e(url('class-11')); ?>" class="btn10">Know More</a>
                    </div>
                </div>
            </div>
            <div class="media class_12">
                <div class="media-body">
                    <h4>Class 12</h4>
                    <p>12th is your life's turning point want to succeed in your life then get good percentage in 12th. Let's start preparation.</p>
                    
                        
                        
                        
                    
                    <div class="classes_btns wrapper_btn">
                        
                        <a href="<?php echo e(url('class-12')); ?>" class="btn10">Know More</a>
                    </div>
                </div>
                <div class="media-right">
                    <img src="<?php echo e(url('/public/theme1')); ?>/images/class-12.svg">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="features">
    <div class="container">
        <h2 class="home_head">Features</h2>
        <p class="home_para">Get all Definitions, Formulas and Diagrams</p>
        <div class="features_inner">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="featr_block featr_left">
                        <div class="featur_icon icon_margin">
                            <img src="<?php echo e(url('/public/theme1')); ?>/images/Mobile-App.jpg">
                        </div>
                        <h4>Bookmarks</h4>
                        <p>The important notes on your fingerprint.</p>
                        <div class="featur_icon">
                            <img src="<?php echo e(url('/public/theme1')); ?>/images/Mobile-App.jpg">
                        </div>
                        <h4>Accuracy</h4>
                        <p>Help you to know exactly how much %  your chapter is clear</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="featr_block featr_right">

                        <h4>Concepts</h4>
                        <p>Get all Definitions, Formulas and Diagrams.</p>
                        <div class="featur_icon">
                            <img src="<?php echo e(url('/public/theme1')); ?>/images/Mobile-App.jpg">
                        </div>

                        <h4>Speed</h4>
                        <p>Help you to know your per hours question solving count .</p>
                        <div class="featur_icon">
                            <img src="<?php echo e(url('/public/theme1')); ?>/images/Mobile-App.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        $current_year = \Carbon\Carbon::now()->format('Y');
        $price = App\Modules\Price\Models\Price::where('year',$current_year)->first();
        if(!$price)
        $price = App\Modules\Price\Models\Price::first();
        ?>
<section class="pricing_sec">
    <div class="container">
        <h2 class="home_head">Easy and Proper Learning</h2>
        <p class="home_para">Education is the passport to the future, for tomorrow belongs to those who prepare for it today.</p>
        <div class="pricing-grids">
                
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">GOLD</a></h3>
                    
                 

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Practice </a></li>
                        <li><a href="#">Test Series</a></li>
                        
                        
                        
                    </ul>
                    <div class="cart2">
                        <a class="popup-with-zoom-anim" href="<?php echo e(url('price/details')); ?>">More Details</a>
                    </div>
                </div>
            </div>
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">DIAMOND</a></h3>
                    
                    <div class="sale-box two">
                        <span class="on_sale title_shop">NEW</span>
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        <li class="whyt"><a href="#">Test Series </a></li>
                        
                        
                    </ul>
                    <div class="cart2">
                        <a class="popup-with-zoom-anim" href="<?php echo e(url('price/details')); ?>">More Details</a>
                    </div>
                </div>
            </div>
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">PLATINUM</a></h3>
                    <h5>
                        <lable><b><?php echo e($price->platinum); ?></b></lable>
                    </h5>
                    <div class="sale-box two">
                        <!--<span class="on_sale title_shop">NEW</span>-->
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        <li class="whyt"><a href="#">Test Series </a></li>
                        <li><a href="#">Doubts </a></li>
                        
                    </ul>
                    <div class="cart2">
                        <a class="popup-with-zoom-anim" href="<?php echo e(url('price/details')); ?>">More Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pricing_sec">
    <div class="container">
        <div class="pricing-grids">

            <div class="pricing-grid2" style="width:30%">
                <div class="price-value two">
                    <h3><a href="#">Happy Students</a></h3>
                    <h5>
                        <lable style="font-size:30px"><b><?php echo e(App\User::count()+10300); ?></b></lable>
                    </h5>
                </div>    
            </div>
            
            
            <div class="pricing-grid2" style="width:30%">
                <div class="price-value two">
                    <h3><a href="#">Questions Attempted</a></h3>
                    <h5>
                        <lable style="font-size:30px"><b>2M+</b></lable>
                    </h5>
                </div>    
            </div>
            <div class="pricing-grid2" style="width:30%">
                <div class="price-value two">
                    <h3><a href="#">Test Attempted</a></h3>
                    <h5>
                        <lable style="font-size:30px"><b>20k+</b></lable>
                    </h5>
                </div>    
            </div>
            
        </div>
    </div>
</section>

 <section class="forth_sec" > 
     <div class=""  > 
         <h2 class="home_head">Happy Students</h2> 
         <p class="home_para">Education is the passport to the future, for tomorrow belongs to those who prepare for it today.</p> 
       <section id="photostack-1" class="photostack photostack-start">
                <div>


<?php

$galleryData = App\Modules\Gallery\Models\Gallery::orderBy('sequence_number')->get();
?>


                
                   <?php $__currentLoopData = $galleryData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <figure>
                        <a href="javascript:void(0)" class="photostack-img"><img src="<?php echo e(url('public/img/'.$gallery->image)); ?>" alt="img01" height="240" width="240"/></a>
                        <figcaption>
                            <h2 class="photostack-title"><?php echo e($gallery->title); ?></h2>
                        </figcaption>
                    </figure>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                  
                 
                   
                    
                   
                 
                 
                </div>
            </section>
    </div>
</section>


    
        
        
        
            
                
                    
                        
                        
                            
                                
                            
                            
                                
                                
                            
                        
                    
                
                
                    
                        
                        
                            
                                
                            
                            
                                
                                
                            
                        
                    
                
                
                    
                        
                        
                            
                                
                            
                            
                                
                                
                            
                        
                    
                
                
                    
                        
                        
                            
                                
                            
                            
                                
                                
                            
                        
                    
                
                
                    
                        
                        
                            
                                
                            
                            
                                
                                
                            
                        
                    
                
            
        
    


<div class="modal fade in" data-backdrop="static"  data-keyboard="false" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2>ATAZ Learning</h2>
            </div>
            <div class="modal-body clearfix">
                <?php if(Session::has('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Your account has been created successfully.
                    </div>
                    <?php
                        Session::forget('success');
                        Session::save();
                    ?>
                <?php endif; ?>

                    <?php if(Session::has('expired')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Opps Your account has been expired.
                        </div>
                    <?php endif; ?>
                <div class="login_cartoon">
                    <img src="<?php echo e(url('public/theme1/images/clipart-happy-pencil.jpg')); ?>">
                </div>
                <div class="login-page">
                    <div class="form">
                        <form <?php if(Session::has('register')): ?> style='display:block;' <?php endif; ?> class="register-form" method="POST" action="<?php echo e(route('register')); ?>" onsubmit="return phonenumber(this);">
                            <h4>Sign Up</h4>
                            <?php echo e(csrf_field()); ?>

                            <input type="text" id="reg-mobile" onblur="phonenumber()" name="mobile" value="<?php echo e(old('mobile')); ?>" placeholder="Mobile Number"/>
                            <span class="help-block err-mobile-number" style="display:none">
                                        <strong>Please enter valid mobile number.</strong>
                                    </span>
                            <?php if($errors->has('mobile')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('mobile')); ?></strong>
                                    </span>
                            <?php endif; ?>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required placeholder="Enter Your Name"/>
                            <?php if($errors->has('name')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                            <?php endif; ?>



                            <input id="password" type="password" placeholder="Password" name="password" required>
                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?>

                            <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                            <button type="submit">Register</button>
                            <p class="message">Already registered? <a href="#">Sign In</a></p>
                        </form>

                        <form <?php if(Session::has('register')): ?> style='display:none;' <?php endif; ?> class="login-form" method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <h4>Login</h4>
                            <input id="mobile" type="text" placeholder="Mobile Number" name="mobile" value="<?php echo e(old('mobile')); ?>" required autofocus/>
                            <?php if($errors->has('mobile')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('mobile')); ?></strong>
                                    </span>
                            <?php endif; ?>
                            <input id="password" type="password"  name="password" required placeholder="Password"/>

                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?>


                            <button type="submit" >
                                Login
                            </button>
                            <br>
                            <br>
                            <p class="">Forgot Password ? <a id="forgot_password_link" href="javascript:void(0);">Click here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>

  <script src="<?php echo e(url('public/js/classie.js')); ?>"></script>
        <script src="<?php echo e(url('public/js/photostack.js')); ?>"></script>
<script type="text/javascript">
var javascript_site_path = '<?php echo e(url('/')); ?>';
new Photostack( document.getElementById( 'photostack-1' ), {
      showNavigation: false,                
                afterShowPhoto: function(ps) {
                    setTimeout(function() {
                        ps._rotateItem();
                        setTimeout(function() {
                            ps._rotateItem(); 
                            setTimeout(function() {
                                ps._navigate('next');
                            }, 1000);
                        }, 1000);
                    }, 1000);
            }} );
    $(function () {
            <?php if(Session::has('expired')): ?>
            $('#login').modal('show');
            <?php endif; ?>

            <?php if(Session::has('errors')): ?>
            $('#login').modal('show');
        <?php endif; ?>
    });


    jQuery('.class_inner').click(function(){
        jQuery(this).toggleClass('selected_c');
    });
    $(document).ready(function(){
        var touch   = $('#resp-menu');
        var menu  = $('.menu');

        $(touch).on('click', function(e) {
            e.preventDefault();
            menu.slideToggle();
        });

        $(window).resize(function(){
            var w = $(window).width();
            if(w > 767 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
        $('body').append('<div id="toTop" class="btn btn-info"><i class="fa fa-angle-up" aria-hidden="true"></i></div>');
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });

    });
    
    
   //subscribers
 $('#subscribers_form').validate({
       errorClass: 'text-danger',
       rules:{
          'subscriber_contact_number':{
              required: true,
              digits: true,
              minlength: 10,
              maxlength: 10,
              remote:{
              	url: javascript_site_path + '/check/duplicate/number',
              	  method: 'post'
              }
          },
       },
       messages:{
           'subscriber_contact_number':{
               required: 'Please enter mobile number',
        		remote: 'Mobile number already exists',
        	},
       },
       submitHandler: function (form) {
           // Create an FormData object
 			
 			$.ajax({
 				url: javascript_site_path+'/insert/subscribers',
 				type:'POST',
 				dataType:'JSON',
 				data:{
 					mobile: $("#subscriber_contact_number").val(),
 				},
 				success:function(response){
 					console.log(response)
 					Swal.fire({
                    	  type: response.icon,
                    	  text: response.message,
                        showConfirmButton: true,
                    });
 				},
 				beforeSend:function(){
 					$('#subscribe_btn').attr('disabled',true);
 				},
 				complete:function(){
 					$('#subscribe_btn').attr('disabled',false);
 					$("#subscriber_contact_number").val('');
 				},
 				error:function(){

 				}
 			})
 			       
 
        }
    });    
    
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>