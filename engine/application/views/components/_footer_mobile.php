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
        <div class="row" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC;">
            <div class="col-xs-12 text-center">
                <div class="btn-group btn-group-justified" role="group">
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/redaksi'); ?>">Redaksi</a>
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/about'); ?>">Tentang Kami</a>
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/iklan'); ?>">Info Iklan</a>
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/privacypolicy'); ?>">Privacy Policy</a>
                </div>
            </div>
        </div>
        <div class="row" style="font-size: 9px; border-bottom: solid 1px #CCC;">
            <div class="col-xs-6 text-right">
                <span style="color: #CFA554; font-size: 7px;">Terbit sejak 1 Desember 2015. Visitor: <?php echo number_format($visitor_count); ?></span><br>
                <a href="http://indonesiasatu.co"><span>www.indonesiasatu.co</span></a>
            </div>
            <div class="col-xs-6 text-left" style="border-left: solid 1px #CCC;">
                <span style="color: #CFA554;">Diterbitkan oleh PT. Veritas Dharma Satya</span><br>
                <a href="http://www.veritasdharmasatya.com" target="_blank"><span>www.veritasdharmasatya.com</span></a>
            </div>
        </div>
        <p class="redaksi" style="font-size: 8px; padding-top: 3px; padding-bottom: 3px; background-color: #424242;">
            Penasihat: Letjen TNI (Purn) Kiki Syahnakri<br>
            Pemimpin Redaksi: Valens Daki-Soo<br>
            Redaktur Pelaksana: Simon Leya
        </p>
        <p class="redaksi" style="font-size: 8px;">
            Gedung ITC Roxy Mas Blok D3 No. 33
            Jl. Kh. Hasyim Ashari No. 125, Gambir, Jakarta Pusat,
            Telp/Fax:021-4756205, Email: <a href="mailto:redaksi@indonesiasatu.co">redaksi@indonesiasatu.co</a> 
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