<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo site_url('assets/img/logo-putih.png'); ?>" class="img-responsive center-block" />
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="redaksi-container">
                            <p class="redaksi small">
                                Pendiri/Pemimpin Umum: Letjen TNI (Purn) Kiki Syahnakri, Valens Daki-Soo<br>
                                Pemimpin Redaksi: Valens Daki-Soo<br>
                                Redaksi Pelaksana: Simon Leya<br>
                                Penerbit: PT VERITAS DHARMA SATYA 
                            </p>
                            <p class="alamat">
                                <span class="text-bold alamat-judul">Alamat Redaksi:</span><br>
                                Gedung ITC Roxy Mas Blok D3<br>
                                No.33 Jl. KH. Hasyim Ashari <br>
                                No.125, Gambir, Jakarta Pusat<br>
                                Email: redaksi.indonesiasatu@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 kanal-berita">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>PROFIL</h3>
                                <ul class="kanal-list">
                                    <li><a href="<?php echo site_url('staticpage/index/about'); ?>">Tentang kami</a></li>
                                    <li><a href="<?php echo site_url('staticpage/index/redaksi'); ?>">Redaksi</a></li>
                                    <li><a href="<?php echo site_url('staticpage/iklan'); ?>">Info iklan</a></li>
                                    <li><a href="<?php echo site_url('contact'); ?>">Hubungi kami</a></li>
                                    <li><a href="<?php echo site_url('staticpage/karir'); ?>">Karir</a></li>
                                </ul>
                            </div>
<!--                            <div class="col-sm-6">
                                <h3><a style="color: white;" href="<?php //echo site_url('category/'.$inspirasi_category->slug); ?>">INSPIRASI</a></h3>
                                <?php //if (count($inspirasi_category->children)):?>
                                <ul class="kanal-list">
                                    <?php // ($inspirasi_category->children as $ins_child): ?>
                                    <li><a href="<?php //echo site_url('category/'.$ins_child->slug); ?>"><?php //echo $ins_child->name; ?></a></li>
                                    <?php //endforeach; ?>
                                </ul>
                                <?php //endif; ?>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <h3>KANAL</h3>
                        <div class="row">
                            <?php foreach ($channels as $channel): ?>
                            <div class="col-sm-3">
                                <h5><a href="<?php echo site_url('category/'.$channel->slug); ?>"><?php echo $channel->name; ?></a></h5>
                                <ul class="kanal-list">
                                    <?php foreach ($channel->children as $channel_child): ?>
                                    <li><?php echo site_url('category/'.$channel_child->slug); ?>"><?php echo $channel_child->name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endforeach; ?>
                        </div>
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