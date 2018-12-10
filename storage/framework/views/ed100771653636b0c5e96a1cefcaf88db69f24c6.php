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
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/style.css')); ?>" type="text/css" /><!-- Style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/responsive.css')); ?>" type="text/css" /><!-- Responsive -->

</head>
<body>

<div class="main">
    <div class="page-container menu-left">
        <aside class="sidebar">
            <div class="profile-stats">
                <div class="mini-profile">
                    <span><img src="images/resource/me.jpg" alt="" /></span>
                    <h3>Labrina Scholer</h3>
                    <h6 class="status online"><i></i> Online</h6>
                    <a href="index.html" title="Logout" class="logout red" data-toggle="tooltip" data-placement=
                    "right"><i class="fa fa-power-off"></i></a>
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
                        <h2><a title=""><i class="fa fa-home"></i><span>Dashboards</span></a><i class="blue">3</i></h2>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="<?php echo e(route('admin/hall-management')); ?>" title="">Hall management</a></li>
                                <li><a href="<?php echo e(route('admin/user-management')); ?>" title="">User management</a></li>
                                <li><a href="<?php echo e(route('admin/event-management')); ?>" title="">Event management</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-menu">
                        <h2><a title=""><i class="fa fa-desktop"></i><span>Layouts</span></a></h2>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="blank.html" title="">Blank</a></li>
                                <li><a href="collapse-sidebar-left.html" title="">Collapse Sidebar Left</a></li>
                                <li><a href="collapse-sidebar-right.html" title="">Collapse Sidebar Right</a></li>
                                <li><a href="menu-horizontal.html" title="">Menu Horizontal</a></li>
                                <li><a href="panel-left-menu-right.html" title="">Panel Left Menu Right</a></li>
                                <li><a href="panel-right-menu-left.html" title="">Panel Right Menu Left</a></li>
                                <li><a href="sidebar-left.html" title="">Sidebar left</a></li>
                                <li><a href="sidebar-right.html" title="">Sidebar Right</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="single-menu">
                        <h2><a href="widgets.html" title=""><i class="fa fa-flask"></i><span>Widgets</span></a></h2>
                    </div>
                    <div class="single-menu">
                        <h2><a title=""><i class="fa fa-heart-o"></i><span>UI Elements</span></a></h2>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="inbox.html" title="">Mail Box</a></li>
                                <li><a href="profile.html" title="">Profile</a></li>
                                <li><a href="buttons.html" title="">Buttons</a></li>
                                <li><a href="timeline.html" title="">Timeline</a></li>
                                <li><a href="typography.html" title="">Typography</a></li>
                                <li><a href="calendars.html" title="">Calendars</a></li>
                                <li><a href="upload-crop.html" title="">Upload Crop</a></li>
                                <li><a href="tour.html" title="">Page Tour</a></li>
                                <li><a href="tree-list.html" title="">Tree List</a></li>
                                <li><a href="collapse.html" title="">Collapse</a></li>
                                <li><a href="editor.html" title="">Editor</a></li>
                                <li><a href="form.html" title="">Forms</a></li>
                                <li><a href="gallery-dynamic.html" title="">Gallery Dynamic</a></li>
                                <li><a href="gallery-static.html" title="">Gallery Static</a></li>
                                <li><a href="grids.html" title="">Grids</a></li>
                                <li><a href="icons.html" title="">Icons</a></li>
                                <li><a href="notifications.html" title="">Notification</a></li>
                                <li><a href="price-table.html" title="">Price Tables</a></li>
                                <li><a href="range-slider.html" title="">Range Slider</a></li>
                                <li><a href="slider.html" title="">Slider</a></li>
                                <li><a href="sortable.html" title="">Sortable</a></li>
                                <li><a href="tables.html" title="">Tables</a></li>
                                <li><a href="tasks.html" title="">Tasks</a></li>
                                <li><a href="tasks-widget.html" title="">Task Widgets</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-menu">
                        <h2><a href="form.html" title=""><i class="fa fa-paperclip"></i><span>Form Stuffs</span></a></h2>
                    </div>
                    <div class="single-menu">
                        <h2><a href="charts.html" title=""><i class="fa fa-bar-chart"></i><span>Charts</span></a></h2>
                    </div>
                    <div class="single-menu">
                        <h2><a title=""><i class="fa fa-paper-plane-o"></i><span>Pages</span></a></h2>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="404.html" title="">404 Error</a></li>
                                <li><a href="blank.html" title="">Blank</a></li>
                                <li><a href="contact.html" title="">Contact</a></li>
                                <li><a href="google-map.html" title="">Google Map</a></li>
                                <li><a href="vector-map.html" title="">Vector Map</a></li>
                                <li><a href="invoice.html" title="">Invoice</a></li>
                                <li><a href="pattern-login.html" title="">Pattern Login</a></li>
                                <li><a href="index.html" title="">Simple Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- Menu Sec -->
        </aside><!-- Aside Sidebar -->
        <div class="content-sec">
            <div class="container">
                <h1>Hall management</h1>
            </div>
        </div><!-- Slide Panel -->
    </div><!-- Page Container -->
</div><!-- main -->


<!-- Script -->
<script type="text/javascript" src="<?php echo e(asset('js/admin/modernizr.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/admin/jquery-1.11.1.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/admin/script.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/admin/bootstrap.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/admin/enscroll.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/admin/grid-filter.js')); ?>"></script>

</body>
</html>