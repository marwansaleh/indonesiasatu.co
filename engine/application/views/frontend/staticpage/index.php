<div class="row">
    <div class="blog-page">
        <article>
            <h1 class="title"><?php echo $staticpage->title; ?></h1>
            <div class="blog-content">
                <?php echo $staticpage->content; ?>
            </div>
            
            <div class="blog-bottom">
                <div class="share-title">Share</div>
                <div class="share-content">
                    <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo urlencode('IndonesiaSatu.co: '.$staticpage->title); ?>&amp;url=<?php echo urlencode(current_url()); ?>" data-size="default">Tweet</a>
                    <div style="margin-top: -3px;" class="fb-share-button" data-href="<?php echo current_url(); ?>" data-layout="button_count"></div>
                </div>
            </div>
        </article>
    </div>
</div>

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
