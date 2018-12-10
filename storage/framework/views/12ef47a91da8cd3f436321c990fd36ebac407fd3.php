<?php $__env->startSection('content'); ?>
    <h2>Create hall</h2>
    <form method="get" action="<?php echo e(action('HallController@create')); ?>">
        <select name="cinema" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden >Select cinema</option>
            <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option name="cinema" value="<?php echo e($cinema->id); ?>"><?php echo e($cinema->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select><br>
        <button class="btn btn-lg btn-primary">Create hall</button>
    </form>

    <h2>Go hall</h2>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <form method="get" action="<?php echo e(action('HallController@goHall')); ?>">
        <select id="cinema" name="cinema" onchange="" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden>Select cinema</option>
            <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cinema->id); ?>"><?php echo e($cinema->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select><br>
        <select id="halls" name="hall" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden>Select hall</option>
        </select><br>
       <button class="btn btn-lg btn-primary">Go hall</button>
    </form>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#cinema').on('change', function () {
                $('#halls').empty();
                $.post("<?php echo e(asset('getHalls')); ?>", { item : $('#cinema').val() }, function (responce) {
                    for (var i = 0; i < responce.length; i++){
                        $('#halls').append('<option value="' + responce[i].id + '">' + responce[i].name + '</option>');
                    }
                });
            });
        });

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.default-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>