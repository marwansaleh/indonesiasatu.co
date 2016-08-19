<?php if ($adverts && isset($adverts[ADV_TYPE_BOTTOM_LEFT])): ?>
<div class="row" style="margin-top:5px;">
    <?php foreach ($adverts[ADV_TYPE_BOTTOM_LEFT] as $adv): ?>
    <div class="col-sm-12">
        <?php if ($adv->link_url && $adv->link_url != '#'): ?>
        <a href="<?php echo site_url('click/run/'.$adv->id.'/'.  urlencode(base64_encode($adv->link_url))); ?>" <?php echo $adv->new_window==1?'target="blank"':''; ?>>
            <img class="img-responsive" src="<?php echo $adv->file_name; ?>">
        </a>
        <?php else: ?>
        <img class="img-responsive" src="<?php echo $adv->file_name; ?>">
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; 