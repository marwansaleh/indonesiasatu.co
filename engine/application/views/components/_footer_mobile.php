    <footer>
        <div id="back-top" class="row">
            <div class="col-xs-12 text-center">
                <a href="#top">Kembali ke atas</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <ul id="main-bottom-menus">
                    <?php $i=0; foreach ($mainmenus as $mainmenu): ?>
                    <li><a href="<?php echo site_url('category/'.$mainmenu->slug); ?>"><?php echo $mainmenu->name; ?></a></li>
                    <?php $i++; endforeach; ?>
                </ul>
            </div>
        </div>
        <p class="redaksi">
            Gedung ITC Roxy Mas Blok D3 No. 33
            Jl. Kh. Hasyim Ashari No. 125, Gambir, Jakarta Pusat,
            Telp/Fax:021-4756205, Email: <a href="mailto:redaksi@indonesiasatu.co">redaksi@indonesiasatu.co</a>, 
        </p>
        <p class="copyright">Copyright@2015<br>IndonesiaSatu.co</p>
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