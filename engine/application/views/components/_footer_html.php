        <script type="text/javascript">
            var ImageDefaultManager = {
                _baseUrl: 'http://placehold.it/',
                availableName: ["tiny","smaller","square","small","medium","portrait","large"],
                availableWidth: [42,57,70,230,362,555,726],
                availableHeight: [42,57,70,147,205,350,463],
                getDefaultImage: function (size){
                    //get default width and height if available
                    var index = this.availableName.indexOf(size);
                    if ( index>=0 && index<this.availableName.length ){
                        var sizeText = this.availableWidth[index]+'x'+this.availableHeight[index];
                        
                        return this._baseUrl+sizeText;
                    }
                },
                init: function() {
                    var _this = this;
                    $('img').on('error',function(){
                        //check if image tag has class
                        if ($(this).className){
                            for (var i in _this.availableName){
                                if ($(this).hasClass(_this.availableName[i])){
                                    $(this).attr('src', _this.getDefaultImage(_this.availableName[i]));
                                    return;
                                }
                            }
                        }
                    });
                },
            };
            $(document).ready(function(){
                //nice scroll
                $('html').niceScroll({cursorcolor:"#00F"});
                $('.nicescroll').niceScroll({cursorcolor:"#00F"});
                
                ImageDefaultManager.init();
            });
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
    </body>
</html>