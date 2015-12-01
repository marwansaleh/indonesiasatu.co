<div class="container">
    <div class="row">
        <div class="flexslider flexslider-bottom-advert">
            <ul class="slides">
                <li>
                    <img src="<?php echo userfiles_baseurl(config_item('advert').'ag01.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?php echo userfiles_baseurl(config_item('advert').'ag02.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?php echo userfiles_baseurl(config_item('advert').'ag03.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?php echo userfiles_baseurl(config_item('advert').'ag04.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?php echo userfiles_baseurl(config_item('advert').'ag05.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?php echo userfiles_baseurl(config_item('advert').'ag06.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?php echo userfiles_baseurl(config_item('advert').'ag07.jpg'); ?>" />
                </li>
                <!-- items mirrored twice, total of 12 -->
            </ul>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo site_url('assets/img/logo-putih.png'); ?>" class="img-responsive center-block" />
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="redaksi-container">
                            <p class="redaksi small">
                                Penasehat: Letjen TNI (Purn) Kiki Syahnakri<br>
                                Pendiri: Valens Daki-Soo<br>
                                Pemimpin Redaksi: Valens Daki-Soo<br>
                                Redaktur Pelaksana: Simon Leya<br>
                                Penerbit: Divisi Publishing PT VERITAS DHARMA SATYA<br>
                                SIUP: 01290/24.1.0/31.71-01.1002/1.824.271/2015
                            </p>
                            <p class="alamat">
                                <span class="text-bold alamat-judul">Alamat Redaksi:</span><br>
                                Gedung ITC Roxy Mas Blok D3 No. 33<br>
                                Jl. Kh. Hasyim Ashari No. 125, Gambir, Jakarta Pusat,<br>
                                Telp/Fax:021 - 4756205, Email: redaksi@indonesiasatu.co, iklan@indonesiasatu.co<br>
                                Copyright@2015IndonesiaSatu.co
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
                        <div class="row small">
                            <?php $i=1; foreach ($channels as $channel): ?>
                            <div class="col-sm-3" <?php if ($i%5==0) echo 'style="clear:both;"'; ?>>
                                <h6 style="font-size:12px; margin-top: 2px; margin-bottom: 0;">
                                    <a style="color: orange!important;" href="<?php echo site_url('category/'.$channel->slug); ?>"><?php echo $channel->name; ?></a>
                                </h6>
                                <ul class="kanal-list">
                                    <?php foreach ($channel->children as $channel_child): ?>
                                    <li><a href="<?php echo site_url('category/'.$channel_child->slug); ?>"><?php echo $channel_child->name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
<!--                        <div class="row">
                            <?php //foreach($categories_articles as $cat_articles): ?>
                            <div class="col-sm-3">
                                <ul class="kanal-list">
                                    <?php //foreach ($cat_articles as $catbottom): ?>
                                    <li><a href="<?php //echo site_url('category/'.$catbottom->slug); ?>"><?php //echo $catbottom->name; ?></a></li>
                                    <?php //endforeach; ?>
                                </ul>
                            </div>
                            <?php //endforeach; ?>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    $(document).ready(function (){
        $('.flexslider-bottom-advert').flexslider({
            animation: "slide",
            slideshow: true,
            controlNav: false,
            animationLoop: true,
            itemWidth: 300,
            itemMargin: 5
        });
    });
</script>