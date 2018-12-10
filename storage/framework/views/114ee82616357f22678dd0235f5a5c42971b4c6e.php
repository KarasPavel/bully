<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/font-awesome.css')); ?>" type="text/css" /><!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/bootstrap.css')); ?>" type="text/css" /><!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/ion.rangeSlider.skinNice.css')); ?>" type="text/css" /><!-- Range Slider -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/ion.rangeSlider.css')); ?>" type="text/css" /><!-- Range Slider -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/normalize.min.css')); ?>" type="text/css" /><!-- Range Slider -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/style.css')); ?>" type="text/css" /><!-- Style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/responsive.css')); ?>" type="text/css" /><!-- Responsive -->
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">

    <script type="text/javascript" src="<?php echo e(asset('js/admin/jquery-1.11.1.js')); ?>"></script>

</head>
<body>

<div class="main">
    <div class="page-container menu-left">
        <aside class="sidebar">
            <div class="profile-stats">
                <div class="mini-profile">
                    <span><img src="<?php echo e(asset('img/pics/me.jpg')); ?>" alt="" /></span>
                    <h3>Labrina Scholer</h3>
                    <h6 class="status online"><i></i> Online</h6>

                </div>
                <div class="quick-stats">
                    <h5>Today Report</h5>
                    <ul>
                        <li><span>456<i>Sales</i></span></li>
                        <li><span>2,345<i>Order</i></span></li>
                        <li><span>$120<i>Revenue</i></span></li>
                    </ul>
                </div>
            </div>
            <div class="menu-sec">
                <div id="menu-toogle" class="menus">
                    <div class="single-menu">
                        <h2><a title=""><i class="fa fa-home"></i><span>Dashboards</span></a><i class="blue">1</i></h2>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="<?php echo e(route('admin/cinema-management')); ?>" title="">Cinema management</a></li>
                                <!--<li><a href="<?php echo e(route('admin/user-management')); ?>" title="">User management</a></li>
                                <li><a href="<?php echo e(route('admin/event-management')); ?>" title="">Event management</a></li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="single-menu">
                        <h2><a title=""><i class="fa fa-home"></i><span>Hall management</span></a><i class="blue">2</i></h2>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="<?php echo e(route('admin/cinema-management/hall-management')); ?>" title="">Hall</a></li>
                                <li><a href="<?php echo e(route('admin/cinema-management/hall/sector')); ?>" title="">Sector</a></li>
                                <!--<li><a href="<?php echo e(route('admin/cinema-management/hall/row')); ?>" title="">Row</a></li>
                                <li><a href="<?php echo e(route('admin/cinema-management/hall/place')); ?>" title="">Place</a></li>-->
                            </ul>
                        </div>
                        <!--<div class="single-menu">
                            <h2><a title=""><i class="fa fa-home"></i><span>Event management</span></a><i class="blue">3</i></h2>
                            <div class="sub-menu">
                                <ul>
                                    <li><a href="<?php echo e(route('admin/create-event')); ?>" title="">Create event</a></li>
                                    <li><a href="<?php echo e(route('admin/edit-event')); ?>" title="">Edit event</a></li>
                                </ul>
                            </div>
                        </div>-->
                        <!--<div class="single-menu">
                            <h2><a title=""><i class="fa fa-home"></i><span>User management</span></a><i class="blue">3</i></h2>
                            <div class="sub-menu">
                                <ul>
                                    <li><a href="<?php echo e(route('admin/user-management/create-user')); ?>" title="">Create user</a></li>
                                </ul>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div><!-- Menu Sec -->
        </aside><!-- Aside Sidebar -->
        <div class="content-sec">
            <div class="container">