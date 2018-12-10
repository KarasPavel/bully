<?php $__env->startSection('content'); ?>
    <div class="thank-you-wrap">
        <div class="thank-you">
            <img class="event-was-created" src="<?php echo e(asset('img/pics/create-event.png')); ?>" alt="">
            <h1>Evemnt Was Created</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. </p>
            <div class="btn">
                <p>CONTINUE</p>
            </div>
        </div>
    </div>
    <!-- include components/_thank_you.pug-->
    <div class="create-event">
        <h1>Start Building Your Event:</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. </p>
        <form method="post" action="<?php echo e(action('EventController@update', ['id' => $event->id])); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <p>INFO</p>
            <div class="label">
                <input id="title" type="text" name="title" placeholder="event name" class="form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" value="<?php echo e($event->title); ?>" >
            </div>
            <?php if($errors->has('title')): ?>
                <p><?php echo e($errors->first('title')); ?></p>
            <?php endif; ?>
            <?php if($errors->has('title')): ?>
                <p><?php echo e($errors->first('title')); ?></p>
            <?php endif; ?>


            <div class="label half-part">
                <p>Date Start</p>
                <div class="datepicker-start" data-language='en' data-timepicker="true" ></div>
                <input type="hidden" value="<?php echo e($event->dateStart); ?>" id="dateStart" name="dateStart">
                <input type="hidden" value="<?php echo e($event->timeStart); ?>" id="timeStart" name="timeStart">
            </div>
            <?php if($errors->has('dateStart')): ?>
                <p><?php echo e($errors->first('dateStart')); ?></p>
            <?php endif; ?>
            <?php if($errors->has('timeStart')): ?>
                <p><?php echo e($errors->first('timeStart')); ?></p>
            <?php endif; ?>

            <div class="label half-part">
                <p>Date End</p>
                <div class="datepicker-end" data-language='en' data-timepicker="true" ></div>
                <input type="hidden" value="<?php echo e($event->dateEnd); ?>" id="dateEnd" name="dateEnd">
                <input type="hidden" value="<?php echo e($event->timeEnd); ?>" id="timeEnd" name="timeEnd">
            </div>

            <?php if($errors->has('dateEnd')): ?>
                <p><?php echo e($errors->first('dateEnd')); ?></p>
            <?php endif; ?>
            <?php if($errors->has('timeEnd')): ?>
                <p><?php echo e($errors->first('timeEnd')); ?></p>
            <?php endif; ?>
            <div class="label half-part">
                <p>Select category</p>
                <p>Chekin Radius</p>
                <p>Age Restrictions</p>
            </div>
            <?php if($errors->has('categoryId')): ?>
                <p><?php echo e($errors->first('categoryId')); ?></p>
            <?php endif; ?>
            <div class="label half-part">
                <select id="categoryId" name="categoryId" class="form-control<?php echo e($errors->has('categoryId') ? ' is-invalid' : ''); ?>" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option name="categoryId" value="<?php echo e($category->id); ?>" <?php echo e($event->categoryId == $category->id ? 'selected' : ''); ?>><?php echo e($category->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="chekinRadius" required>
                    <option value="10" <?php echo e($event->chekinRadius == 10 ? 'selected' : ''); ?>>10m</option>
                    <option value="30" <?php echo e($event->chekinRadius == 30 ? 'selected' : ''); ?>>30m</option>
                    <option value="50" <?php echo e($event->chekinRadius == 50 ? 'selected' : ''); ?>>50m</option>
                    <option value="80" <?php echo e($event->chekinRadius == 80 ? 'selected' : ''); ?>>80m</option>
                </select>

                <select name="ageRestrictions" required>
                    <option value="0+" <?php echo e($event->ageRestrictions == '0+' ? 'selected' : ''); ?>>0+</option>
                    <option value="6+" <?php echo e($event->ageRestrictions == '6+' ? 'selected' : ''); ?>>6+</option>
                    <option value="12+" <?php echo e($event->ageRestrictions == '12+' ? 'selected' : ''); ?>>12+</option>
                    <option value="16+" <?php echo e($event->ageRestrictions == '16+' ? 'selected' : ''); ?>>16+</option>
                    <option value="18+" <?php echo e($event->ageRestrictions == '18+' ? 'selected' : ''); ?>>18+</option>
                </select>
            </div>
            <p class="entry">Entry</p>
            <input class="radio" type="radio" id="create-ev-free" name="entry" value="free" <?php echo e($event->entry == 'free' ? 'checked' : ''); ?>>
            <label for="create-ev-free">
                <p>Free</p>
            </label>
            <input class="radio" type="radio" id="create-ev-paid" name="entry" value="paid" <?php echo e($event->entry == 'paid' ? 'checked' : ''); ?>>
            <label for="create-ev-paid">
                <p>Paid</p>
            </label>
            <input class="file" type="file" name="eventImage"  id="Header_Image" >
            <label class="Header_Image" for="Header_Image">
                <img src="<?php echo e(asset('img/pics/alt-img.png')); ?>" alt="">
                <input type="hidden" name="oldEventImage" value="<?php echo e($event->eventImage); ?>">
                <p>Upload Header Image
                    <span>(size 1920x980px)</span>
                </p>
            </label>
            <?php if($errors->has('eventImage')): ?>
                <p><?php echo e($errors->first('eventImage')); ?></p>
            <?php endif; ?>
            <div class="description-image">
                <?php if(isset($descriptionImages) && count($descriptionImages)>0): ?>
                    <?php $__currentLoopData = $descriptionImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $descriptionImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input  class="file" type="file" name="descriptionImages[]" id="Content_Image<?php echo e($descriptionImage->id); ?>">
                        <label class="Content_Image<?php echo e($descriptionImage->id); ?>" for="Content_Image<?php echo e($descriptionImage->id); ?>" style="background:url(<?php echo e(asset(stristr($descriptionImage->image, 'img'))); ?>); background-size:100% 100%">
                            <input type="hidden" name="oldDescriptionImages[]" class="oldDescriptionImages" value="<?php echo e(asset($descriptionImage->image)); ?>">
                            <img src="<?php echo e(asset('img/pics/alt-img.png')); ?>" alt="">
                            <p>Upload Content Image</p>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <input  class="file" type="file" name="descriptionImages[]" id="Content_Image" value="">
                    <label class="Content_Image" for="Content_Image">
                        <img src="<?php echo e(asset('img/pics/alt-img.png')); ?>" alt="">
                        <p>Upload Content Image</p>
                    </label>
                <?php endif; ?>
                <div class="btn for-img" id="add-more-image">
                    <p>Add More Image</p>
                </div>
            </div>
            <?php if($errors->has('descriptionImages')): ?>
                <p><?php echo e($errors->first('descriptionImages')); ?></p>
            <?php endif; ?>
            <div class="description-wrap">
                <div class="description">
                    <textarea name="description" style="width:100%; height:180px; margin-top:15px" ><?php echo e($event->description); ?></textarea>
                </div>
                <p class="description-plh" id="description-plh">Add Description</p>
            </div>
            <?php if($errors->has('description')): ?>
                <p><?php echo e($errors->first('description')); ?></p>
            <?php endif; ?>
            <p>Edit Hall</p>
            <div class="label">
                <p>Select cinema</p>
                <select id="cinemaId" name="cinemaId" class="form-control<?php echo e($errors->has('cinemaId') ? ' is-invalid' : ''); ?>" >
                    <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $eventCinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventCinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cinema->id); ?>" <?php echo e($cinema->id == $eventCinema->id ? 'selected' : ''); ?>><?php echo e($cinema->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="label">
                <p>Select hall</p>
                <select id="hallId" name="hallId" class="form-control<?php echo e($errors->has('hallId') ? ' is-invalid' : ''); ?>" >
                    <?php if(isset($eventHall) && !empty($eventHall)): ?>
                        <option value="<?php echo e($eventHall->id); ?>" <?php echo e($eventHall->id == $eventHall->id ? 'selected' : ''); ?>><?php echo e($eventHall->name); ?></option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="label">
                <?php $__currentLoopData = $eventCinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventCinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input id="address" type="text" name="address" class="form-control<?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>" value="Location: <?php echo e($eventCinema->address); ?>" required>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($errors->has('address')): ?>
                <span class="invalid-feedback">
                    <strong><?php echo e($errors->first('address')); ?></strong>
                </span>
            <?php endif; ?>
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. </h2>
            <p class="cover">Cover</p>
            <input class="file" type="file" name="coverImage" id="Cover_Image" >
            <label class="Cover_Image" for="Cover_Image">
                <input type="hidden" name="oldCoverImage" value="<?php echo e($event->coverImage); ?>">
                <img src="<?php echo e(asset('img/pics/alt-img.png')); ?>" alt="">
                <p>Upload Cover Image</p>
            </label>
            <?php if($errors->has('coverImage')): ?>
                <p><?php echo e($errors->first('coverImage')); ?></p>
            <?php endif; ?>
            <div class="change-size">
                <p>Change size</p>
                <img src="<?php echo e(asset('img/pics/small-size.png')); ?>" alt="">
                <div class="scale"></div>
                <div class="point"></div>
                <img class="big-size" src="<?php echo e(asset('img/pics/small-size.png')); ?>" alt=""> </div>
            <div class="title_for_cover-wrap">
                <div class="title_for_cover" contenteditable="true">
                    <input id="coverTitle" class="form-control<?php echo e($errors->has('coverTitle') ? ' is-invalid' : ''); ?>" type="text" name="coverTitle" value="<?php echo e($event->coverTitle); ?>" required>
                </div>
                <?php if($errors->has('coverTitle')): ?>
                    <p><?php echo e($errors->first('coverTitle')); ?></p>
                <?php endif; ?>
                <p class="title_for_cover-plh" id="title_for_cover-plh">Title for cover</p>
            </div>
            <input type="hidden" name="oldHallId" value="<?php echo e($event->hallId); ?>">
            <div style="width: 500px; height: 85px">
                <input class="submit" type="submit" name="submit" value="EDIT">
                <a href="<?php echo e(action('EventController@destroy', ['id' => $event->id])); ?>" onclick="return confirm('Delete an event?')"><p>delete event</p></a>
            </div>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $('#cinemaId').on('change', function () {
                $('#hallId').empty();
                $.post("<?php echo e(asset('checkHall')); ?>", {
                        item: $('#cinemaId').val(),
                        dateStart: $('#dateStart').val(),
                        //timeStart: $('#timeStart').val(),
                        dateEnd: $('#dateEnd').val(),
                        //timeEnd: $('#timeEnd').val()
                    },
                    function (response){
                        console.log(response);
                        $('#address').val('Location: ' + response[1][0].address);
                        for (var i = 0; i < response[0].length; i++){

                            $('#hallId').append('<option value="' + response[0][i].id + '">' + response[0][i].name + '</option>');

                        }

                        $('#hallId').find('option').each(function() {

                            var $thisOption = $(this);
                            var valueToCompare = 0;
                            for(var j = 0; j < response[2][0].length; j++) {
                                valueToCompare = response[2][0][j];

                                if ($thisOption.val() == valueToCompare) {
                                    $thisOption.attr("disabled", "disabled");
                                }
                            }
                        });
                    });
            });

            var eventImage = "<?php echo e(asset($event->eventImage)); ?>";
            var coverImage = "<?php echo e(asset($event->coverImage)); ?>";

            var showAppEventImage = eventImage.split('public/')[1];
            var showAppCoverImage = coverImage.split('public/')[1];
            if(showAppEventImage){
                eventImage = "<?php echo e(asset(stristr($event->eventImage, 'img'))); ?>";
            }
            if(showAppCoverImage){
                coverImage = "<?php echo e(asset(stristr($event->coverImage, 'img'))); ?>";
            }
            $('.Header_Image').css({'backgroundImage': 'url('+ eventImage +')','background-size': '100% 100%'});
            $('.Cover_Image').css({'backgroundImage': 'url('+ coverImage +')','background-size': '100% 100%'});

            var i = 0;
            $('#add-more-image').on('click', function(){
                i++;
                $('.description-image').append('<div><input  class="file" type="file" name="descriptionImages[]" id="Content_Image'+i+'">'+
                    '<label class="Content_Image'+i+'" for="Content_Image'+i+'">'+
                    '<img src="<?php echo e(asset('img/pics/alt-img.png')); ?>" alt="">'+
                    '<p>Upload Content Image</p>'+
                    '</label></div>');
            });

            var entry = "<?php echo e($event->entry); ?>";
            if(!entry){
                $('#create-ev-paid').attr("checked", "checked")
            }

        });
        $(document).click(function () {
            $('.file').on('change', function () {
                readURL(this);
                var oldImg = $('.'+this.id).find('.oldDescriptionImages');
                if (oldImg){
                    oldImg.remove();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            var eventStart = new Date("<?php echo e($event->dateStart . ' ' . $event->timeStart); ?>");

            var datepickerStart = $('.datepicker-start');
            var datepickerEnd = $('.datepicker-end');

            datepickerStart.datepicker().data('datepicker').selectDate(eventStart);

            datepickerStart.datepicker({
                language: 'en',
                onSelect: function (date, cellType) {
                    var dateStart = date.split(' ')[0];
                    dateStart = dateStart.split('/')[2]+'-'+dateStart.split('/')[0]+'-'+dateStart.split('/')[1];
                    var timeStart = String(cellType).split(' ')[4];
                    $('input[name="dateStart"]').val(dateStart);
                    $('input[name="timeStart"]').val(timeStart);
                }
            });

            var eventEnd = new Date("<?php echo e($event->dateEnd . ' ' . $event->timeEnd); ?>");

            datepickerEnd.datepicker().data('datepicker').selectDate(eventEnd);

            datepickerEnd.datepicker({
                language: 'en',
                startDate: eventEnd,
                onSelect: function (date, cellType) {
                    var dateEnd = date.split(' ')[0];
                    dateEnd = dateEnd.split('/')[2]+'-'+dateEnd.split('/')[0]+'-'+dateEnd.split('/')[1];
                    var timeEnd = String(cellType).split(' ')[4];
                    $('input[name="dateEnd"]').val(dateEnd);
                    $('input[name="timeEnd"]').val(timeEnd);
                }
            });

            $(window).on('load', function(){

                var  hiddenDateStart = $('#dateStart').val();
                var  hiddenTimeStart = $('#timeStart').val();
                var  eventStart = new Date(hiddenDateStart + ' ' + hiddenTimeStart);

                if(eventStart != 'Invalid Date'){
                    datepickerStart.datepicker().data('datepicker').selectDate(eventStart);
                }

                var  hiddenDateEnd = $('#dateEnd').val();
                var  hiddenTimeEnd = $('#timeEnd').val();
                var  eventEnd = new Date(hiddenDateEnd + ' ' + hiddenTimeEnd);

                if(eventEnd != 'Invalid Date'){
                    datepickerEnd.datepicker().data('datepicker').selectDate(eventEnd);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>