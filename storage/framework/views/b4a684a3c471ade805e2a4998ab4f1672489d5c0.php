<!DOCTYPE html>
<html>
<head>
    <title><?php echo $__env->yieldContent('title'); ?></title>
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
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/datepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/conteiner.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="<?php echo e(asset('js/admin/jquery-1.11.1.js')); ?>"></script>
    <script type="text/javascript" src="https://msk.kassir.ru/start-frame.js"></script>


</head>
<body>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="menu">
    <div class="span-wrap">
        <span></span>
    </div>
    <div class="left-part-menu column-menu">
        <div class="element logo">
            <p>Showapp</p>
            <div class="img-logo">
                <img src="<?php echo e(asset('img/pics/logo.svg')); ?>" alt="">
            </div>
            <a href="<?php echo e(route('/')); ?>"></a>
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
            <img src="<?php echo e(asset('img/pics/search.svg')); ?>" alt="">
        </div>
        <?php if(isset(Auth::user()->firstName) && !empty(Auth::user()->firstName)): ?>
            <a class="element account profile" href="<?php echo e(route('account')); ?>">
                <p><?php echo e(Auth::user()->firstName); ?></p>
                <?php if(isset(Auth::user()->photo) && !empty(Auth::user()->photo)): ?>
                    <?php if(strpos(Auth::user()->photo, 'https://') !== false): ?>
                        <img src="<?php echo e(Auth::user()->photo); ?>">
                    <?php else: ?>
                        <img src="<?php echo e(asset( stristr(Auth::user()->photo, 'img'))); ?>" alt="">
                    <?php endif; ?>
                <?php else: ?>
                    <img src="<?php echo e(asset( 'img/pics/no-photo-doctor.gif')); ?>" alt="">
                <?php endif; ?>
            </a>
        <?php else: ?>
            <a class="element account profile" href="<?php echo e(route('login-to-account')); ?>">
                <p>LOGIN</p>
            </a>
        <?php endif; ?>
        <a class="element account login" href="<?php echo e(route('login-to-account')); ?>">
            <p>Register / Log In</p>
        </a>
        <!--<a class="element shoping-car" href="route('event_cart')">
            <img src="asset('img/pics/s-cart.svg')" alt="">
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
                        <img src="<?php echo e(asset('img/pics/arrow-down.png')); ?>" alt="">
                    </div>
                </div>
            </div>
            <?php if(!Auth::user()): ?>
                <div class="menu-item">
                    <a href="<?php echo e(route('login-to-account')); ?>">Login</a>
                </div>
                <div class="menu-item" id="create-account">
                    <a href="<?php echo e(route('create-account')); ?>">Create-account</a>
                </div>
            <?php endif; ?>
            <div class="menu-item">
                <a href="<?php echo e(route('/')); ?>">Home</a>
            </div>
            <div class="menu-item">
                <a href="<?php echo e(route('account')); ?>">Account</a>
            </div>
            <div class="menu-item">
                <a href="<?php echo e(route('create-event')); ?>">Create event</a>
            </div>
            <div class="menu-item">
                <a href="<?php echo e(route('my_events')); ?>">My events</a>
            </div>
            <div class="menu-item">
                <a href="<?php echo e(route('event')); ?>">Events</a>
            </div>
            <!-- <div class="menu-item">
                 <a href="route('event_cart')">Event cart</a>
             </div>-->
            <div class="menu-item">
                <a href="<?php echo e(route('personal_information')); ?>">Personal information</a>
            </div>
            <div class="menu-item news">
                <a href="<?php echo e(route('news')); ?>">News</a>
            </div>
            <?php if(Auth::user()): ?>
                <div class="menu-item" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                       onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                        <?php echo e(__('Logout')); ?>

                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="bottom-part-menu el" id="bottom-part-menu-el">
        <div class="w-b-p">
            <div class="search-event">
                <div class="content-wrap">
                    <form method="post" action="<?php echo e(action('IndexController@search')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="search" placeholder="SEARCH YOUR EVENT">
                        <button class="search-button">search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(session()->has('message')): ?>
    <h4 style="margin-top: 120px"><?php echo e(session()->get('message')); ?></h4>
<?php endif; ?>

<script type="text/javascript">

    function getCurrentLocation(){
        $.getJSON('https://ipinfo.io/geo', function(response) {
            $('.custom-select-trigger').text(response.city);
        });
    }

    $(document).ready(function () {

        getCurrentLocation();

      /*  var clicks = 0;

        $('#element-country-el').click(function() {
            if ((clicks % 2) == 0){
                $("#drope-country").css({visibility: 'visible'});
            } else{
                $("#drope-country").css({visibility: 'hidden'});
            }
            ++clicks;
        });

        $('#element-language-el').click(function() {
            if ((clicks % 2) == 0){
                $("#drope-language").css({visibility: 'visible'});
            } else{
                $("#drope-language").css({visibility: 'hidden'});
            }
            ++clicks;
        });

        $('#element-search-el').click(function() {
            if ((clicks % 2) == 0){
                $("#bottom-part-menu-el").css({visibility: 'visible'});
            } else{
                $("#bottom-part-menu-el").css({visibility: 'hidden'});
            }
            ++clicks;
        });*/

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
    //event https://msk.kassir.ru/frame/entry/index?type=E&id=120627&key=bba08892-3135-a4b4-bd4e-9b4c5d91aad5
//place https://msk.kassir.ru/frame/entry/index?type=V&id=8884&key=bba08892-3135-a4b4-bd4e-9b4c5d91aad5
//categor https://msk.kassir.ru/frame/entry/index?type=C&id=3008&key=bba08892-3135-a4b4-bd4e-9b4c5d91aad5
//PO https://msk.kassir.ru/frame/entry/index?type=D&key=bba08892-3135-a4b4-bd4e-9b4c5d91aad5
//https://msk.kassir.ru/frame/feed/xml?key=9b700613-ce77-d1a9-f169-50ee8e9c764f
//https://msk.kassir.ru/frame/feed/xml?key=bba08892-3135-a4b4-bd4e-9b4c5d91aad5
</script>
