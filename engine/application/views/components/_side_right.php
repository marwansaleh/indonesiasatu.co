<div class="row">
    <?php foreach ($widgets as $widget): ?>
    <?php if (widget_exists($widget)): $this->load->view('frontend/widgets/' . $widget); endif; ?>
    <?php endforeach; ?>
</div>
<?php if (isset($iklan_gabung)): ?>
<div class="row"><img src="<?php echo $iklan_gabung; ?>" class="img-responsive" style="margin-top: 5px;" /></div>
<?php endif; ?>