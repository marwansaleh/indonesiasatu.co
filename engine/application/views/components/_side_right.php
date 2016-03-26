<div class="row">
    <?php foreach ($widgets as $widget): ?>
    <?php if (widget_exists($widget)): $this->load->view('frontend/widgets/' . $widget); endif; ?>
    <?php endforeach; ?>
</div>
<?php if (isset($category_olahraga)): ?>
<div class="row">
    <div class="article-box">
        <div class="box-title">
            <h2><?php echo $category_olahraga->name; ?></h2>
            <div class="title-line"></div>
        </div>
        <div class="articles-slider">
            <div class="flex-viewport">
                <?php foreach ($category_olahraga->articles as $article): ?>
                <article>
                    <figure style="overflow:hidden;"><img class="img-responsive small" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                    <div class="text">
                        <h3><a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                        <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (isset($iklan_kiri)): ?>
<div class="row">
    <?php if (is_array($iklan_kiri)): ?>
    <div class="flexslider" id="iklan-banyak-galuh">
        <ul class="slides">
            <?php foreach ($iklan_kiri as $ik): ?>
            <li><img src="<?php echo $ik; ?>"> </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php else: ?>
    <img src="<?php echo $iklan_kiri; ?>" class="img-responsive" style="margin-top: 5px;" />
    <?php endif; ?>
</div>
<?php endif; ?>
<?php if (isset($iklan_gabung)): ?>
<div class="row"><img src="<?php echo $iklan_gabung; ?>" class="img-responsive" style="margin-top: 5px;" /></div>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function (){
        $('#iklan-banyak-galuh').flexslider({
            animation: "slide",
            //slideshow: true,
            controlNav: false,
            animationLoop: true,
            itemWidth: 400,
            itemMargin: 0
        });
    });
</script>