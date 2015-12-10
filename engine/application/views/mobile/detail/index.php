<div class="blog-page">
    <article>
        <span style="color: #CCC; font-size: 12px;"><?php echo strtoupper($article->category_name); ?></span>
        <h3 class="title" style="margin-top:0;"><?php echo $article->title; ?></h3>
        <div class="info">
            <span class="date"><?php echo date('d/m/Y H:i',$article->date); ?></span>, by
            <span class="author"><?php echo $article->created_by_name; ?></span>
        </div>

        <figure>
            <img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_LARGE); ?>" alt="Article image">
        </figure>
        <div class="content">
            <?php echo $article->content; ?>
        </div>
    </article>
</div>
<!-- related news -->
<?php if ($related_news): ?>
<div class="blog-page"><h4 style="border-bottom: solid 1px #CACACA; margin-bottom:0;">Berita Terkait</h4></div>

<ul class="media-list">
    <?php foreach($related_news as $news): ?>
    <li class="media" data-href="<?php echo site_url('detail/'.$news->url_title); ?>">
        <div class="media-left">
            <a href="<?php echo site_url('detail/'.$news->url_title); ?>">
                <img class="media-object" src="<?php echo get_image_thumb($news->image_url, IMAGE_THUMB_SQUARE); ?>" alt="<?php echo $news->url_title ?>">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><a href="<?php echo site_url('detail/'.$news->url_title); ?>"><?php echo $news->title; ?></a></h4>
            <p class="date"><?php echo date('d-M-Y H:i', $news->date); ?></p>
        </div>
    </li>
    <?php endforeach;?>
</ul>
<?php endif; ?>
<div class="blog-page"><a class="btn btn-primary btn-block btn-sm" href="<?php echo site_url('home'); ?>">Back</a></div>