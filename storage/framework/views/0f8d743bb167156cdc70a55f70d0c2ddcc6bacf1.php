

<style>

    .left_sec ul li{

    font-size: 17px;

    }

    </style>

<div class="left_sec content" style="background-image: linear-gradient(to bottom,#4b61b7 0%, #09203f 100%);">

      <ul class="nav">

          <li style="cursor: pointer" onclick="window.location='<?php echo e(url('dashboard')); ?>'"><h4>Dashboard</h4></li>

          <li>

            <a href="<?php echo e(url('user/syllabus')); ?>">Class: <?php echo e(Auth::user()->ConfigureSyllabus->class); ?></a>

        </li>

      </ul>

      <ul class="nav">

        <li><h4>Learn</h4></li>

      <?php if(isset(Auth::user()->ConfigureSyllabus->standard->subjects)): ?>
      
      
  <?php $__currentLoopData = Auth::user()->ConfigureSyllabus->standard->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(Auth::user()->mobile=='9822982298' && $subject->name=="Biology"): ?>
        
        <?php else: ?>
        <li><a href="<?php echo e(url('user/learn/'.base64_encode($subject->id))); ?>"><i class="fa fa-cubes" aria-hidden="true"></i><?php echo e($subject->name); ?></a></li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
   <?php else: ?>
   

      <script>
          window.location = '<?php echo e(url("user/configure/class")); ?>'
      </script>
        
       
        
        @endphp
        <?php endif; ?>
      </ul>

      <ul class="nav">

        <li>

            <h4>Tools</h4>

        </li>

        <li>

            <a href="<?php echo e(url('tools/tests/all')); ?>"><i class="fa fa-cubes" aria-hidden="true"></i>Tests</a>

        </li>

        <li>

            <a href="<?php echo e(url('tools/bookmarks')); ?>"><i class="fa fa-bookmark" aria-hidden="true"></i>Bookmarks</a>

        </li>

      </ul>

      

      <ul class="nav">

        <li>

            <h4>Settings</h4>

        </li>

        <li>

            <a href="<?php echo e(url('user/syllabus')); ?>"><i class="fa fa-cubes" aria-hidden="true"></i>My Syllabus</a>

        </li>

      </ul>

      <ul class="nav">

     

        <li>

            <a href="<?php echo e(url('logout')); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a>

        </li>

      </ul>

 </div>

