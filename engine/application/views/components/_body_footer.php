<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo site_url('assets/img/logo-putih.png'); ?>" class="img-responsive center-block" />
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="redaksi-container">
                            <p class="redaksi">
                                Advisor: Letjen TNI (Purn) Kiki Syahnakri<br>
                                Pendiri/Pemimpin Umum: Valens Daki-Soo<br>
                                Pemimpin Redaksi: Simon Leya<br>
                                Penerbit: PT Veritas Dharma Satya 
                            </p>
                            <p class="alamat">
                                <span class="text-bold alamat-judul">Alamat Redaksi:</span><br>
                                Jl. Serut No.06 RT.06, RW.04, Kel.<br>
                                Kayu Putih, Kec. Pulogadung, Jaktim<br>
                                Telp/Fax:021 - 4756205<br>
                                Email: redaksi.indonesiasatu@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 kanal-berita">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>PROFIL</h3>
                                <ul class="kanal-list">
                                    <li><a href="<?php echo site_url('staticpage'); ?>">Tentang kami</a></li>
                                    <li><a href="<?php echo site_url('staticpage/index/redaksi'); ?>">Redaksi</a></li>
                                    <li><a href="<?php echo site_url('staticpage'); ?>">Info iklan</a></li>
                                    <li><a href="<?php echo site_url('contact'); ?>">Hubungi kami</a></li>
                                    <li><a href="<?php echo site_url('staticpage'); ?>">Karir</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <h3><a style="color: white;" href="<?php echo site_url('category/'.$inspirasi_category->slug); ?>">INSPIRASI</a></h3>
                                <?php if (count($inspirasi_category->children)):?>
                                <ul class="kanal-list">
                                    <?php foreach ($inspirasi_category->children as $ins_child): ?>
                                    <li><a href="<?php echo site_url('category/'.$ins_child->slug); ?>"><?php echo $ins_child->name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3>KANAL</h3>
                        <div class="row">
                            <?php foreach($categories_articles as $cat_articles): ?>
                            <div class="col-sm-3">
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
        </div>
    </div>
</footer>