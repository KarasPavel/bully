<?php $__env->startSection('content'); ?>
    <a href="<?php echo e(route('admin/cinema-management/create-cinema')); ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add cinema</a>
    <div class="wrapper-cinema" id="wrapper-stick">
        <div class="cinema-w" id="stick-w">
            <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class=".container-fluid">
                    <a class="cinema-item" href="cinema-management/cinema/<?php echo e($cinema->id); ?>">
                        <div class="cinema">
                            <div class="cinema-img">
                                <div class="stick-type">
                                </div>
                                <?php if(isset($cinema->image) && !empty($cinema->image)): ?>
                                    <?php if((strpos($cinema->image, 'https://') !== false) || (strpos($cinema->image, 'http://') !== false)): ?>
                                        <img src="<?php echo e($cinema->image); ?>" alt="">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset(stristr($cinema->image, 'img'))); ?>" alt="">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('img/pics/iayjjZok.jpg')); ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="cinema-name">
                                <p><?php echo e($cinema->name); ?></p>
                                <h4><?php echo e($cinema->address); ?></h4>
                            </div>
                        </div>
                    </a>
                    <a href="cinema-management/edit-cinema/<?php echo e($cinema->id); ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">EDIT</a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($cinemas->render()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>