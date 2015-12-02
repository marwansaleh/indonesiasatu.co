<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nasabah-navbar">
                <span class="sr-only">Mainmenu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('home'); ?>" style="padding:0 0 0 25%;">
                <img src="<?php echo site_url('assets/img/logo-mobile.png'); ?>" class="img-responsive">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="nasabah-navbar">
            <ul class="nav navbar-nav">
                <li <?php echo $active_menu=='home'?'class="active"':''; ?>><a href="<?php echo site_url(); ?>">Home</a></li>
                <?php if (isset($mainmenus)): ?>
                <?php foreach ($mainmenus as $menu): ?>
                <?php if (count($menu->children)): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo ucwords($menu->name); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menu->children as $child): ?>
                        <li><a href="<?php echo $child->url; ?>"><?php echo ucfirst($child->name); ?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <?php else: ?> 
                <li <?php echo $active_menu==$menu->slug?'class="active"':''; ?>><a href="<?php echo site_url('category/'.$menu->slug); ?>"><?php echo $menu->name; ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>