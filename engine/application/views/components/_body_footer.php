<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12"><h3>Semua Kategori</h3></div>
            <?php for($i=0;$i<4;$i++): ?>
            <div class="col-sm-3">
                <div class="list-group">
                    <?php if (!isset($categories_articles[$i])) break; ?>
                    <?php foreach ($categories_articles[$i] as $catbottom): ?>
                    <a class="list-group-item" href="<?php echo site_url('category/'.$catbottom->slug); ?>">
                        <span class="badge"><?php echo $catbottom->article_count; ?></span>
                        <?php echo $catbottom->name; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</footer>

<!--
<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 copyright">
                Copyright &copy; <a href="<?php echo site_url(); ?>">Nasabah.co</a> 2015 - 2016.
            </div>
            
            <div class="col-sm-3 social-links">
                <ul>
                    <li><a href="#" class="facebook">Facebook</a></li>
                    <li><a href="#" class="twitter">Twitter</a></li>
                    <li><a href="#" class="pinterest">Pinterest</a></li>
                    <li><a href="#" class="googleplus">Google+</a></li>
                </ul>
            </div>
        </div>
        <a href="#" class="back-to-top hidden-xs" style="display: inline;">Scroll Top</a>
    </div>
</div>-->