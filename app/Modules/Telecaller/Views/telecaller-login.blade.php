<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Telecaller Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{url('public/backend/css/bootstrap.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{url('public/backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{url('public/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{url('public/backend/css/style-responsive.css')}}" rel="stylesheet">
    <link href="{{url('public/backend/css/login.css')}}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .login-container{
            position: absolute;
            margin-left: 39%;
            width: 353px;
            margin-top: 8%;
        }
    </style>
</head>

<body>

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<div id="particles-js">

    <div id="login-page">
        <div class="login-container">

            <form class="form-login"  method="post" action="{{url('/login')}}">
                {{ csrf_field() }}
                <h2 class="form-login-heading">sign in nowkjh</h2>
                <div class="login-wrap{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    <input type="text" name="mobile" class="form-control" placeholder="Moble number" value="{{ old('mobile') }}" autofocus required>
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                    @endif
                    <br>
                    <input type="password" class="form-control" placeholder="Password" name="password"  id="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>

		                </span>
                    </label>
                    <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                    <hr>
                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password ?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-theme" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

            </form>

        </div>
    </div>
</div>



<script src="{{url('public/backend/js/particles.js')}}"></script>
<script src="{{url('public/backend/js/app.js')}}"></script>


<script>


</script>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{url('public/backend/js/jquery.js')}}"></script>
<script src="{{url('public/backend/js/bootstrap.min.js')}}"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->




</body>
</html>
