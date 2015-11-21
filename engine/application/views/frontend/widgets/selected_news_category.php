<div class="widget">
    <div class="inner">
        <h3><?php echo $selected_news_category['category']->name; ?></h3>
        <div class="articles-slider">
            <div class="flex-viewport">
                <?php $i=1; foreach ($selected_news_category['articles'] as $article): ?>
                
                <?php if ($i==1): ?>
                <div class="main-article">
                    <div class="title">
                        <span><a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></span>
                    </div>
                    <figure>
                        <img src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_MEDIUM); ?>" alt="">
                    </figure>
                    <div class="main-text">
                        <div class="inner">
                            <span class="article-info"><?php echo number_format($article->comment); ?> comments, <?php echo date('d/m/Y',$article->date); ?>, by <?php echo $article->created_by_name; ?></span>
                            <p><?php echo $article->synopsis; ?> <a href="<?php echo site_url('detail/'.$article->url_title); ?>">Read more...</a></p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <article>
                    <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                    <div class="text">
                        <h3><a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                        <span class="info"><?php echo date('d/m/Y',$article->date); ?>, <?php echo number_format($article->comment); ?> comments</span>
                    </div>
                </article>
                <?php endif; ?>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </div>
</div>