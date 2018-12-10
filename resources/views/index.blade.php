<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <!-- Main Meta information-->
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" content="public">
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <!-- Meta Information-->
    <meta name="robots" content="index, follow">
    <link type="text/plain" rel="author" href="humans.txt">
    <!-- Get html5shiv if this is IE lower or equal to 9-->
    <!--[if lte IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script type="text/javascript" src="{{asset('js/admin/jquery-1.11.1.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/conteiner.css')}}">
    <link rel="stylesheet" href="{{asset('css/datepicker.css')}}">
    <script type="text/javascript" src="https://msk.kassir.ru/start-frame.js"></script>

</head>
<body>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="first-screen-wrapper">
    <div class="menu">
        <div class="span-wrap">
            <span></span>
        </div>
        <div class="left-part-menu column-menu">
            <div class="element logo">
                <p>Showapp</p>
                <div class="img-logo">
                    <img src="{{asset('img/pics/logo.svg')}}" alt="">
                </div>
                <a href="/"></a>
            </div>
            <div class="element country el" id="element-country-el">
                <!--                 <p>Paris</p>
                                <div class="arrow">
                                    <img src="img/pics/arrow.svg" alt="">
                                </div>
                                <div class="img-cursor">
                                    <img src="img/pics/snape-country.svg" alt="">
                                </div>
                                <div class="drope-country" id="drope-country">
                                    <div class="d-c-w">
                                        <div class="drope-element">
                                            <p>USA</p>
                                        </div>
                                        <div class="drope-element">
                                            <p>Europe</p>
                                        </div>
                                        <div class="drope-element">
                                            <p>Ukraine</p>
                                        </div>
                                        <div class="drope-element">
                                            <p>Russia</p>
                                        </div>
                                    </div>
                                </div> -->
                <select name="sources" id="sources" class="custom-select sources" placeholder="Country">
                    <option value="Ukraine">Ukraine</option>
                    <option value="France">France</option>
                    <option value="Russia">Russia</option>
                </select>
            </div>


            <div class="element language el" id="element-language-el">
                <!--                 <p>EN</p>
                                <div class="arrow">
                                    <img src="img/pics/arrow.svg" alt="">
                                </div>
                                <div class="drope-language" id="drope-language">
                                    <div class="d-r-l-w">
                                        <div class="drope-element">
                                            <p>RU</p>
                                        </div>
                                        <div class="drope-element">
                                            <p>RU</p>
                                        </div>
                                    </div>
                                </div> -->
                <select name="sources" id="sources" class="custom-select sources" placeholder="Language">
                    <option value="EN">EN</option>
                    <option value="RU">RU</option>
                </select>
            </div>
        </div>

        <div class="right-part-menu column-menu">
            <div class="element search el" id="element-search-el">
                <img src="{{asset('img/pics/search.svg')}}" alt="">
            </div>
            @if(isset(Auth::user()->firstName) && !empty(Auth::user()->firstName))
                <a class="element account profile" href="/account">
                    <p>{{Auth::user()->firstName}}</p>
                    @if(isset(Auth::user()->photo) && !empty(Auth::user()->photo))
                        @if(strpos(Auth::user()->photo, 'https://') !== false)
                            <img src="{{Auth::user()->photo}}">
                        @else
                            <img src="{{asset( stristr(Auth::user()->photo, 'img'))}}" alt="">
                        @endif
                    @else
                        <img src="{{asset( 'img/pics/no-photo-doctor.gif')}}" alt="">
                    @endif
                </a>
            @else
                <a class="element account profile" href="/login-to-account">
                    <p>LOGIN</p>
                </a>
            @endif
            <a class="element account login" href="/login-to-account">
                <p>Register / Log In</p>
            </a>
            <!--<a class="element shoping-car" href="event_cart">
                <img src="img/pics/s-cart.svg" alt="">
            </a>-->
            <div class="element burger-wrap el">
                <div class="burger-wrapper">
                    <div class="burger"></div>
                </div>
            </div>
        </div>
        <div class="burger-part-menu el">
            <div class="w-burg-p">
                <div class="wrap-mobile-leng">
                    <div class="element language">
                        <p>EN</p>
                        <div class="arrow">
                            <img src="{{asset('img/pics/arrow-down.png')}}" alt="">
                        </div>
                    </div>
                </div>
                @if(!Auth::user())
                    <div class="menu-item">
                        <a href="/login-to-account">LOGIN</a>
                    </div>
                    <div class="menu-item" id="create-account">
                        <a href="/create-account">Create-account</a>
                    </div>
                @endif
                <div class="menu-item">
                    <a href="/account">Account</a>
                </div>
            <!--<div class="menu-item">
                    <a href="/buy-ticket">Buy ticket</a>
                </div>-->
                <div class="menu-item">
                    <a href="/create-event">Create event</a>
                </div>
                <div class="menu-item">
                    <a href="/my_events">My events</a>
                </div>
                <div class="menu-item">
                    <a href="/event">Events</a>
                </div>
                <!-- <div class="menu-item">
                     <a href="/event_cart">Event cart</a>
                 </div>-->
                <div class="menu-item">
                    <a href="/personal_information">Personal information</a>
                </div>
                <div class="menu-item news">
                    <a href="/news">News</a>
                </div>
                @if(Auth::user())
                    <div class="menu-item" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/logout"
                           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="bottom-part-menu el" id="bottom-part-menu-el">
            <div class="w-b-p">
                <div class="search-event">
                    <div class="content-wrap">
                        <form method="post" action="{{action('IndexController@search')}}">
                            @csrf
                            <input type="text" name="search" placeholder="SEARCH YOUR EVENT" maxlength="30">
                            <button class="search-button">search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session()->has('message'))
        <h4 style="margin-top: 120px">{{session()->get('message')}}</h4>
    @endif
    <div class="first-screen" id="first-screen">
        @foreach($allEvent as $event)
            <div class="f-w">
                <div class="w-i orig">
                    <div class="clip-wrap">
                        <div class="content-wrap">
                            <div class="first-screen-back">
                                <div class="efect-wrap"></div>
                                <div class="overlay"></div>
                                <div class="img-wrap" id="img-wrap">
                                    @if(isset($event->eventImage) && !empty($event->eventImage))
                                        @if(strpos($event->eventImage, 'https://') !== false)
                                            <img src="{{$event->eventImage}}">
                                        @else
                                            <img src="{{asset( stristr($event->eventImage, 'img'))}}" alt="">
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="first-screen-footer">
                                <p class="age">{{$event->ageRestrictions}}</p>
                                <h1>{{$event->title}}</h1>
                                <div class="buton btns">
                                    <i></i>
                                    <a href="{{'event/' . $event->id}}">DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="drag-wrap" style="display: none">
        <p>DRAG</p>
        <div class="scale">
            <div class="the-slider"></div>
            <div class="line"></div>
            <div class="arrow-btn">
                <img src="{{asset('img/pics/drag-arrow.png')}}" alt="">
            </div>
        </div>
    </div>
</div>
<div class="wrapper-stick" id="wrapper-stick">
    <div class="wrapper-filter">
        <div class="filter-head">
            <h2>All Events</h2>
        </div>
        <div class="filter-w">
            <div class="filter-item-w">
                <ul class="nav">
                    <li class="button-dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            Category <span>▼</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                @foreach($categories as $category)
                                    <div class="drope-element">
                                        <p>{{$category->title}}</p>
                                        <input type="hidden" value="{{$category->id}}">
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p class="date">
                            Date
                        </p>
                    </li>
                    <li class="button-dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            Start <span>▼</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="datepicker-start" data-language='en' ></div>
                                <input type="hidden" value="" id="dateStart" name="dateStart">
                                <input type="hidden" value="" id="timeStart" name="timeStart">
                            </li>
                        </ul>
                    </li>
                    <li class="button-dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            End <span>▼</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="datepicker-end" data-language='en' ></div>
                                <input type="hidden" value="" id="dateEnd" name="dateEnd">
                                <input type="hidden" value="" id="timeEnd" name="timeEnd">
                            </li>
                        </ul>
                    </li>
                </ul>

            <!--                 <div class="filter-item drop categ el">
                    <div class="name cat-chooser">
                        <p>movies</p>
                    </div>
                    <div class="drope-categ">
                        <div class="w-d-c">
                            @foreach($categories as $category)
                <div class="drope-element">
                    <p>{{$category->title}}</p>
                                    <input type="hidden" value="{{$category->id}}">
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>

            <div class="filter-item name-i">
                <div class="name">
                    <p>DATE</p>
                </div>
            </div>
            <div class="filter-item drop categ el">
                <div class="name cat-chooser">
                    <p>start</p>
                </div>
                <div class="drope-categ">
                    <div class="w-d-c">
                        <div class="drope-element">
                            <div class="datepicker-start" data-language='en'></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter-item drop categ el">
                <div class="name cat-chooser">
                    <p>end</p>
                </div>
                <div class="drope-categ">
                    <div class="w-d-c">
                        <div class="drope-element">
                            <div class="datepicker-end" data-language='en'></div>
                        </div>
                    </div>
                </div>
            </div> -->
            </div>
        </div>
    </div>
    <div class="stick-w" id="stick-w">
        <div class="container">
            <div class="row index-row">
        @foreach($allEvent as $event )
            <div class="col-md-2 col-sm-3 col-xs-4 col-lg-2">
            <a class="stick-item" href="event/{{$event->id}}">
                <div class="event">
                    <div class="stick-img">
                        <div class="stick-type">
                            <p>action</p>
                        </div>
                        @if(isset($event->coverImage) && !empty($event->coverImage))
                            @if(strpos($event->coverImage, 'https://') !== false)
                                <img src="{{asset($event->coverImage)}}">
                            @else
                                <img src="{{asset( stristr($event->coverImage, 'img'))}}" alt="">
                            @endif
                        @endif
                    </div>
                    <div class="date">
                        <p>{{date('M. d, Y',strtotime($event->dateStart))}}</p>
                    </div>
                    <div class="stick-name">
                        <p>{{$event->title}}</p>
                    </div>
                </div>
            </a>
            </div>
        @endforeach
            </div>
        </div>
    </div>
    {{$allEvent->render()}}
</div>
<div class="phone-wrap">
    <div class="caption-wrap">
        <div class="iphon">
            <img class="circle" src="{{asset('img/pics/2-layers.png')}}" alt="">
            <div class="slider-border"></div>
            <div class="slider">
                <div class="slider-item">
                    <img src="{{asset('img/pics/slid.jpg')}}" alt="">
                </div>
                <div class="slider-item">
                    <img src="{{asset('img/pics/slid2.jpg')}}" alt="">
                </div>
                <div class="slider-item">
                    <img src="{{asset('img/pics/slid.jpg')}}" alt="">
                </div>
                <div class="slider-item">
                    <img src="{{asset('img/pics/slid2.jpg')}}" alt="">
                </div>
            </div>
        </div>
        <h1>Create, Explore <br> and Visit Events in the World.</h1>
        <p>Find your audience and give more visibility for your event.</p>
        <div class="btn">
            <div class="half-of-button">
                <img src="{{asset('img/pics/apple.svg')}}" alt="">
                <p>Download on the </p>
                <h1>App Store</h1>
            </div>
            <div class="half-of-button right-part">
                <img src="{{asset('img/pics/google.svg')}}" alt="">
                <p>GET IN ON</p>
                <h1>Google Play</h1>
            </div>
        </div>
    </div>
</div>
<div class="about-showapp-wrap">
    <h1>About Showapp</h1>
    <p>An application that can make your life vibrant and rich.</p>
    <p>All events of the city are selected according to your interests and combined in one news line. With Showapp you are always up to date: </p>
    <p>Where to go with a girl today or where to relax with friends in a week? </p>
    <p>Where can I see the full report of the photo and video of the event that has already taken place? </p>
    <p>Where to share emotions with other party members?</p>
    <p class="part">Get invitations, according to your interests, or create your own events for free.</p>
    <p>We invite friends to go with you and share their plans in social networks. Find a route on the map and discuss what's happening in the comments.</p>
    <p>ShowApp is a complete poster of events in your city and a convenient guide for any entertainment.</p>
    <div class="social-item-wrap">
        <div class="social-wrap">
            <div class="caption">
                <p>Facebook</p>
            </div>
            <div class="content">
                <img class="back" src="{{asset('img/pics/showapp-fb.png')}}" alt="">
                <div class="logo">
                    <img src="{{asset('img/pics/show-app.svg')}}" alt="">
                </div>
                <div class="likes">
                    <p class="capt">Showapp</p>
                    <p>105,567 likes</p>
                </div>
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
                <div class="btn">
                    <div class="img-wrapper">
                        <img src="{{asset('img/pics/forma-1.svg')}}" alt="">
                    </div>
                    <p>Follow</p>
                </div>
            </div>
        </div>
        <div class="social-wrap">
            <div class="caption">
                <p>Instagram</p>
            </div>
            <div class="content inst">
                <div class="content"></div>
                <img class="back" src="{{asset('img/pics/about-showapp-inst.png')}}" alt="">
                <div class="logo">
                    <img src="{{asset('img/pics/show-app.svg')}}" alt="">
                </div>
                <div class="likes">
                    <p class="capt">showapp.ru</p>
                    <p>18.8k followers</p>
                </div>
                <a href="">
                    <img src="{{asset('img/pics/inst-link-1.png')}}" alt="">
                </a>
                <a href="">
                    <img src="{{asset('img/pics/inst-link-2.png')}}" alt="">
                </a>
                <a href="">
                    <img src="{{asset('img/pics/inst-link-3.png')}}" alt="">
                </a>
                <div class="btn">
                    <p>Follow</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">


    function createEvents(response, address, sort, lengthOfData) {
        if(lengthOfData == 0){
            $('.index-row').empty();
        }

        $('.pagination').css('display', 'none');
        for (var i = 0; i <= response.length; i++) {
            if (typeof response[i] == 'object') {
                var img = response[i].coverImage;
                if(response[i].coverImage.split('public/')[1]){
                    img = response[i].coverImage.split('public/')[1];
                }
                $('.index-row').append(
                    '<div class="col-md-2 col-sm-3 col-xs-4 col-lg-2">' +
                    '<a class="stick-item" href="event/' + response[i].id + '">' +
                    '<div class="event">' +
                    '<div class="stick-img">' +
                    '<div class="stick-type">' +
                    '<p>action</p>' +
                    '</div>' +
                    '<img src="' + img + '" alt="">' +
                    '</div>' +
                    '<div class="date">' +
                    '<p>' + formatDate(new Date(response[i].dateStart)) + '</p>' +
                    '</div>' +
                    '<div class="stick-name">' +
                    '<p>' + response[i].title + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</a>' +
                    '</div>'
                );
            }
        }
        if(lengthOfData >= 0){
            $('.btn').remove();
        }
        makeMoreButton(lengthOfData ,address, sort);
        if(response.length < 24){
            $('.btn').remove();
        }

        eventposition();
    }

    function makeMoreButton(lengthOfData, address, sort){

        $('.stick-w').append(
            '<div class="btn btns" page-index="' + lengthOfData + '">' +
            '<i></i>' +
            '<p>More</p>' +
            '</div>'
        );
        $('.btn').on('click', function () {
            lengthOfData++;
            $.post(address, {
                    lengthOfData: lengthOfData,
                    data: sort
                },
                function (response) {
                    if(response){
                        createEvents(response, address, sort, lengthOfData)
                    }

                });

        });

    }

    function formatDate(date) {
        var monthNames = [
            "Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return monthNames[monthIndex] + '. ' + day + ', ' + year;
    }

    function getCurrentLocation(){
        $.getJSON('https://ipinfo.io/geo', function(response) {
            $('.custom-select-trigger').text(response.city);
        });
    }
    function eventposition(){
        var event = 0;
        $('.row').find('.col-md-2').each(function () {
            event++;
            if($(this).hasClass('clear-to-event')){
                $(this).removeClass('clear-to-event');
            }
            if($( window ).width() > 1000){
                if(event % 6 == 1){
                    $(this).addClass('clear-to-event');
                }
            }
            if($( window ).width() < 1000 && $( window ).width() > 768){
                if(event % 4 == 1){
                    $(this).addClass('clear-to-event');
                }
            }
            if($( window ).width() < 768){
                if(event % 3 == 1){
                    $(this).addClass('clear-to-event');
                }
            }
        });
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.pagination').find('.page-link').each(function () {
            var oldLink = $(this).attr('href');
            if(oldLink != undefined){
                var pageNumber = oldLink.split('=');
                var curentUrl = window.location.origin + window.location.pathname;
                var newLink = curentUrl + '?page=' + pageNumber[1];
                $(this).attr('href', newLink);
            }

        });

        eventposition();

        $( window ).resize(function() {
            eventposition();
        });


        getCurrentLocation();

        var sort = true;
        var address = true;


        $('.drope-element').on('click', function() {
            var lengthOfData = 0;
            var id = $(this).find('input').val();
            sort = id;
            address = "{{asset('sorting-events')}}";
            $.post(address, {
                data: sort
            }, function(response) {
                if (response != 'false') {
                    createEvents(response, address, sort, lengthOfData);
                }
            });
        });



        $('.datepicker-start').datepicker({
            language: 'en',
            onSelect: function(date, cellType) {
                var lengthOfData = 0;
                var dateStart = date.split(' ')[0];
                dateStart = dateStart.split('/')[2] + '-' + dateStart.split('/')[0] + '-' + dateStart.split('/')[1];
                sort = [dateStart, "dateStart"];
                address = "{{asset('sorting-events-by-date')}}";
                $.post(address, {
                    data: sort
                }, function(response) {
                    if (response != 'false') {
                        createEvents(response, address, sort, lengthOfData);
                    }
                });
            }
        });
        $('.datepicker-end').datepicker({
            language: 'en',
            onSelect: function(date, cellType) {
                var lengthOfData = 0;
                var dateEnd = date.split(' ')[0];
                dateEnd = dateEnd.split('/')[2] + '-' + dateEnd.split('/')[0] + '-' + dateEnd.split('/')[1];
                sort = [dateEnd, "dateEnd"];
                address = "{{asset('sorting-events-by-date')}}";
                $.post(address, {
                    data: sort
                }, function(response) {
                    if (response != 'false') {
                        createEvents(response, address, sort, lengthOfData);
                    }
                });
            }
        });
    });
</script>

<script type="text/javascript">
    $('.first-screen-wrapper,  .img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig').height(window.innerHeight + 'px');
    $('.caption-wrap, .img-wrap, .img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig, .footer-center').width(window.innerWidth + 'px');
</script>

<script type="text/javascript">
    $(window).resize(function() {
        $('.first-screen-wrapper, .img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig ').height(window.innerHeight + 'px');
        $('.img-wrap, .first-screen, .f-w, .first-screen-back, .w-i, .orig ').width(window.innerWidth + 'px');
    });
    $(document).ready(function() {
        $("#datepickers-container").hide();
    });
</script>

<script type="text/javascript">
    $(".custom-select").each(function() {
        var classes = $(this).attr("class"),
            id = $(this).attr("id"),
            name = $(this).attr("name");
        var template = '<div class="' + classes + '">';
        template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
        template += '<div class="custom-options">';
        $(this).find("option").each(function() {
            template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
        });
        template += '</div></div>';

        $(this).wrap('<div class="custom-select-wrapper"></div>');
        $(this).hide();
        $(this).after(template);
    });
    $(".custom-option:first-of-type").hover(function() {
        $(this).parents(".custom-options").addClass("option-hover");
    }, function() {
        $(this).parents(".custom-options").removeClass("option-hover");
    });
    $(".custom-select-trigger").on("click", function() {
        $('html').one('click', function() {
            $(".custom-select").removeClass("opened");
        });
        $(this).parents(".custom-select").toggleClass("opened");
        event.stopPropagation();
    });
    $(".custom-option").on("click", function() {
        $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
        $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
        $(this).addClass("selection");
        $(this).parents(".custom-select").removeClass("opened");
        $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function(e) {
        function t(t) {
            e(t).bind("click", function(t) {
                t.preventDefault();
                e(this).parent().fadeOut()
            })
        }
        e(".dropdown-toggle").click(function() {
            var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
            e(".button-dropdown .dropdown-menu").hide('slow');
            e(".button-dropdown .dropdown-toggle").removeClass("active");
            if (t) {
                e(this).parents(".button-dropdown").children(".dropdown-menu").toggle('slow').parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
            }
        });

         e(document).bind("click", function(t) {
             var n = e(t.target);
             if (!n.parents().hasClass("button-dropdown") || n.parents().hasClass("dropdown-menu")){
                 if(n.parent().hasClass('datepicker--nav-action') || n.parent().hasClass('datepicker--nav-title') || n.hasClass('datepicker--nav-title')) return false;
                     e(".button-dropdown .dropdown-menu").hide();
             }

         });
         e(document).bind("click", function(t) {
             var n = e(t.target);
             if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
          })
    });
    /*
    $.getJSON('https://ipinfo.io/geo', function(response) {
    var loc = response.loc.split(',');
    var coords = {
        latitude: loc[0],
        longitude: loc[1]
    };
});
*/
</script>

@include('layouts.footer')