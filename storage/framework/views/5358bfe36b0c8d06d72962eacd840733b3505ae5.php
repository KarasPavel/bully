<?php $__env->startSection('content'); ?>
    <div class="place-info">
        <h2><?php echo e($cinema->name); ?></h2>
        <?php if(isset($cinema->image) && !empty($cinema->image)): ?>
            <?php if((strpos($cinema->image, 'https://') !== false) || (strpos($cinema->image, 'http://') !== false)): ?>
                <img src="<?php echo e($cinema->image); ?>" alt="">

            <?php else: ?>
                <img src="<?php echo e(asset(stristr($cinema->image, 'img'))); ?>" alt="">
            <?php endif; ?>
        <?php else: ?>
            <img src="<?php echo e(asset('img/pics/iayjjZok.jpg')); ?>" alt="">
        <?php endif; ?>
        <p class="cinema-address">Address: <?php echo e($cinema->address); ?></p>
        <p class="cinema-desc"><?php echo e($cinema->description); ?></p>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>