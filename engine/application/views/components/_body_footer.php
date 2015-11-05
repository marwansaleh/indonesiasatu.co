<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Redaksi</h3>
                <table class="table table-condensed redaksi small">
                    <tr>
                        <td>Pendiri</td>
                        <td>Valens Daki-Soo</td>
                    </tr>
                    <tr>
                        <td>Pemimpin Redaksi</td>
                        <td>Simon Leya</td>
                    </tr>
                    <tr>
                        <td>Dewan Redaksi</td>
                        <td>Kiki Syahnakri, Valens Daki-Soo, Maximus Ali, Ricardus Mosa</td>
                    </tr>
                    <tr>
                        <td>Redaktur Pelaksana</td>
                        <td>Very Herdimanto</td>
                    </tr>
                    <tr>
                        <td>Redaktur</td>
                        <td>Ferdyn Hasiman, ANdy Javia, Gusti Tetiro</td>
                    </tr>
                    <tr>
                        <td>Staf Redaksi</td>
                        <td>Marteen Djawa, Emy Elu Wea, Yohanes D Scares, Paul Liwun</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <img src="<?php echo site_url('assets/img/logo.png'); ?>" class="img-responsive center-block" />
                
                <div class="col-sm-12 alamat">
                    <div class="text-center">
                        <h5><span class="text-bold">Alamat Redaksi</span></h5>
                        <p>Gedung ITC Roxy Mas Blok D3 No.33 <br>Jl. K.H. Hasyim Ashari No.125 Gambir<br>Jakarta Pusat<br>Kontak Iklan<br>redaksi@indonesiasatu.co</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h3>KANAL BERITA</h3>
                <div class="row">
                    <?php foreach($categories_articles as $cat_articles): ?>
                    <div class="col-sm-4">
                        <ul class="kanal-list">
                            <?php foreach ($cat_articles as $catbottom): ?>
                            <li><a href="<?php echo site_url('category/'.$catbottom->slug); ?>"><?php echo $catbottom->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</footer>