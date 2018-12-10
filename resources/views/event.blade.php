@extends('layouts.default')

@section('content')
    <div class="thank-you-wrap">
        <div class="thank-you">
            <img class="event-was-created" src="{{asset('img/pics/create-event.png')}}" alt="">
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
                @if(isset($event->eventImage) && !empty($event->eventImage))
                    @if(strpos($event->eventImage, 'https://') !== false)
                        <img src="{{$event->eventImage}}">
                    @else
                        <img src="{{asset( stristr($event->eventImage, 'img'))}}" alt="">
                    @endif
                @endif
            </div>
            <div class="ev-name">
                <p>{{$event->ageRestrictions}}</p>
                <h1>{{$event->title}}</h1>
            </div>
            <div class="like-it">
                <p>Like it</p>
                <img src="{{asset('img/pics/like.svg')}}" alt=""> </div>
        </div>
        <div class="ev-content">
            <div class="ev-left-column">
                <div class="caption">
                    @if(isset($event->coverImage) && !empty($event->coverImage))
                        @if(strpos($event->coverImage, 'https://') !== false)
                            <img src="{{$event->coverImage}}">
                        @else
                            <img src="{{asset( stristr($event->coverImage, 'img'))}}" alt="">
                        @endif
                    @endif
                    <p class="category">
                        @foreach($categories as $category)
                            {{$category->title . ','}}
                        @endforeach
                    </p>
                    <p class="name">{{$event->coverTitle}}</p>
                    @if(isset($cinema->name) && !empty($cinema->name))
                        <a href="{{url('place/' . $cinema->id)}}">
                            <p class="place">
                                <i style="font-size:20px" class="fa">&#xf041;</i>
                                {{$cinema->name}}
                            </p>
                        </a>
                    @endif
                    <p class="address">{{$event->address}}</p>
                    @if($event->price_min != $event->price_max)
                        <p class="price">Price: {{$event->price_min / 100 . ' - ' . $event->price_max / 100}} P.</p>
                    @else
                        <p class="price" value="{{$event->price_max / 100}}">Price: {{$event->price_min / 100}} P.</p>
                    @endif
                    <div class="data">
                        <img src="{{asset('img/pics/calendar.svg')}}" alt="">
                        <p>{{date('M. d',strtotime($event->dateStart))}} - {{date('M. d, Y',strtotime($event->dateEnd))}}</p>
                    </div>
                    <div class="start">
                        <img src="{{asset('img/pics/dot.png')}}" alt="">
                        <p>Start {{date('h:i A',strtotime($event->timeStart))}} - End {{date('h:i A',strtotime($event->timeEnd))}}</p>
                    </div>
                </div>
                <div class="description">
                <!--<p>{{$event->description}}</p>-->
                    <div class="description-body">{!! html_entity_decode($event->description)!!}</div>
                </div>
                @foreach($descriptionImages as $images)
                    <div class="img-bar">
                        <img src="{{asset(stristr($images->image, 'img'))}}" alt="">
                    </div>
            @endforeach
            <!-- <div class="comments-wrap">
                    <div class="add-comments">
                        <div class="com-history">
                            <div class="history">
                                <p>1 comments</p>
                            </div>
                            <div class="oldest">
                                <p>Oldest</p>
                                <img class="arrow-down" src="{{asset('img/pics/arrow-account.png')}}" alt="">
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
                        <img src="{{asset('img/pics/event-coment.png')}}" alt="">
                        <div class="ac-name">
                            <p>Jackson Luna</p>
                            <img class="dot" src="{{asset('img/pics/dot.png')}}" alt=""> </div>
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
                            <img src="{{asset('img/pics/fb-link-1.png')}}" alt="">
                        </a>
                        <a href="">
                            <img src="{{asset('img/pics/fb-link-2.png')}}" alt="">
                        </a>
                        <a href="">
                            <img src="{{asset('img/pics/fb-link-3.png')}}" alt="">
                        </a>
                        <a href="">
                            <img src="{{asset('img/pics/fb-link-4.png')}}" alt="">
                        </a>
                        <a href="">
                            <img src="{{asset('img/pics/fb-link-1.png')}}" alt="">
                        </a>
                        <a href="">
                            <img src="{{asset('img/pics/fb-link-2.png')}}" alt="">
                        </a>
                        <a href="">
                            <img src="{{asset('img/pics/fb-link-3.png')}}" alt="">
                        </a>
                    </div>
                    <div class="ev-statistics">
                        <p>Interested 3555
                            <span></span>Going 1256</p>
                        <img src="{{asset('img/pics/dot.png')}}" alt="">
                        <p>Like 255
                            <span></span>Comments 1</p>
                        <img class="dot-2" src="{{asset('img/pics/dot.png')}}" alt="">
                        <div class="share">
                            <h2>share</h2>
                            <img src="{{asset('img/pics/share.svg')}}" alt=""> </div>
                    </div>
                </div>
                <form method="get" action="{{action('EventController@getEvent')}}">
                    @csrf
                    <input type="hidden" name="eventId" value="{{$event->id}}" id="eventId">
                    @if((isset($cinema) && !empty($cinema)) || (isset($event->url) && !empty($event->url)))
                        @if(isset($eventHall->id))
                            <input class="hallId" type="hidden" name="hallId" value="{{$eventHall->id}}">
                            <button id="buyTick"><p>BUY TICKET</p></button>
                        @else

                            <button>
                                <a target="_blank"
                                   href="{{$event->url}}"
                                   onclick="return window.kassirWidget.summon({url:'{{$event->url}}'})">
                                    BUY TICKET
                                </a>
                            </button>

                        @endif
                    @else
                        <button id="buyTick"><p>BUY TICKET</p></button>
                    @endif
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
            @if(isset($moreEvents) && !empty($moreEvents))
            <div class="ev-c-footer">
                <div class="f-caption">
                    <p>More Events</p>
                </div>
                <div class="container">
                    <div class="row index-row">
                        @foreach($moreEvents as $moreEvent)
                            <div class="col-md-2 col-sm-4 col-xs-4 col-lg-2">
                                <div class="f-event">
                                    @if(isset($moreEvent->coverImage) && !empty($moreEvent->coverImage))
                                        @if(strpos($moreEvent->coverImage, 'https://') !== false)
                                            <img src="{{$moreEvent->coverImage}}">
                                        @else
                                            <img src="{{asset( stristr($moreEvent->coverImage, 'img'))}}" alt="">
                                        @endif
                                    @endif
                                    <a href="{{$moreEvent->id}}">
                                        <div class="button">
                                            <p>action</p>
                                        </div>
                                    </a>
                                    <p>{{date('M. d, Y',strtotime($moreEvent->dateStart))}}</p>
                                    <h1>{{$moreEvent->title}}</h1>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="places-left">{{$freePlaces}} places left</h3>
            <form id="buy-ticket" method="post" action="{{action('PaypalController@payWithpaypal')}}">
                @csrf
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

        var date = "{{$event->dateStart}}";
        var year = date.split('-')[0];
        var mount = date.split('-')[1];
        var day = date.split('-')[2];
        var time = "{{$event->timeStart}}";
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

                if (Number($('#count-tickets').val()) > Number("{{$freePlaces}}")){
                    alert('You entered too much, there are ' + "{{$freePlaces}}" + ' seats left');
                    return false;
                }
                var tickets = [];
                var amount = 0;

                for(var i = 0; i < $('#count-tickets').val(); i++) {
                    amount += Number("{{$event->price_min / 100}}");
                    tickets.push({
                        sectorId: 0,
                        row : 0,
                        place : 0,
                        price: "{{$event->price_min / 100}}",
                        address: "{{$event->address}}",
                        date: "{{$event->dateStart}}",
                        time: "{{$event->timeStart}}",
                        eventImage: "{{$event->coverImage}}",
                        eventName: "{{$event->title}}",
                        eventId: "{{$event->id}}"
                    });
                };
                $.post("{{asset('save-ticket')}}", {tickets: tickets, amount: amount, guid: $('#guid').val()}, function (response) {

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
                var text = $(this).val() * "{{$event->price_min / 100}}";
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
    <script src="{{asset('js/jquery.validate.min.js')}}" ></script>
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
@endsection