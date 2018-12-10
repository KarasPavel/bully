<?php $__env->startSection('content'); ?>
    <div class="greatest_showman">
        <div class="left-column">
            <form class="scene" id="buy-ticked">
                <p>Scene</p>
                <?php for($i=1; $i<=$countRows; $i++): ?>
                    <div class="red-rows">
                        <?php for($j=1; $j<=$countPlaces; $j++): ?>
                            <input type="checkbox" name="place" id="">
                            <label for=""></label>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>