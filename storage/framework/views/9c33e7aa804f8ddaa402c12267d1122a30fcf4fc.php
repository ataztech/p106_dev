<title>Dashboard</title>

<?php $__env->startSection('content'); ?>


<style>
    .sub{
       cursor: pointer; 
    }
</style>



<div class="main_dash_right">

    

 <h2>Hello <?php echo e(ucwords(Auth::user()->name)); ?>,</h2>

 <h4>What would you like to learn today?</h4>
 

 <div class="container-fluid">

    <div class="row">

       <?php if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[0])): ?> 

       <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='<?php echo e(url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id))); ?>'">

            <div class="sub dash_colr1">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[0]->name); ?>


                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">
                          <img width="40px" height="46px" src="<?php echo e(url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[0]->name.'.jpg')); ?>">
                      </div>

                  </div>

              </div>

              <h4 class="text-center"><?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[0]->name); ?></h4>

              <div id="progressbar">

                  <div style="width:<?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)); ?>% !important;"></div>

                <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)); ?>%</span>

              </div>

              <p>

                  

                  <!--<i class="fa fa-video-camera" aria-hidden="true"></i><span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)['videos']); ?></span> Videos-->  

                  

                  

                  

                  <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[0]->id)['topics']); ?></span> Practice</p>

            </div>

        </div>

        <?php endif; ?>

        <?php if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[1])): ?> 

         <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='<?php echo e(url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id))); ?>'">

             <div class="sub dash_colr2">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[1]->name); ?>


                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">

                        <img width="40px" height="46px" src="<?php echo e(url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[1]->name.'.jpg')); ?>">

                      </div>

                  </div>

              </div>

              <h4 class="text-center"><?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[1]->name); ?></h4>

              <div id="progressbar">

                <div style="width:<?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)); ?>% !important;"></div>

                <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)); ?>%</span>

              </div>

              <p>

                  

<!--                  <i class="fa fa-video-camera" aria-hidden="true"></i><span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)['videos']); ?></span> Videos  -->

                  

                  

                  <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[1]->id)['topics']); ?></span> Practice</p>

            </div>

        </div>

        <?php endif; ?>

        <?php if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[2])): ?>

        <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='<?php echo e(url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id))); ?>'">

            <div class="sub dash_colr3">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[2]->name); ?>


                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">

                        <img width="40px" height="46px" src="<?php echo e(url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[2]->name.'.jpg')); ?>">

                      </div>

                  </div>

              </div>

              <h4 class="text-center"><?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[2]->name); ?></h4>

              <div id="progressbar">

                <div style="width:<?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)); ?>% !important;"></div>

                <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)); ?>%</span>

              </div>

              <p>

<!--                  <i class="fa fa-video-camera" aria-hidden="true"></i><span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)['videos']); ?></span> Videos  -->

                  

                  <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[2]->id)['topics']); ?></span> Practice</p>

            </div>

        </div>

        <?php endif; ?>

        <?php if(isset(Auth::user()->ConfigureSyllabus->standard->subjects[3]) && Auth::user()->mobile!='9822982298'): ?>

        <div class="col-md-3 col-sm-3 col-xs-12" onclick="window.location='<?php echo e(url('user/learn/'.base64_encode(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id))); ?>'">

             <div class="sub dash_colr4">

              <div class="row">

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[3]->name); ?>


                  </div>

                   <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="sub_img">

                        <img width="40px" height="46px" src="<?php echo e(url('public/backend/img/'.Auth::user()->ConfigureSyllabus->standard->subjects[3]->name.'.jpg')); ?>">

                      </div>

                  </div>

              </div>

              <h4 class="text-center"><?php echo e(Auth::user()->ConfigureSyllabus->standard->subjects[3]->name); ?></h4>

              <div id="progressbar">

                <div style="width:<?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id)); ?>% !important;"></div>

                <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getSubjectReport(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id)); ?>%</span>

              </div>

              <p>

<!--                  <i class="fa fa-video-camera" aria-hidden="true"></i><span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(Auth::user()->ConfigureSyllabus->standard->subjects[3]->id)['videos']); ?></span> Videos  -->

                  <span><?php echo e(App\Modules\Learn\Models\QuestionReport::getTotalVideoTopicsReport(4)['topics']); ?></span> Practice</p>

            </div>

        </div>

        <?php endif; ?>

    </div>

  </div>

 </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>

        $(function () {
            
        });


    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>