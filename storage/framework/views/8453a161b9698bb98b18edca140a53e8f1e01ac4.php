<?php $__env->startSection('title'); ?>
Gallery
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<ul class="breadcrumb">
    <li><a href="<?php echo e(url('admin/dashboard')); ?>">Dashboard</a></li>
    <li><a href="<?php echo e(url('/admin/gallery/list')); ?>">Manage Gallery</a></li>
    <li><a href="javascript:void(0)">Create Gallery</a></li>
</ul>
<div class="">
<div class="row">
<div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Gallery</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="col-md-6 center-margin">
                          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                              <?php echo e(csrf_field()); ?>

                              
                              <div class="form-group row">
                                  <label for="image" class="col-md-2 col-form-label text-md-right">Image</label>
                                  <div class="col-md-6">
                                  <input id="image" type="file" class="form-control" name="image">
                                    <?php if(auth()->user()->image): ?>
                                    <code><?php echo e(auth()->user()->image); ?></code>
                                    <?php endif; ?>
                                    </div>
                              </div>






                              <div class="form-group">
                                  <label class="col-md-2">Title</label>
                                  <div class="col-md-6">
                                  <input class="form-control" type="text" name="title" value="<?php echo e(old('title')); ?>">
                                  <?php if($errors->has('title')): ?>
                                      <span><strong class="text-danger"><?php echo e($errors->first('title')); ?></strong></span>
                                  <?php endif; ?>
                                </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-2">Sequence Number</label>
                                  <div class="col-md-6">
                                  <input class="form-control" type="text" name="sequence_number">
                                  <?php if($errors->has('sequence_number')): ?>
                                      <span><strong class="text-danger"><?php echo e($errors->first('sequence_number')); ?></strong></span>
                                  <?php endif; ?>
                                </div>
                              </div>
                              
                            
                              <div class="ln_solid"></div>

                              <div class="form-group">
                                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                      <button type="submit" class="btn btn-success">Submit</button>
                                  </div>
                              </div>

                          </form>
                    </div>
                  </div>
                </div>
              </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>