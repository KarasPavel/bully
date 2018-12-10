<div class="subscribe">
    <div class="messadge"></div>
    <form method="post" action="<?php echo e(action('MailchimpController@subscribing')); ?>">
        <?php echo csrf_field(); ?>
        <label for="email">Subscribe to our newsletter.</label>
        <div class="form-bl">
            <input type="text" name="email" id="subscribe-email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="Enter your email">
            <?php if($errors->has('email')): ?>
                <p class="date-required"><?php echo e($errors->first('email')); ?></p>
            <?php endif; ?>
            <input class="btn" type="submit">
        </div>
    </form>
</div>
<div class="page-footer">
    <div class="footer-center">
        <div class="navigation inline">
            <a href="">About</a>
            <a href="">Events</a>
            <a href="">Partners</a>
            <a href="">News</a>
        </div>
        <div class="category inline">
            <a href="">Art</a>
            <a href="">Crafts</a>
            <a href="">Initiatives</a>
            <a href="">Shopping</a>
            <a href="">Garderning</a>
            <a href="">Home</a>
            <a href="">More</a>
        </div>
        <div class="feedback inline">
            <p class="head">Feedback</p>
            <p>Any questions, suggestions, comments, or want us to praise?</p>
            <div class="write-us btns">
                <i></i>
                <p>Write to Us</p>
            </div>
        </div>
        <div class="social inline">
            <p>Follow Us:</p>
            <div class="wrap-soc-link">
                <a href="https://www.facebook.com/">
                    <img src="<?php echo e(asset('img/pics/fb.svg')); ?>" alt="">
                </a>
                <a href="https://twitter.com/">
                    <img src="<?php echo e(asset('img/pics/twiter.svg')); ?>" alt="">
                </a>
                <a href="https://www.instagram.com/">
                    <img src="<?php echo e(asset('img/pics/inst.svg')); ?>" alt="">
                </a>
                <a href="https://vk.com/">
                    <img src="<?php echo e(asset('img/pics/vk.svg')); ?>" alt="">
                </a>
            </div>
            <a class="call" href="tel:+123 456 789">
                <img src="<?php echo e(asset('img/pics/call.svg')); ?>" alt="">
                <p>+123 456 789</p>
            </a>
        </div>
        <div class="page-up inline">
            <img src="<?php echo e(asset('img/pics/arrow-up.svg')); ?>" alt="">
            <p>UP</p>
            <a href="#first-screen"></a>
        </div>
        <div class="faq">
            <a href="">FAQ</a>
            <a href="">Terms&Conditions</a>
            <a href="">Return & Exchange Tickets</a>
        </div>
    </div>
</div>
<!-- Footer-->
<footer>
<div class="scripts">
    <!-- Set JS assets-->
    <script src="<?php echo e(asset('js/vendor-bundle.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/custom-bundle.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/datepicker.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/datepicker.en.js')); ?>" defer></script>

</div>
</footer>
</body>
</html>