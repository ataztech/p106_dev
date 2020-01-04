<!DOCTYPE html>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/bootstrap.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/bootstrap.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/owl.carousel.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/fontawesome.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/jquery.mCustomScrollbar.css')}}">

<link href="{{url('public/theme1/css/font-awesome.min.css')}}" rel="stylesheet"/>

<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/style.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/responsive.css')}}">

<title>ATAZ Learning</title>

</head>



<body class="color_bg">

    

    

<header class="top_head">

  <div class="container-fluid">

    <div class="row">

      <div class="col-md-6 col-sm-6 col-xs-6">

        <div class="logo"> <img src="images/1.png"> </div>

      </div>

      <div class="col-md-6 col-sm-6 col-xs-6">

       <div class="login_btn">

        <a type="button" data-toggle="modal" data-target="#login" href="#">Login</a>

      </div>

      <div class="shadow_effect text-right">

<!--        <div class="round">

          <i class="fa fa-bell"></i>

        </div>-->

      </div> 

      </div> 

  </div>

</header>

    

    

    

    

        @yield('content')

    <script src="{{url('public/theme1/js/jquery.js')}}"></script> 

    <script src="{{url('public/theme1/js/bootstrap.min.js')}}"></script> 

    <script src="{{url('public/theme1/js/owl.carousel.min.js')}}"></script> 

    <script src="{{url('public/theme1/js/custom.js')}}"></script>

    <script src="{{url('public/theme1/js/jquery.mCustomScrollbar.min.js')}}"></script>

@yield('footer')

<script>

    (function($){

        $(window).load(function(){

            $(".content").mCustomScrollbar();

        });

    })(jQuery);

</script>



<div class="modal fade in" style="display: block" data-backdrop="static"  data-keyboard="false" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

     <div class="modal-header">

         

         <h2>ATAZ Learning.Com</h2>

         

<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->

      </div>

      <div class="modal-body clearfix">

          @if(Session::has('success'))

                  <div class="alert alert-success alert-dismissible">

  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

  <strong>Success!</strong> Your account has been created successfully.

</div>

          @php

          Session::forget('success');

          Session::save();

          @endphp

          @endif

      <div class="login_cartoon">

         <img src="{{url('public/theme1/images/clipart-happy-pencil.jpg')}}">

      </div>

        <div class="login-page">

            

          <div class="form">

      

             <form @if(Session::has('register')) style='display:block;' @endif class="register-form" method="POST" action="{{ route('register') }}" onsubmit="return phonenumber(this);">

               <h4>Sign Up</h4>

               {{ csrf_field() }}

                <input type="text" id="reg-mobile" onblur="phonenumber()" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number"/>

                <span class="help-block err-mobile-number" style="display:none">

                                        <strong>Please enter valid mobile number.</strong>

                                    </span>

                @if ($errors->has('mobile'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                @endif

                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter Your Name"/>

                                @if ($errors->has('name'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </span>

                                @endif

                                

                                    

                                

                                <input id="password" type="password" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                @endif

                                

                                <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>

                <button type="submit">Register</button>

                <p class="message">Already registered? <a href="#">Sign In</a></p>

              </form>

              

                  <form @if(Session::has('register')) style='display:none;' @endif class="login-form" method="POST" action="{{ route('login') }}">

                      {{ csrf_field() }}

              <h4>Login</h4>

                <input id="mobile" type="text" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}" required autofocus/>

                @if ($errors->has('mobile'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                                @endif

                                <input id="password" type="password"  name="password" required placeholder="Password"/>

                                

                                @if ($errors->has('password'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                @endif

                                

                                

                <button type="submit" >

                                    Login

                                </button>

                <p class="message">Not registered? <a href="#">Create an account</a></p>

              </form>

            </div>

          </div>

      </div>

    </div>

  </div>

</div>

<div class="modal-backdrop fade in"></div>

</body>

<script>

    function phonenumber()

{

    

    var inputtxt = $("#reg-mobile").val()

  var phoneno = /^\d{10}$/;

  if((inputtxt.match(phoneno)))

        {

            $(".err-mobile-number").hide();

      return true;

        }

      else

        {

        $(".err-mobile-number").show();

        return false;

        }

}

    </script>

</html>