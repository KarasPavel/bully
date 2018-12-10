<?php $__env->startSection('content'); ?>
    <div class="login-to-account">
        <div class="button-wrap">
            <div class="registration all-button">
                <a href="create-account">Registration</a>
            </div>
            <div class="log-in all-button active">
                <a href="login-to-account">Login</a>
            </div>
        </div>
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="caption">
                <p>Login to Account</p>
                <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget laoreet est.</h3>
            </div>
            <div class="inp-wrap">
                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="Login" required autofocus>
                <?php if($errors->has('email')): ?>
                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                <?php endif; ?>
            </div>
            <div class="inp-wrap">
                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="password" required>
                <?php if($errors->has('password')): ?>
                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                <?php endif; ?>
            </div>
            <button class="btn btns submit" type="submit">
                <i></i>
                <p>Login</p>
            </button>
            <a href="<?php echo e(route('forgot-password')); ?>">Forgot Your Password?</a>
            <div class="social-wrap">
                <div class="caption">
                    <p>Login
                        <span></span>With</p>
                </div>
                <a href="<?php echo e(route('auth/facebook')); ?>">Connect with
                    <img src="img/pics/connect-fb.png" alt="">
                </a>
                <a href="<?php echo e(route('auth/vk')); ?>">Connect with
                    <img src="img/pics/connect-vk.png" alt="">
                </a>
                <a href="<?php echo e(route('auth/google')); ?>">Connect with
                    <img src="img/pics/connect-g.png" alt="">
                </a>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>