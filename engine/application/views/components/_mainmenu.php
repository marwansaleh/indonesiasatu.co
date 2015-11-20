    <nav class="navbar navbar-default">
    <ul class="nav nav-justified">
        <li <?php echo $active_menu=='home'?'class="active"':''; ?>><a href="<?php echo site_url(); ?>">
                <img src="<?php echo site_url('assets/img/one.png'); ?>" > Home
            </a></li>
        <?php if (isset($mainmenus)): ?>
        <?php foreach ($mainmenus as $menu): ?>
        <li <?php echo $active_menu==$menu->slug?'class="active"':''; ?>><a href="<?php echo site_url('category/'.$menu->slug); ?>"><?php echo $menu->name; ?></a></li>
        <?php endforeach; ?>
        <?php endif; ?>
        <li <?php echo $active_menu=='newsindex'?'class="active"':''; ?>><a href="<?php echo site_url('newsindex'); ?>">Indeks</a></li>
    </ul>
</nav>
