        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                  appId      : '<?php echo $FB_ID; ?>',
                  xfbml      : true,
                  version    : 'v2.5'
                });
            };
        </script>
        <!-- bootstrap -->
        <script src="<?php echo site_url(config_item('path_lib').'bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- nice scroll -->
        <script src="<?php echo site_url(config_item('path_lib').'scrollTo/jquery.scrollTo.min.js'); ?>"></script>
        <script src="<?php echo site_url(config_item('path_lib').'nicescroll/jquery.nicescroll.min.js'); ?>" type="text/javascript"></script>
        <!-- prettyPhoto -->
        <script src="<?php echo site_url(config_item('path_lib').'prettyPhoto/3.15/js/jquery.prettyPhoto.js'); ?>"></script>
        <!-- tinyNav -->
        <script src="<?php echo site_url(config_item('path_lib').'tinynav/tinynav.min.js'); ?>"></script>
        <!-- placeHolder -->
        <script src="<?php echo site_url(config_item('path_lib').'jquery-placeholder/jquery.placeholder.min.js'); ?>"></script>
        <!-- Jquery ticker -->
        <script src="<?php echo site_url(config_item('path_lib').'jquery-ticker/jquery.ticker.js'); ?>"></script>
        <!-- Flexslider -->
        <script src="<?php echo site_url(config_item('path_lib').'flexslider/2.4/jquery.flexslider-min.js'); ?>"></script>
        <!-- custom social media js -->
        <script src="<?php echo site_url(config_item('path_assets').'js/socmed.js'); ?>"></script>
    </body>
</html>