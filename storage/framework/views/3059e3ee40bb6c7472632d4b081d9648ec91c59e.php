<?php $__env->startSection('content'); ?>
        <div class="account-wrap">
            <div class="left-part">
                <h1>Account</h1>
                <a href="personal_information">Personal Information
                    <img src="<?php echo e(asset('img/pics/arrow-account.png')); ?>" alt="">
                </a>
                <a href="my_events">MY EVENTS
                    <img src="<?php echo e(asset('img/pics/arrow-account.png')); ?>" alt="">
                </a>
            </div>
            <div class="right-part">
                <h1>Ticket sales amount:</h1>
                <h2></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. </p>
                <a class="btn" href="create-event">
                    <p>CREATE EVENT</p>
                </a>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post("<?php echo e(asset('current-sell-sum')); ?>", {userId: "<?php echo e(Auth::user()->id); ?>"}, function (response) {
                    if(response){
                        var total = 0;
                      for(var i = 0; i <= response.length; i++){
                          if(typeof response[i] == 'object'){
                              total += response[i][0].price / 100;
                          }
                      }
                      $('.right-part').find('h2').text('$'+total);
                    }
                });
            });
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>