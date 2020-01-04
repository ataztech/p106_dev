<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo e(url('/')); ?>/public/frontend/build/css/custom.min.css" rel="stylesheet">


      <!-- Datatables -->
      <link href="<?php echo e(url('/')); ?>/public/backend/css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo e(url('/')); ?>/public/backend/css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo e(url('/')); ?>/public/backend/css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo e(url('/')); ?>/public/backend/css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo e(url('/')); ?>/public/backend/css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo e(url('/')); ?>/public/backend/css/style.css" rel="stylesheet">
      <link href="<?php echo e(url('/')); ?>/public/backend/css/pnotify.css" rel="stylesheet">
      
      <<link href="<?php echo e(url('/')); ?>/public/backend/css/jquery-ui.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

   <body class="nav-md">
    <div class="container body">
      <div class="main_container">

  
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <?php echo $__env->make('layouts.admin-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <?php echo $__env->make('layouts.admin-left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php if(Request::segment(2)!="dashboard"): ?>
      <div class="right_col" role="main">
      <?php endif; ?>
          <?php echo $__env->yieldContent('content'); ?>
      <?php if(Request::segment(2)!="dashboard"): ?>
      </div>
      <?php endif; ?>
          <?php
          $site_title = \App\Modules\Models\GlobalValue::where('slug','site-title')->pluck('value')->first();
          ?>
        <footer>
          <div class="pull-right">
              &copy; <?php echo e($site_title); ?>  <?php echo e(\Carbon\Carbon::now()->format('Y')); ?>

          </div>
          <div class="clearfix"></div>
        </footer>
    </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo e(url('/')); ?>/public/backend/js/jquery.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backend/js/jquery-ui.js"></script>
    <!--<script src="<?php echo e(url('/')); ?>/public/frontend/jquery/dist/jquery.min.js"></script>-->
    <!-- Bootstrap -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/Flot/jquery.flot.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/moment/min/moment.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/frontend/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo e(url('/')); ?>/public/frontend/build/js/custom.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backend/js/validator/validator.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backend/js/jquery.validate.js"></script>
    
    <script src="<?php echo e(url('/')); ?>/public/backend/js/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/backend/js/ckeditor4/ckeditor.js"></script>
    <!--notify-->
    <script src="<?php echo e(url('/')); ?>/public/backend/js/pnotify.js"></script>
<?php echo $__env->yieldContent('footer'); ?>
  </body>
  <script>
$(document).ready(function(){
    if($('#notification').attr('data-type'))
    {
        var type = $('#notification').attr('data-type');
        var msg = $('#notification').attr('data-msg');
        notification(type,msg);
    }

});

function notification(type,msg)
{
    new PNotify({
    title: type.charAt(0).toUpperCase() + type.substr(1),
    type: type,
    text: msg,
    nonblock: {
        nonblock: true
    },
    styling: 'bootstrap3',
});
}
</script>
</html>
