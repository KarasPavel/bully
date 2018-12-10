<?php echo $__env->make('layouts.header-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('layouts.footer-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>