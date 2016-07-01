<div class="row">
    <div class="col-sm-12">
        <?php if ($this->session->flashdata('message')): ?>
        <?php echo create_alert_box($this->session->flashdata('message'),$this->session->flashdata('message_type')); ?>
        <?php endif; ?>
        
        <form id="MyForm" role="form" method="post" action="<?php echo $submit_url; ?>" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?php echo $item->id; ?>">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $item->id?'Update Data':'Create New'; ?></h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="form-group">
                        <label>Advert name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Advert name" value="<?php echo $item->name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Advert type</label>
                        <select name="type" class="form-control selectpicker" data-live-search="true" data-size="5">
                            <?php foreach ($advert_types as $type): ?>
                            <option value="<?php echo $type->id; ?>" <?php echo $type->id==$item->type?'selected':''; ?>><?php echo $type->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Upload file</label>
                        <input type="file" id="file-upload" name="userfile" class="form-control">
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <button id="btn-submit" class="btn btn-primary" type="submit" data-loading-text="Wait..."><i class="fa fa-save"></i> Submit</button>
                    <a class="btn btn-default" href="<?php echo $back_url; ?>"><i class="fa fa-backward"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url(config_item('path_lib').'ajax-form/jquery.form.min.js'); ?>"
<script type="text/javascript">
    var Advert = {
        _Id: 0,
        init: function(){
            var _this = this;
            _this._Id = parseInt($('#id').val());
            
            $('.btn-calender').on('click', function(){
                $(this).parents('.input-group').find('input.datepicker').focus();
            });
        
            $('#MyForm').submit(function() { 
                var $btn = $('#btn-submit');
                $btn.button('loading');

                var submitType = _this._Id ? 'PUT' : 'POST';
                $('#MyForm').ajaxSubmit({
                    type: submitType,
                    url: '<?php echo get_action_url('ajax/advert/index'); ?>/'+_this._Id,
                    dataType: 'json',
                    success: function(data){
                        $btn.button('reset');
                        if (data.status){
                            $('#id').val(data.item.id);
                            _this._Id = parseInt(data.item.id);

                            alert('Iklan berhasil disimpan');
                        }else{
                            alert(data.message);
                        }
                    }
                });
            });
        }
    };
    $(document).ready( function () {
        Advert.init();
    });
</script>