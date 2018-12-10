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
    <div class="event-wrapper">
        <div class="ev-header">
            <div class="ev-back">
                <?php if(isset($event->eventImage) && !empty($event->eventImage)): ?>
                    <?php if(strpos($event->eventImage, 'https://') !== false): ?>
                        <img src="<?php echo e($event->eventImage); ?>">
                    <?php else: ?>
                        <img src="<?php echo e(asset( stristr($event->eventImage, 'img'))); ?>" alt="">
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="ev-name">
                <p><?php echo e($event->ageRestrictions); ?></p>
                <h1><?php echo e($event->title); ?></h1>
            </div>
            <div class="like-it">
                <p>Like it</p>
                <img src="<?php echo e(asset('img/pics/like.svg')); ?>" alt=""> </div>
        </div>
        <div class="ev-content">
            <div class="ev-left-column">
                <div class="caption">
                    <?php if(isset($event->coverImage) && !empty($event->coverImage)): ?>
                        <?php if(strpos($event->coverImage, 'https://') !== false): ?>
                            <img src="<?php echo e($event->coverImage); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset( stristr($event->coverImage, 'img'))); ?>" alt="">
                        <?php endif; ?>
                    <?php endif; ?>
                    <p class="category">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($category->title . ','); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <p class="name"><?php echo e($event->coverTitle); ?></p>
                    <?php if(isset($cinema->name) && !empty($cinema->name)): ?>
                        <a href="<?php echo e(url('place/' . $cinema->id)); ?>">
                            <p class="place">
                                <i style="font-size:20px" class="fa">&#xf041;</i>
                                <?php echo e($cinema->name); ?>

                            </p>
                        </a>
                    <?php endif; ?>
                    <p class="address"><?php echo e($event->address); ?></p>
                    <?php if($event->price_min != $event->price_max): ?>
                        <p class="price">Price: <?php echo e($event->price_min / 100 . ' - ' . $event->price_max / 100); ?> P.</p>
                    <?php else: ?>
                        <p class="price" value="<?php echo e($event->price_max / 100); ?>">Price: <?php echo e($event->price_min / 100); ?> P.</p>
                    <?php endif; ?>
                    <div class="data">
                        <img src="<?php echo e(asset('img/pics/calendar.svg')); ?>" alt="">
                        <p><?php echo e(date('M. d',strtotime($event->dateStart))); ?> - <?php echo e(date('M. d, Y',strtotime($event->dateEnd))); ?></p>
                    </div>
                    <div class="start">
                        <img src="<?php echo e(asset('img/pics/dot.png')); ?>" alt="">
                        <p>Start <?php echo e(date('h:i A',strtotime($event->timeStart))); ?> - End <?php echo e(date('h:i A',strtotime($event->timeEnd))); ?></p>
                    </div>
                </div>
                <div class="description">
                <!--<p><?php echo e($event->description); ?></p>-->
                    <div class="description-body"><?php echo html_entity_decode($event->description); ?></div>
                </div>
                <?php $__currentLoopData = $descriptionImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="img-bar">
                        <img src="<?php echo e(asset(stristr($images->image, 'img'))); ?>" alt="">
                    </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- <div class="comments-wrap">
                    <div class="add-comments">
                        <div class="com-history">
                            <div class="history">
                                <p>1 comments</p>
                            </div>
                            <div class="oldest">
                                <p>Oldest</p>
                                <img class="arrow-down" src="<?php echo e(asset('img/pics/arrow-account.png')); ?>" alt="">
                                <div class="drope-comments">
                                    <div class="d-c-w">
                                        <div class="drope-element">
                                            <p>Oldest</p>
                                        </div>
                                        <div class="drope-element">
                                            <p>Oldest</p>
                                        </div>
                                        <div class="drope-element">
                                            <p>Oldest</p>
                                        </div>
                                        <div class="drope-element">
                                            <p>Oldest</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="new-comments">
                            <div class="add-new-com" contenteditable="true"></div>
                            <p class="add-new-com-plh" id="add-new-com">Add …</p>
                        </div>
                        <div class="btn post">
                            <p>POST</p>
                        </div>
                        <div class="btn cancel">
                            <p>cancel</p>
                        </div>
                    </div>
                    <div class="comments">
                        <img src="<?php echo e(asset('img/pics/event-coment.png')); ?>" alt="">
                        <div class="ac-name">
                            <p>Jackson Luna</p>
                            <img class="dot" src="<?php echo e(asset('img/pics/dot.png')); ?>" alt=""> </div>
                        <div class="time-ago">
                            <p>3 hrs ago</p>
                        </div>
                        <p class="post-text">With the money, he opens up a museum devoted to oddities, because he thinks people are fascinated with things like that. The museum fails to attract business, and most people reject the idea.</p>
                        <div class="reply">
                            <p>Reply 0</p>
                        </div>
                        <div class="like">
                            <p>Like 12</p>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="ev-right-column">
                <div class="ev-statist-wrap">
                    <div class="ev-soc-photo">
                        <a href="">
                            <img src="<?php echo e(asset('img/pics/fb-link-1.png')); ?>" alt="">
                        </a>
                        <a href="">
                            <img src="<?php echo e(asset('img/pics/fb-link-2.png')); ?>" alt="">
                        </a>
                        <a href="">
                            <img src="<?php echo e(asset('img/pics/fb-link-3.png')); ?>" alt="">
                        </a>
                        <a href="">
                            <img src="<?php echo e(asset('img/pics/fb-link-4.png')); ?>" alt="">
                        </a>
                        <a href="">
                            <img src="<?php echo e(asset('img/pics/fb-link-1.png')); ?>" alt="">
                        </a>
                        <a href="">
                            <img src="<?php echo e(asset('img/pics/fb-link-2.png')); ?>" alt="">
                        </a>
                        <a href="">
                            <img src="<?php echo e(asset('img/pics/fb-link-3.png')); ?>" alt="">
                        </a>
                    </div>
                    <div class="ev-statistics">
                        <p>Interested 3555
                            <span></span>Going 1256</p>
                        <img src="<?php echo e(asset('img/pics/dot.png')); ?>" alt="">
                        <p>Like 255
                            <span></span>Comments 1</p>
                        <img class="dot-2" src="<?php echo e(asset('img/pics/dot.png')); ?>" alt="">
                        <div class="share">
                            <h2>share</h2>
                            <img src="<?php echo e(asset('img/pics/share.svg')); ?>" alt=""> </div>
                    </div>
                </div>
                <form method="get" action="<?php echo e(action('EventController@getEvent')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="eventId" value="<?php echo e($event->id); ?>" id="eventId">
                    <?php if(isset($cinema) && !empty($cinema)): ?>
                        <?php if(isset($eventHall->id)): ?>
                            <input class="hallId" type="hidden" name="hallId" value="<?php echo e($eventHall->id); ?>">
                            <button id="buyTick"><p>BUY TICKET</p></button>
                        <?php else: ?>

                            <button>
                                <a target="_blank"
                                   href="<?php echo e($event->url); ?>"
                                   onclick="return window.kassirWidget.summon({url:'<?php echo e($event->url); ?>'})">
                                    BUY TICKET
                                </a>
                            </button>

                        <?php endif; ?>
                    <?php else: ?>
                        <button id="buyTick"><p>BUY TICKET</p></button>
                    <?php endif; ?>
                </form>
                <div class="left-to-event">
                    <h1>Left to event:</h1>
                    <p id="days">00
                        <span>DAYS</span>
                    </p>
                    <p>:</p>
                    <p id="hours">00
                        <span>HOUR</span>
                    </p>
                    <p>:</p>
                    <p id="minutes">00
                        <span>MIN</span>
                    </p>
                </div>
            </div>
            <?php if(isset($moreEvents) && !empty($moreEvents)): ?>
            <div class="ev-c-footer">
                <div class="f-caption">
                    <p>More Events</p>
                </div>
                <div class="container">
                    <div class="row index-row">
                        <?php $__currentLoopData = $moreEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moreEvent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2 col-sm-4 col-xs-4 col-lg-2">
                                <div class="f-event">
                                    <?php if(isset($moreEvent->coverImage) && !empty($moreEvent->coverImage)): ?>
                                        <?php if(strpos($moreEvent->coverImage, 'https://') !== false): ?>
                                            <img src="<?php echo e($moreEvent->coverImage); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset( stristr($moreEvent->coverImage, 'img'))); ?>" alt="">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <a href="<?php echo e($moreEvent->id); ?>">
                                        <div class="button">
                                            <p>action</p>
                                        </div>
                                    </a>
                                    <p><?php echo e(date('M. d, Y',strtotime($moreEvent->dateStart))); ?></p>
                                    <h1><?php echo e($moreEvent->title); ?></h1>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="places-left"><?php echo e($freePlaces); ?> places left</h3>
            <form id="buy-ticket" method="post" action="<?php echo e(action('PaypalController@payWithpaypal')); ?>">
                <?php echo csrf_field(); ?>
                <input type="text" name="count" id="count-tickets" class="number-tickets" placeholder="Enter the number of tickets">
                <div id="total">
                    <input type="hidden" name="amount" id="oldTotal" value=""><h4>Total: 0</h4>
                    <input id="guid" type="hidden" name="guid" value="">
                </div>
                <button class="next"><h2>Next</h2></button>
            </form>
        </div>

    </div>
    <script type="text/javascript">
        function S4() {
            return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
        }

        var date = "<?php echo e($event->dateStart); ?>";
        var year = date.split('-')[0];
        var mount = date.split('-')[1];
        var day = date.split('-')[2];
        var time = "<?php echo e($event->timeStart); ?>";
        var hour = time.split(':')[0];
        var min = time.split(':')[1];
        var sec = time.split(':')[2];

        var now = $.now()/1000;
        var dateStart = new Date('' + mount + '/' + day + '/' + year + ' ' + hour + ':' + min + ':' + sec + '')/1000;
        var remain_bv = dateStart - now;

        function parseTime_bv(timestamp){
            if (timestamp < 0) timestamp = 0;

            var day = Math.floor( (timestamp/60/60) / 24);
            var hour = Math.floor(timestamp/60/60);
            var mins = Math.floor((timestamp - hour*60*60)/60);
            var left_hour = Math.floor( (timestamp - day*24*60*60) / 60 / 60 );

            if(String(day).length > 1)
                $('#days').text(day).append('<span>DAYS</span>');
            else
                $('#days').text("0" + day).append('<span>DAYS</span>');

            if(String(left_hour).length > 1)
                $('#hours').text(left_hour).append('<span>HOUR</span>');
            else
                $('#hours').text("0" + left_hour).append('<span>HOUR</span>');

            if(String(mins).length > 1)
                $('#minutes').text(mins).append('<span>MIN</span>');
            else
                $('#minutes').text("0" + mins).append('<span>MIN</span>');
        }

        function setTime(){
            remain_bv = remain_bv - 1;
            parseTime_bv(remain_bv);
        }


        function eventposition(){
            var event = 0;
            $('.row').find('.col-md-2').each(function () {
                event++;
                if($(this).hasClass('clear-to-event')){
                    $(this).removeClass('clear-to-event');
                }

                if($( window ).width() < 985){
                    if(event == 4){
                        $(this).addClass('clear-to-event');
                    }
                }
            });
        }

        var price = Number($('.price').attr('value'));

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(price == 0){
                $('#buyTick').remove();
            }

            $('.next').on('click', function () {

                if ($("#total>h4").text().length == 7 || $("#total>h4").text() == 'Total: 0')
                {
                    alert('Specify number of tickets');
                    return false;
                }

                if (Number($('#count-tickets').val()) > Number("<?php echo e($freePlaces); ?>")){
                    alert('You entered too much, there are ' + "<?php echo e($freePlaces); ?>" + ' seats left');
                    return false;
                }
                var tickets = [];
                var amount = 0;

                for(var i = 0; i < $('#count-tickets').val(); i++) {
                    amount += Number("<?php echo e($event->price_min / 100); ?>");
                    tickets.push({
                        sectorId: 0,
                        row : 0,
                        place : 0,
                        price: "<?php echo e($event->price_min / 100); ?>",
                        address: "<?php echo e($event->address); ?>",
                        date: "<?php echo e($event->dateStart); ?>",
                        time: "<?php echo e($event->timeStart); ?>",
                        eventImage: "<?php echo e($event->coverImage); ?>",
                        eventName: "<?php echo e($event->title); ?>",
                        eventId: "<?php echo e($event->id); ?>"
                    });
                };
                $.post("<?php echo e(asset('save-ticket')); ?>", {tickets: tickets, amount: amount, guid: $('#guid').val()}, function (response) {

                });
            });

            setInterval(function(){
                setTime();
            }, 1000);
            setTime();

            eventposition();
            $( window ).resize(function() {
                eventposition();
            });
            var eventHall = $('.hallId').val();

            if(!eventHall){
                // Get the modal
                var modal = document.getElementById('myModal');

            // Get the button that opens the modal
                var btn = document.getElementById("buyTick");

            // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
                if(btn){
                    btn.onclick = function() {
                        modal.style.display = "block";
                        return false;
                    }
                }


            // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

            // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            }

            $('#count-tickets').change(function () {
                var text = $(this).val() * "<?php echo e($event->price_min / 100); ?>";
                if(text){
                    $('#total > h4').text('Total: ' + text);
                    $('#oldTotal').val(text);
                }else{
                    $('#total > h4').text('Total: 0');
                }
            });

            var guid = (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();

            $('#guid').val(guid);
        });

    </script>
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>" ></script>
    <script type="text/javascript">

        $("#buy-ticket").validate({
            rules: {
                count: {
                    required: true,
                    digits: true
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>