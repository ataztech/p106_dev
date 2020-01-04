<?php $__env->startSection('title'); ?>
Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-user"></i></div>
                  <div class="count">2345</div>
                  <h3>Total Users</h3>
                  <p>Available.</p>
                </div>
              </div>
               <!--style="background-image: url('../public/frontend/img/bg.jpg');"-->



          </div>
          <!-- /top tiles -->


        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>