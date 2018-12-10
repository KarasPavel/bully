<?php $__env->startSection('content'); ?>
    <div class="greatest_showman">
        <div class="left-column">
            <div class="caption">
                <h1>The Greatest Showman</h1>
            </div>
            <div class="price">
                <p>Price</p>
                <div class="button top-price">
                    <p>$ 200</p>
                </div>
                <div class="button middle-price">
                    <p>$ 100</p>
                </div>
                <div class="button bottom-price">
                    <p>$ 50</p>
                </div>
            </div>
            <form class="scene" id="buy-ticked">
                <p>Scene</p>
                <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="red-rows">
                        <table>
                            <?php for($i = 0; $i < $sector->cols; $i++): ?>
                                <tr>
                                    <?php for($j = 0; $j < $sector->rows; $j++): ?>
                                        <td>
                                            <input type="checkbox" name="place_1-1" id="<?php echo e($i."-".$j); ?>">
                                            <label for="<?php echo e($i."-".$j); ?>" style="border: 1px solid <?php echo e($sector->color); ?>"></label>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </table>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </form>
        </div>
        <div class="right-column">
            <div class="info-bar">
                <p class="category">MOVIE, ART, DANCe</p>
                <p class="name">National Academic Theatre of Operetta</p>
                <p>Velyka Vasylkivska St, 53/3, Kyiv</p>
                <div class="time-line">
                    <img src="<?php echo e(asset('img/pics/calendar-blue.svg')); ?>" alt="">
                    <p>Feb. 5 - Mar. 20, 2018</p>
                </div>
                <div class="time-start">
                    <img src="<?php echo e(asset('img/pics/clock-blue.svg')); ?>" alt="">
                    <p>Start 7:00 pm - End 9:30 PM</p>
                </div>
            </div>
            <div class="tikets">
                <h1>Tikets: 2</h1>
                <div class="tiket-column row-column">
                    <h2>ROW</h2>
                    <p>01</p>
                    <p>06</p>
                </div>
                <div class="tiket-column place-column">
                    <h2>PLACE</h2>
                    <p>01</p>
                    <p>07</p>
                </div>
                <div class="tiket-column price-column">
                    <h2>PRICE</h2>
                    <p>$200</p>
                    <p>$50</p>
                </div>
                <div class="tiket-column cancel-column">
                    <div class="fabul"></div>
                    <div class="cancel"></div>
                    <div class="cancel"></div>
                </div>
                <h1>Total: $250</h1>
                <button class="bottun-next" type="submit" form="buy-ticked">
                    <p>Next</p>
                </button>
            </div>
            <div class="time-left">
                <h1>Time left:</h1>
                <div class="min">
                    <p>15</p>
                    <h2>MIN</h2>
                </div>
                <p>:</p>
                <div class="second">
                    <p>13</p>
                    <h2>SEC</h2>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>