<?php $__env->startSection('content'); ?>
    <div class="pers-inf">
        <div class="pers-inform">
            <p>Personal Information</p>
            <a href="javascript:history.back()"></a>
        </div>

        <form method="post" action="<?php echo e(action('PersonalInformationController@update')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="avatar">
                <input type="file" class="file" id="back" name="photo">
                <div class="back">
                </div>
                <label for="back">
                    <p>CHANGE</p>
                </label>

            </div>
            <div class="caption">
                <p>PERSONAL INFORMATION</p>
            </div>
            <div class="label">
                <input id="firstName" type="text" class="form-control<?php echo e($errors->has('firstName') ? ' is-invalid' : ''); ?>" name="firstName" value="<?php echo e(Auth::user()->firstName); ?>" placeholder="first name">
                <?php if($errors->has('firstName')): ?>
                    <span class="invalid-feedback">
                            <strong><?php echo e($errors->first('firstName')); ?></strong>
                        </span>
                <?php endif; ?>

            </div>
            <div class="label">
                <input id="lastName" type="text" class="form-control<?php echo e($errors->has('lastName') ? ' is-invalid' : ''); ?>" name="lastName" value="<?php echo e(Auth::user()->lastName); ?>" placeholder="last name">
                <?php if($errors->has('lastName')): ?>
                    <span class="invalid-feedback">
                            <strong><?php echo e($errors->first('lastName')); ?></strong>
                        </span>
                <?php endif; ?>
            </div>
            <div class="label">
                <input id="number" type="text" class="form-control<?php echo e($errors->has('number') ? ' is-invalid' : ''); ?>" name="number" value="<?php echo e(Auth::user()->phone); ?>" placeholder="enter your number">
                <?php if($errors->has('number')): ?>
                    <span class="invalid-feedback">
                            <strong><?php echo e($errors->first('number')); ?></strong>
                        </span>
                <?php endif; ?>
            </div>
            <div class="caption change-pas">
                <p>CHANGE PASSWORD</p>
            </div>
            <div class="label">
                <input type="password" name="currentPassword" placeholder="Enter the current password(required)" value="">
                <?php if($errors->has('currentPassword')): ?>
                    <span class="invalid-feedback">
                        <strong><?php echo e($errors->first('currentPassword')); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if(isset($error)): ?>
                    <span class="invalid-feedback">
                        <strong><?php echo e($error); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div class="label">
                <input type="password" name="password" id="delete-4" placeholder="Enter the password" value="">
                <?php if($errors->has('password')): ?>
                    <span class="invalid-feedback">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                <?php endif; ?>
            </div>
            <div class="label">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="" placeholder="Confirm Password">
            </div>
            <button class="submit btns" type="submit" value="SAVE">
                <i></i>
                <p>SAVE</p>
            </button>
        </form>
    </div>
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.'+input.id).css({'backgroundImage': 'url('+e.target.result+')','background-size': '100% 100%'});
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function () {
            if("<?php echo e(Auth::user()->photo); ?>"){
                $('.back').css({'backgroundImage': 'url('+"<?php echo e(asset(stristr(Auth::user()->photo, 'img'))); ?>"+')','background-size': '100% 100%'});
            }else{
                $('.back').css({'backgroundImage': 'url("<?php echo e(asset('img/pics/no-photo-doctor.gif')); ?>")','background-size': '100% 100%'});
            }
        });
        $(document).click(function () {
            $('.file').on('change', function () {
                readURL(this);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>