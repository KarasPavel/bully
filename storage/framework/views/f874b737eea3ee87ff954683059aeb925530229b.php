<?php $__env->startSection('content'); ?>

    <br><br><br><br><br><br><br><br><br><br>
    <form method="post" action="<?php echo e(action('AdminController@createHall')); ?>">
        <input name="rows">
        <input name="places">
        <button>create</button>
    </form>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>