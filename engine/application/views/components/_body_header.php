<header>
    
    <div class="container">
        <div class="row top-header">
            <div class="col-sm-3 hidden-xs">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="<?php echo site_url('assets/img/cuaca/hujan-ringan.gif'); ?>" />
                    </div>
                </div>
                <p class="header-date"><span class="red-text"><?php echo $today['hari'] ?></span>, <?php echo $today['tanggal'] . ' '. $today['bulan'] .' '. $today['tahun']; ?></p>
            </div>
            <div class="col-sm-6">
                <img src="<?php echo site_url('assets/img/logo.png'); ?>" class="img-responsive center-block" />
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-12 top-menu hidden-xs">
                        <div class="pull-right">
                            <ul>
                                <li>
                                    <?php if ($is_logged_in): ?>
                                    <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
                                    <?php else: ?>
                                    <a href="<?php echo site_url('auth'); ?>">Login</a>
                                    <?php endif; ?>
                                </li>
                                <li><a href="#">Register</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <form method="post" action="<?php echo site_url('search'); ?>">
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="text" name="search" placeholder="Search...">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default" style="background: transparent;"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12 breaking-news">
                    <div class="row">
                        <div class="col-sm-2 title">
                           <span>Breaking News</span>
                        </div>
                        <div class="col-sm-10 header-news">
                            <?php if (isset($newstickers)): ?>
                            <div class="ticker">
                                <ul>
                                    <?php foreach ($newstickers as $ticker): ?>
                                    <li><?php echo $ticker->news_text; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row main-nav">
            <div class="col-sm-12"><?php $this->load->view('components/_mainmenu'); ?></div>
        </div>
    </div>
</header>