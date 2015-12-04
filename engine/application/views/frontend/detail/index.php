<div class="row">
    <div class="blog-page">
        <article>
            <h1 class="title">
                <span style="font-size:13px;"><?php echo date('d-M-Y H:i', $article->date); ?></span><br>
                
                <?php echo $article->title; ?>
            </h1>
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
<!--                    <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo urlencode('IndonesiaSatu.co: '.$article->title); ?>&amp;url=<?php echo urlencode($article->share_url); ?>" data-size="default">Tweet</a>
                    <div style="margin-top: -3px;" class="fb-share-button" data-href="<?php echo $article->share_url; ?>" data-layout="button_count"></div>-->
                    <a class="btn btn-default" href="mailto:redaksi@indonesiasatu.co?Subject=<?php echo urlencode($article->title); ?>"><span class="glyphicon glyphicon-envelope"></span> Email</a>
                    <a class="btn btn-social btn-twitter" href="javascript:share_tw('<?php echo urlencode($article->share_url); ?>','<?php echo urlencode($article->title); ?>');"><span class="fa fa-twitter"></span> Twitter</a>
                    <a id="btn-google" class="btn btn-social btn-google-plus" 
                       href="https://plus.google.com/share?url=<?php echo urlencode(current_url()); ?>" 
                       onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;">
                        <span class="fa fa-google-plus"></span> Google
                    </a>
                    <a class="btn btn-social btn-facebook" href="javascript:share_fb('<?php echo urlencode(current_url()); ?>');"><span class="fa fa-facebook"></span> Facebook</a>
                    
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
<!--<script src="https://apis.google.com/js/platform.js" async defer></script>-->
<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo $FB_ID; ?>',
          xfbml      : true,
          version    : 'v2.5'
        });
    };
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    /* Twitter Sdk */
//    window.twttr = (function (d, s, id) {
//      var t, js, fjs = d.getElementsByTagName(s)[0];
//      if (d.getElementById(id)) return;
//      js = d.createElement(s); js.id = id; js.src= "https://platform.twitter.com/widgets.js";
//      fjs.parentNode.insertBefore(js, fjs);
//      return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
//    }(document, "script", "twitter-wjs"));


    function share_fb(link){
        
        FB.ui({
          method: 'share',
          href: link
        }, function(response){}); 
        
        return false;
    }
    function share_tw(encoded_url,text){
        var tw_window = window.open('https://twitter.com/intent/tweet?url='+encoded_url+'&text='+text,'Twitter-Web-Intent');
        tw_window.focus();
    }
</script>
