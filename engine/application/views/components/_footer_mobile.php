    <footer>
        <p class="redaksi">
            Penasihat: Letjen TNI (Purn) Kiki Syahnakri<br>
            <!-- Pendiri: Valens Daki-Soo<br>-->
            Pemimpin Redaksi: Valens Daki-Soo<br>
            Redaktur Pelaksana: Simon Leya<br>
            Penerbit: Divisi Publishing PT VERITAS DHARMA SATYA<br>
            Website: <a href="http://www.veritasdharmasatya.com" target="_blank" style="color: blue;">www.veritasdharmasatya.com</a>
            <hr>
            Gedung ITC Roxy Mas Blok D3 No. 33
            Jl. Kh. Hasyim Ashari No. 125, Gambir, Jakarta Pusat,
            Telp/Fax:021-4756205, Email: <a href="mailto:redaksi@indonesiasatu.co">redaksi@indonesiasatu.co</a>, 
        </p>
        <p class="copyright">Copyright@2015IndonesiaSatu.co</p>
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