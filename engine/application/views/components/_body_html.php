<?php $this->load->view('components/_body_header'); ?>
<?php if (isset($main_slider)&& $main_slider) { $this->load->view('frontend/slider/main_slider'); }?>
<div id="main">
    <div class="container">
        <div class="content col-sm-8">
            <?php $this->load->view($subview);?>
        </div>
        <aside class="col-sm-4">
            <?php $this->load->view('components/_side_right'); ?>
        </aside>
    </div>
</div>
<div id="advert-bottom-bar">
    <div class="container">
        <div class="row">
            <img src="<?php echo site_url('adverts/iklan_mercure_galuh_mas_231115.jpg'); ?>" class="img-responsive" />
        </div>
    </div>
</div>

<?php $this->load->view('components/_body_footer');