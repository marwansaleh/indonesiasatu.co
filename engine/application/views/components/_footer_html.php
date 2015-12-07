        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                  appId      : '<?php echo $FB_ID; ?>',
                  cookie     : true,
                  xfbml      : true,
                  version    : 'v2.5'
                });
            };
            
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
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