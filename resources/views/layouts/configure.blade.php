<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/owl.carousel.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/fontawesome.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/jquery.mCustomScrollbar.css')}}">
<link href="{{url('public/theme1/css/font-awesome.min.css')}}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/theme1/css/responsive.css')}}">
<title>Index</title>
</head>
<body class="dashboard">
<header class="top_head">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="logo"> <img src="images/1.png"> </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 ">
      <div class="shadow_effect">
        <div class="round">
          <i class="fa fa-bell"></i>
        </div>
      </div> 
      </div> 
  </div>
</header>
    
    
    
    @if(Request::segment(2)!='configure')
        @include('layouts.left-bar')
        @endif
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
</body>
</html>