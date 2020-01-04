<?php $__env->startSection('title'); ?>
Gallery
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="breadcrumb">
    <li><a href="<?php echo e(url('customer/dashboard')); ?>">Dashboard</a></li>
    <li><a href="javascript:void(0)">View Gallery</a></li>
</ul>

<?php if(Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <?php echo e(Session::get('success')); ?>

    </div>
<?php endif; ?>

   <div class="col-md-12 col-sm-12 col-xs-12">
       
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Gallery</h2>
                      <div class="pull-right">
                          <a href="<?php echo e(url('/admin/create/gallery')); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                      </div>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" style="overflow-x:auto;">
                        <table id="gallery" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Sequence Number</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                    
                    </table>
					
					
                  </div>
                </div>
              </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<script src="<?php echo e(url('/public/backend/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#gallery').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(url('/admin/gallery/data')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image',
               render: function (data, type, full, meta) {
              return '<img src="<?php echo e(url("/public/img/")); ?>/'+ data +'" width="70"/>';

            }, 
                orderable: false,
                'defaultContent':'-',

            },
            {data: 'title', name: 'title'},
            {data: 'sequence_number', name: 'sequence_number'},
            {data: 'edit', 
            render: function (data, type, full, meta) {
            return '<button type="button" class="btn btn-success">Edit</button>';
            }, 
                orderable: false,
                'defaultContent':'-',
          },
          {data: 'delete', 
            render: function (data, type, full, meta) {
            return '<button type="button" class="btn btn-danger">Delete</button>';
            }, 
                orderable: false,
                'defaultContent':'-',
          },
      ]
    });



});


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>