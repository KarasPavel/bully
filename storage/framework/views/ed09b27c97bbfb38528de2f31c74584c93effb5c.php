<?php $__env->startSection('content'); ?>
        <div class="my-events-wrap">
            <div class="my-events">
                <div class="caption">
                    <p>My Events</p>
                    <a href="javascript:history.back()"></a>
                </div>
                <div class="button-wrap">
                    <div class="button-bar">
                        <div class="button all">
                            <p class="active">ALL</p>
                        </div>
                        <div class="button past">
                            <p>Past</p>
                        </div>
                        <div class="button current">
                            <p>CURRENT</p>
                        </div>
                    </div>
                   <!-- <div class="button-draft">
                        <p>draft (10)</p>
                    </div>-->
                </div>
                <div class="events">
                    <?php $__currentLoopData = $myEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <form method="post" action="<?php echo e(action('MyEventsController@update')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="file" name="newEventImage" id="image" >
                            <div class="Cover_Image" for="image">
                                <img src="<?php echo e(stristr($event->coverImage, 'img')); ?>"  alt="">
                                <p><?php echo e($event->title); ?></p>
                                <a href="update-event/<?php echo e($event->id); ?>">
                                    <p>EDIT</p>
                                </a>
                            </div>
                        </form>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        function filtr(div) {
            var text = $(div).find('p').text();
            $.post("<?php echo e(asset('event-filter')); ?>", {time: text}, function (response) {
                if(response){
                    $('.events').empty();
                    for (var i = 0; i <= response.length; i++){
                        if (typeof response[i] == 'object') {
                            $('.events').append(
                                '<form method="post" action="<?php echo e(action('MyEventsController@update')); ?>" enctype="multipart/form-data">' +
                                '<?php echo csrf_field(); ?>' +
                                '<input type="file" name="newEventImage" id="image" >' +
                                '<div class="Cover_Image" for="image">' +
                                '<img src="' + response[i].coverImage.split('public/')[1] + '"  alt="">' +
                                '<p>' + response[i].title + '</p>' +
                                '<a href="update-event/' + response[i].id + '">' +
                                '<p>EDIT</p>' +
                                '</a>' +
                                '</div>' +
                                '</form>'
                            );
                        }
                    }
                }
            });
        }
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.button').on('click', function () {
                filtr(this);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>