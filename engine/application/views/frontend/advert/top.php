<?php if ($adverts && isset($adverts[ADV_TYPE_TOP])): ?>
<div class="row">
    <?php foreach ($adverts[ADV_TYPE_TOP] as $adv): ?>
    <div class="col-sm-12">
        <?php if ($adv->link_url && $adv->link_url != '#'): ?>
        <a href="<?php echo $adv->link_url; ?>" <?php echo $adv->new_window==1?'target="blank"':''; ?>>
            <img class="img-responsive" src="<?php echo $adv->file_name; ?>">
        </a>
        <?php else: ?>
        <img class="img-responsive" src="<?php echo $adv->file_name; ?>">
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; 