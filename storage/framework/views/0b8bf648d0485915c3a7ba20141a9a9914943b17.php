<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
<!--<link rel="stylesheet" type="text/css" href="<?php echo e(asset('stylesheet.css')); ?>">-->
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/print-tickets.css')); ?>" media="print">
    <script type="text/javascript" src="<?php echo e(asset('js/admin/jquery-1.11.1.js')); ?>"></script>
    <title>Ticket</title>
    <script src="http://connect.facebook.net/en_US/all.js" async=""></script>

    <meta property="og:site_name" content="Showapp">
    <meta property="og:url"           content="https://03a55e1f.ngrok.io/event/<?php echo e($event->id); ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo e($event->title); ?>" />
    <meta property="og:description"   content="<?php echo e($event->description); ?>" />
    <meta property="og:image"         content="<?php echo e(asset($event->image)); ?>" />
</head>
<body>


<?php if($message = Session::get('success')): ?>
    <div class="alert alert-success" role="alert">
    <span onclick="this.parentElement.style.display='none'"
          class="w3-button w3-green w3-large w3-display-topright">&times;</span>
        <p><?php echo $message; ?></p>
    </div>
    <?php Session::forget('success');?>

<?php endif; ?>
<?php if($message = Session::get('error')): ?>
    <div class="alert alert-danger" role="alert">
        <span onclick="this.parentElement.style.display='none'"
              class="w3-button w3-red w3-large w3-display-topright">&times;</span>
        <p><?php echo $message; ?></p>
    </div>
    <?php Session::forget('error');?>
<?php endif; ?>

<?php if(isset($success)): ?>
    <p><?php echo e($success); ?></p>
<?php endif; ?>
<a href="<?php echo e(route('/')); ?>">Go back to main page</a>
<?php $__currentLoopData = $responce; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="container ticket-body pdg-ticket" id="container-<?php echo e($ticket['place'].'-'.$ticket['row']); ?>">
        <div class="row logo-ticket">
            <div class="col-md-2">
                <img src="<?php echo e(asset('img/pics/logo-about-showapp.png')); ?>">
            </div>
            <div class="col-md-10">
                <h1><?php echo e($ticket['event_name']); ?></h1>
            </div>
        </div>
        <div class="row codes">
            <div class="col-md-2">
                <img src="<?php echo e(stristr($ticket['event_image'], 'img')); ?>" alt="">
            </div>
            <div class="col-md-8">
                <table class="table">
                    <thead class="bg-ticket">
                    <tr>
                        <th scope="col">Movie</th>
                        <th scope="col">Adress</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Price</th>
                        <th scope="col">Row</th>
                        <th scope="col">Place</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><?php echo e($ticket['event_name']); ?></th>
                        <td><?php echo e($ticket['address']); ?></td>
                        <td><?php echo e(date('M. d',strtotime($ticket['date']))); ?></td>
                        <td><?php echo e(date('h:i A',strtotime($ticket['time']))); ?></td>
                        <td><?php echo e($ticket['price']); ?></td>
                        <?php if(isset($ticket['row']) && !empty($ticket['row'])): ?>
                            <td><?php echo e($ticket['row']); ?></td>
                        <?php endif; ?>
                        <?php if(isset($ticket['place']) && !empty($ticket['place'])): ?>
                            <td><?php echo e($ticket['place']); ?></td>
                        <?php endif; ?>
                    </tr>
                    </tbody>
                </table>
                <div class="container-fluid ticket-info">
                    <div class="row">
                        <img src="data:image/png;base64,<?php echo e($ticket['barcode']); ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <img src="data:<?php echo e($ticket['qrCode']->getContentType()); ?>;base64,<?php echo e($ticket['qrCode']->generate()); ?>" />
            </div>
        </div>
        <div class="container footer-ticket">
            <i class="fa fa-scissors" aria-hidden="true"></i>
        </div>
    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!--<div id="shareBtn" onclick="ogShare()" class="btn btn-success clearfix">Share</div>

<div id="fb-root"></div>
<script>
    // Initialize the Facebook JS SDK.
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '441197036394779',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v3.1'
        });

        // Put additional init code here
    };

    // Load the Facebook JS SDK Asynchronously
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Custom function to call when user initiates a share
    function ogShare() {
        FB.ui({
            method: 'share_open_graph',
            action_type: 'og.likes',
            action_properties: JSON.stringify({
                object:'https://03a55e1f.ngrok.io/event/<?php echo e($event->id); ?>',
            })
        }, function(response){
            // Debug response (optional)
            console.log(response);
        });
    }
</script>

<script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>


<script type="text/javascript">
    document.write(VK.Share.button({url: "http://ievent.loc/event/<?php echo e($event->id); ?>", title: "<?php echo e($event->title); ?>", image:"<?php echo e(asset(stristr($event->eventImage, 'img'))); ?>"},{type: "round", text: "Share"}));
    </script>-->

<div class="container pdg-ticket form-ticket">
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <p>Send tickets to your email address</p>
        </div>
        <div class="col-md-2 col-xs-12">
            <input class="btn-ticket btn print-all-tickets" type="button" value="Print all tickets" onclick="window.print();return false;" />
        </div>
    </div>
    <form class="row send-mail" method="post" action="<?php echo e(action('MailController@sendTicket')); ?>">
        <div class="col-md-8 col-xs-12">
            <?php echo csrf_field(); ?>
            <?php if(!Auth::user()): ?>
                <input class="form-control" type="email" name="email" value="" placeholder="enter your email">
            <?php else: ?>
                <input class="form-control" type="email" name="email" value="<?php echo e(Auth::user()->email); ?>">
            <?php endif; ?>
            <input type="hidden" name="tickets" value="">
            <input type="hidden" name="eventName" value="<?php echo e($ticket['event_name']); ?>">
        </div>
        <div class="col-md-2 col-xs-12">
            <button class="btn-ticket btn">submit</button>
        </div>
    </form>
</div>




<!-- Your share button code -->

<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location.href ;
        $('input[name*=tickets]').val(url);
    });
</script>

<!-- Optional JavaScript-->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>" ></script>
</body>
</html>
