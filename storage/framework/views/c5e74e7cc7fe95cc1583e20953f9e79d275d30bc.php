<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="<?php echo asset('public/theme1/images/1.png'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/theme1/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/theme1/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/theme1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/theme1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/theme1/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/theme1/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/theme1/css/jquery.mCustomScrollbar.css">
    <link href="<?php echo e(url('/')); ?>/public/theme1/css/font-awesome.min.css" rel="stylesheet"/>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <style type="text/css">
    </style>
</head>
<body class="color_bg main_home_bg" >
<?php echo $__env->make('layouts.front-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('layouts.front-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="modal fade in" data-backdrop="static"  data-keyboard="false" id="payment_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2>ATAZ Learning</h2>
            </div>
            <div class="modal-body clearfix">
                <div class="login_cartoon">
                    <img src="<?php echo e(url('/public/theme1/images/payment.png')); ?>">
                </div>
                <div class="login-page">
                    <div class="form">
                        <form id="user_detail" class="user_detail" method="POST" action="">
                            <?php echo e(csrf_field()); ?>

                            <h4>Payment</h4>
                            <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="<?php echo e(old('name')); ?>" autofocus/>
                            <input class="form-control" id="contact_no" type="text" placeholder="Enter Contact Number" name="contact_no" value="<?php echo e(old('contact_no')); ?>"/>
                            <input class="form-control" id="email" type="text" placeholder="Enter Email Id" name="email" value="<?php echo e(old('email')); ?>"/>
                            <select class="form-control" id="packages" name="packages">
                                <option value=""> Select Package </option>
                                <option value="Silver">Silver</option>
                                <option value="Gold">Gold</option>
                                <option value="Platinum">Platinum</option>
                            </select>
                            <br>
                            <select class="form-control" id="validity" name="validity">
                                <option value=""> Select Validity </option>
                                <option value="June 2020">June 2020</option>
                                <option value="June 2021">June 2021</option>
                                <option value="June 2022">June 2022</option>
                                <option value="June 2023">June 2023</option>
                               
                            </select>
                            <br>
                            <input class="form-control" id="amount" type="text" placeholder="Enter Amount" name="amount" value="<?php echo e(old('amount')); ?>"/>
                            <button type="submit" id="pay_btn">
                                <i id="icon" class="fa fa-credit-card" aria-hidden="true"></i>
                                Proceed To Pay
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade in" data-backdrop="static"  data-keyboard="false" id="registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2>ATAZ Learning</h2>
            </div>
            <div class="modal-body clearfix">
                <div class="login_cartoon">
                    <br>
                    <img src="<?php echo e(url('public/theme1/images/1.png')); ?>">
                </div>
                <div class="login-page">
                    <div class="form">
                        <form id="user_registration" class="user_registration" method="POST" action="">
                            
                            <h4>Sign Up</h4>
                            <input class="form-control" id="name" type="text" placeholder="Enter Name" name="name" value="<?php echo e(old('name')); ?>" autofocus/>
                            <input class="form-control" id="mobile" type="text" placeholder="Enter Contact Number" name="mobile" value="<?php echo e(old('mobile')); ?>"/>
                            <input class="form-control" id="city" type="text" placeholder="Enter Your City" name="city" value="<?php echo e(old('city')); ?>"/>
                            
                            <input class="form-control" id="pasword" type="password" placeholder="Enter Password" name="pasword" value="<?php echo e(old('password')); ?>"/>
                            <input class="form-control" id="confirm_password" type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo e(old('confirm_password')); ?>"/>
                            
                            <br>
                            <button type="submit" id="register_btn">
                                <i id="register_icon" class="fa fa-registered" aria-hidden="true"></i>
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade in" data-backdrop="static"  data-keyboard="false" id="forgot_password_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2>ATAZ Learning.Com</h2>
            </div>
            <div class="modal-body clearfix">
                <div class="login_cartoon">
                    <img src="<?php echo e(url('public/theme1/images/clipart-happy-pencil.jpg')); ?>">
                </div>
                <div class="login-page">
                    <div class="form">
                        <form id="forgot_password_form" class="forgot_password_form" method="POST" action="">
                            
                            <h4>Forgot Password</h4>
                            <input class="form-control" id="forgot_mobile" type="text" placeholder="Enter registered mobile number" name="forgot_mobile" value="<?php echo e(old('mobile')); ?>"/>
                            <p id="mobile_not_found" style="display: none;">Mobile number not found</p>
                            <button type="submit" id="forgot_password_btn">
                                <i id="forgot_password_icon" class="fa fa-key" aria-hidden="true"></i>
                                Generate Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="<?php echo e(url('/public/theme1/')); ?>/js/jquery.js"></script>
<script src="<?php echo e(url('/public/theme1/')); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo e(url('/public/theme1/')); ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo e(url('/public/theme1/')); ?>/js/custom.js"></script>
<script src="<?php echo e(url('/public/theme1/')); ?>/js/jquery.validate.js"></script>
<?php echo $__env->yieldContent('footer'); ?>
<script>
    $(function(){
        $('#forgot_password_link').click(function () {
            $('#login').modal('hide');
            $('#forgot_password_modal').modal('show');
        });

        $('#forgot_mobile').keydown(function () {
            $('#mobile_not_found').hide();
        });

    });
    var javascript_site_path = '<?php echo e(url('/')); ?>';
    //console.log(javascript_site_path);
    $('#user_detail').validate({
        errorClass: 'text-danger',
        rules: {
            name: {
                required: true,
            },
            contact_no: {
                required: true,
            },
            email: {
                required: true,
            },
            packages: {
                required: true,
            },
            validity: {
                required: true,
            },
            amount: {
                required: true,
                digits: true
            }
        },
        messages: {
            name: {
                required: "Please Enter Name",
            },
            contact_no: {
                required: "Please Enter Contact No",
            },
            email: {
                required: "Please Enter Email Id",
            },
            packages: {
                required: "Please Select Package",
            },
            validity: {
                required: "Please Select Validity",
            },
            amount: {
                required: "Please Enter Amount",
            }
        },
        submitHandler: function (form) {

            var name = $('#name').val();
            var contact = $('#contact_no').val();
            var email = $('#email').val();
            var packages = $('#packages').val();
            var validity = $('#validity').val();
            var amount = $('#amount').val();
            $('#pay_btn').attr('disabled',true);
            $('#icon').removeClass('fa fa-credit-card');
            $('#icon').addClass('fa fa-spinner fa-spin');
            // This is the main function
            $.ajax({
                url: javascript_site_path+'/process-payment',
                type:'POST',
                dataType:"json",
                data:{
                    amount: amount,
                },
                success:function (response) {
                    console.log(response.key);
                    var options = {
                        "key": response.key, // Enter the Key ID generated from the Dashboard
                        "amount": response.amount, // Amount is in currency subunits. Default currency is INR. Hence, 29935 refers to 29935 paise or INR 299.35.
                        "currency": 'INR',
                        "name": 'ATAZ Learning',
                        "description": '',
                        "image": response.image,
                        "order_id": response.order_id,//This is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order). Refer the Checkout form table given below
                        "handler": function (result){
                            console.log(result);
                            console.log(result.razorpay_payment_id);
                            $.ajax({
                                url: javascript_site_path + '/verify-payment',
                                type: 'POST',
                                dataType:"json",
                                data: {
                                    response: result,
                                    name: name,
                                    contact: contact,
                                    email: email,
                                    packages: packages,
                                    validity: validity,
                                    amount: amount
                                },
                                success: function (response) {
                                    $('#name').val('');
                                    $('#contact_no').val('');
                                    $('#email').val('');
                                    $('#packages').val('');
                                    $('#validity').val('');
                                    $('#amount').val('');
                                    $('#pay_btn').attr('disabled',false);
                                    $('#icon').removeClass('fa fa-spinner fa-spin');
                                    $('#icon').addClass('fa fa-credit-card');
                                    Swal.fire({
                                        type: response.icon,
                                        html: response.msg,
                                        showConfirmButton: true,
                                    })
                                }
                            });
                        },
                        "prefill": {
                            "name": name,
                            "email": email,
                            "contact": contact,
                        },
                        "notes": {
                            "address": "note value"
                        },
                        "theme": {
                            "color": '#2bc2b3'
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                },
            });
        }

    });

    $('#user_registration').validate({
       errorClass: 'text-danger',
       rules:{
          'name':{
              required: true,
          },
           /*'email':{
               required: true,
               email: true,
           },*/
           'pasword':{
               required: true,
           },
           'confirm_password':{
               required: true,
               equalTo : "#pasword",
           },
           'mobile':{
               required: true,
               digits:true,
               remote: {
                   url: javascript_site_path + '/chk-mobile-duplicate',
                   method: 'get'
               }
           },
           'city':{
               required: true,
           },
           /*'state':{
               required: true,
           },
           'address':{
               required: true,
           },*/
       },
       messages:{
           'name':{
               required: 'Please enter your name'
           },
           /*'email':{
               required: 'Please enter your email id',
               email: 'Please enter valid email id'
           },*/
           'pasword':{
               required: 'Please enter password '
           },
           'confirm_password':{
               required: 'Please confirm password',
               equalTo: 'Confirm password should be same as password',
           },
           'mobile':{
               required: 'Please enter your mobile no',
               digits: 'Please enter valid mobile no',
               remote: 'Mobile no already exist'
           },
           'city':{
               required: 'Please enter your city'
           },
           /*'state':{
               required: 'Please enter your state'
           },
           'address':{
               required: 'Please enter your address'
           },*/
       },
       submitHandler: function (form) {

           /*form.submit();*/

           //var formData = new FormData($('#user_registration'));
           var form = $('#user_registration')[0];
           // Create an FormData object
           var data = new FormData(form);
           $('#register_btn').attr('disabled',true);
           $('#register_icon').removeClass('fa fa-registered');
           $('#register_icon').addClass('fa fa-spinner fa-spin');
            $.ajax({
                url: javascript_site_path+'/register/student',
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                data: data,
                success: function (result) {
                    $("#user_registration")[0].reset();
                    $('#register_btn').attr('disabled',false);
                    $('#register_icon').removeClass('fa fa-spinner fa-spin');
                    $('#register_icon').addClass('fa fa-registered');
                    $('#registration').modal('hide');
                    Swal.fire({
                        type: result.icon,
                        html: result.message,
                        showConfirmButton: true,
                    }).then(function (result) {
                        if (result.value) {
                            //$('#login').modal('show');
                            window.location.reload();
                        }
                    });
                }
            })
       }    
    });
    
    $('#forgot_password_form').validate({
        errorClass:'text-danger',
        rules:{
            'forgot_mobile':{
                required:true,
                digits:true,
                minlength:10,
                maxlength:10,
            }
        },
        messages:{
            'forgot_mobile':{
                required: 'Please enter registered mobile number',
                digits:'Invalid format',
                minlength:'Number should not be less then 10 digits',
                maxlength:'Number should not be more then 10 digits'
            }
        },
        submitHandler:function (form) {

            $.ajax({
               url:javascript_site_path+'/check-forgot-password-number',
               type:'POST',
               dataType:'JSON',
               data:{
                   mobile: $('#forgot_mobile').val(),
               },
               success:function (response) {
                    if(response.status == '0')
                    {
                        $('#mobile_not_found').show();
                    }
                    else
                    {
                        $("#forgot_password_form")[0].reset();
                        $('#forgot_password_modal').modal('hide');
                        Swal.fire({
                            type: 'success',
                            html: 'Sent password successfully on registered mobile number',
                            showConfirmButton: true,
                        })
                    }
               },
               beforeSend:function () {
                   $('#forgot_password_icon').removeClass('fa fa-key');
                   $('#forgot_password_icon').addClass('fa fa-spinner fa-pulse');
               },
               complete:function () {
                   $('#forgot_password_icon').removeClass('fa fa-spinner fa-pulse');
                   $('#forgot_password_icon').addClass('fa fa-key');
               },
               error:function () {

               }
            });
        }
    });
    
</script>
</body>

</html>
