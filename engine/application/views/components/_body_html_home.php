<?php $this->load->view('components/_body_header'); ?>
<?php if (isset($main_slider)&& $main_slider) { $this->load->view('frontend/slider/main_slider'); }?>
<div id="main">
    <div class="container">
        <div class="col-sm-8">
            <!-- highlight news -->
            <div class="row">
                <div class="article-showcase hidden-xs">
                    <div class="inner-border">
                        <div class="half">
                            <?php $rel=1; foreach ($highlight_news as $highlight): ?>
                            <div class="big-article <?php echo $rel==1?'active':''; ?>" rel="<?php echo $rel++; ?>">
                                <div class="title">
                                    <span><a href="<?php echo site_url('detail/'.$highlight->url_title); ?>"><?php echo $highlight->title ?></a></span>
                                </div>
                                <figure>
                                    <img src="<?php echo get_image_thumb($highlight->image_url, IMAGE_THUMB_MEDIUM); ?>" alt="">
                                </figure>
                                <div class="main-text">
                                    <div class="inner">
                                        <span class="article-info"><?php echo number_format($highlight->comment); ?> comments, <?php echo date('d/m/Y',$highlight->date); ?>, by <?php echo $highlight->created_by_name; ?></span>
                                        <p><?php echo $highlight->synopsis; ?><a href="<?php echo site_url('detail/'.$highlight->url_title); ?>">Read more...</a></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="half">
                            <div class="inner-left-border">
                                <?php $rel=1; foreach ($highlight_news as $highlight): ?>
                                <article <?php echo $rel==1?'class="first-child active':''; ?>" rel="<?php echo $rel++; ?>">
                                    <figure>
                                        <img src="<?php echo get_image_thumb($highlight->image_url, IMAGE_THUMB_SQUARE); ?>" alt="">
                                    </figure>
                                    <div class="text">
                                        <h3><?php echo $highlight->title ?></h3>
                                        <span class="info"><?php echo date('d/m/Y',$highlight->date); ?>, <?php echo number_format($highlight->comment); ?> comments</span>
                                    </div>
                                </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end highlight news -->
        </div>
        <aside class="col-sm-4">
            <div class="row">
                <div class="widget">
                    <div class="box-title">
                        <h2 style="margin-top: 0; padding-top: 0;">Inspirasi</h2>
                        <div class="title-line"></div>
                    </div>
                    <div class="articles-slider">
                        <div class="flex-viewport article-inspiration">
                            <img src="<?php echo get_image_thumb($inspirasi->image_url, IMAGE_THUMB_MEDIUM); ?>" class="img-responsive">
                            <div class="article-inspiration-info">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </aside>
        

        <!-- insert advert -->
        <div class="row">
            <div class="col-sm-12">
                <a href="<?php echo site_url(); ?>">
                    <img src="<?php echo site_url('adverts/Iklan_arta_graha_231115.jpg'); ?>" class="img-responsive" />
                </a>
            </div>
        </div>
        <!-- end advert -->
    </div>
    <div class="container">
        <div class="content col-sm-8">
            <?php $this->load->view($subview);?>
        </div>
        <aside class="col-sm-4">
            <?php $this->load->view('components/_side_right'); ?>
        </aside>
    </div>
    
</div>
<div id="advert-bottom-bar">
    <div class="container">
        <div class="row">
            <img src="<?php echo site_url('adverts/iklan_mercure_galuh_mas_231115.jpg'); ?>" class="img-responsive" />
        </div>
    </div>
</div>

<?php $this->load->view('components/_body_footer');