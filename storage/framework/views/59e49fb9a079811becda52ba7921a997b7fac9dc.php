<?php $__env->startSection('content'); ?>
    <div class="login-to-account">
        <form method="POST" action="<?php echo e(action('MailController@sendPassword')); ?>">
            <?php echo csrf_field(); ?>
            <div class="caption">
                <p>Send new password</p>
                <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget laoreet est.</h3>
            </div>
            <div class="inp-wrap">
                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="enter your email" required autofocus>
                <?php if($errors->has('email')): ?>
                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                <?php endif; ?>
                <?php if(isset($error)): ?>
                    <span class="invalid-feedback">
                        <strong><?php echo e($error); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <button class="btn btns submit" type="submit">
                <i></i>
                <p>Send</p>
            </button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>