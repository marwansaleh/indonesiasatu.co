    <footer>
        <div id="back-top" class="row">
            <div class="col-xs-12 text-center">
                <a href="#top">Kembali ke atas</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <ul id="main-bottom-menus">
                    <?php $i=0; foreach ($mobile_bottom_menus as $mainmenu): ?>
                    <li><a href="<?php echo site_url('category/'.$mainmenu->slug); ?>"><?php echo $mainmenu->name; ?></a></li>
                    <?php $i++; endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-offset-3 col-xs-6" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC;">
                <ul id="helper-bottom-menus">
                    <li>
                        <a href="<?php echo site_url('staticpage/index/redaksi'); ?>">Redaksi</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('staticpage/index/iklan'); ?>">Info Iklan</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('staticpage/index/privacypolicy'); ?>">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <p class="redaksi">
            Gedung ITC Roxy Mas Blok D3 No. 33
            Jl. Kh. Hasyim Ashari No. 125, Gambir, Jakarta Pusat,
            Telp/Fax:021-4756205, Email: <a href="mailto:redaksi@indonesiasatu.co">redaksi@indonesiasatu.co</a>, 
        </p>
        <p class="copyright">IndonesiaSatu.co<br>Copyright@2015</p>
    </footer>
    <script type="text/javascript">
            $(document).ready(function(){
                $('.media-list').on('click','.media',function(){
                    if ($(this).attr('data-href')){
                        window.location = $(this).attr('data-href');
                    }
                });
            });
        </script>
    
        <!-- bootstrap -->
        <script src="<?php echo site_url(config_item('path_lib').'bootstrap/js/bootstrap.min.js'); ?>"></script>
    </body>
</html>