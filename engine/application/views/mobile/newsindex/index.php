<div class="main">
    <ul id="news-list" class="media-list">
        <?php foreach ($articles as $article): ?>
        <li class="media">
            <div class="media-left">
                <a href="'+data[i].link_href+'">
                    <img class="media-object" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SQUARE); ?>">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    <a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a>
                </h4>
                <p class="date"><?php echo date('d/m/Y',$article->date); ?></p>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
