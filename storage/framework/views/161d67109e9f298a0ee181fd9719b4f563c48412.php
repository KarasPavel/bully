<?php $__env->startSection('content'); ?>
    <div class="create-cinema">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="<?php echo e(action('HallController@store', ['id' => $id])); ?>">
                    <?php echo csrf_field(); ?>
                    <p>Create hall</p>
                    <div class="label">
                        <input id="name" type="text" name="name" placeholder="hall name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('name')); ?>" required>
                    </div>
                    <?php if($errors->has('name')): ?>
                        <p><?php echo e($errors->first('name')); ?></p>
                    <?php endif; ?>
                    <input class="submit" type="submit" name="submit" value="CREATE">
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>