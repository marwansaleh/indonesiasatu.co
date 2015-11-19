<div class="row">
    <div class="blog-page">
        <article>
            <h1 class="title"><?php echo $article->title; ?></h1>
            <?php if ($article->image_type==IMAGE_TYPE_MULTI): ?>
            <?php $this->load->view('frontend/slider/detail_slider', array('images'=>$article->images)); ?>
            <?php else: ?>
            <figure>
                <img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_LARGE); ?>" alt="Article image">
            </figure>
            <?php endif; ?>
            <div class="blog-content">
                <div class="info">
                    <a href="#"><?php echo number_format($article->comment); ?> comments</a>,
                    <span class="date"><?php echo date('d/m/Y',$article->date); ?></span>, by
                    <a href="#"><?php echo $article->created_by_name; ?></a>
                </div>
                <?php echo $article->content; ?>
                <p class="text-muted small"><em>---Ditulis oleh <?php echo $article->created_by_name; ?></em></p>
                <?php if ($article->tags): ?>
                <div class="tag-container">
                    <div class="tag-title">Tags: </div>
                    <?php $tags = explode(',', $article->tags);?>
                    <?php foreach ($tags as $tag): ?>
                    <a class="tag" href="<?php echo site_url('category/tags?q='. urlencode($tag)); ?>"><?php echo $tag; ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="blog-bottom">
                <div class="share-title">Share</div>
                <div class="share-content">
                    <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo urlencode('IndonesiaSatu.co: '.$article->title); ?>&amp;url=<?php echo urlencode($article->share_url); ?>" data-size="default">Tweet</a>
                    <div style="margin-top: -3px;" class="fb-share-button" data-href="<?php echo $article->share_url; ?>" data-layout="button_count"></div>
                </div>
            </div>
        </article>
    </div>
</div>

<!-- related news -->
<?php if ($related_news): ?>
<div class="row">
    <div class="related-news">
        <div class="inner-box">
            <h1 class="title">Related News</h1>
            <?php foreach ($related_news as $related): ?>
            <div class="column">
                <div class="inner">
                    <a href="<?php echo site_url('detail/'.$related->url_title); ?>">
                        <figure style="height: 105px; overflow: hidden;">
                            <img src="<?php echo get_image_thumb($related->image_url, IMAGE_THUMB_SMALL); ?>" alt="">
                        </figure>
                        <div class="title"><?php echo $related->title; ?></div>
                        <div class="date"><?php echo date('D d M Y', $related->date); ?></div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">
    window.twttr = (function (d, s, id) {
      var t, js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id; js.src= "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);
      return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
    }(document, "script", "twitter-wjs"));


    function share_fb(link){

        FB.ui({
          method: 'share',
          href: link
        }, function(response){});
    }
    function share_tw(obj){
        var url = document.getElementById(obj).href;
        var tw_window = window.open(url,"tw_sta","width=500,height=300,toolbar=no, scrollbars=yes, resizable=no")
        tw_window.focus();
    }
</script>
