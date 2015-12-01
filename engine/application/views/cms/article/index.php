<div class="row">
    <div class="col-sm-12">
        <?php if ($this->session->flashdata('message')): ?>
        <?php echo create_alert_box($this->session->flashdata('message'),$this->session->flashdata('message_type')); ?>
        <?php endif; ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Articles</h3>
                <div class="box-tools">
                    <div class="input-group">
                        <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 250px;" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            <a class="btn btn-sm btn-primary" data-toggle="tooltip" title="Create" href="<?php echo site_url('cms/article/edit'); ?>"><i class="fa fa-plus-square"></i></a>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->
            
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th class="text-center" style="width: 60px;">Types</th>
                            <th class="text-center">Date</th>
                            <th style="width: 40px;">View</th>
                            <th style="width: 40px;">Published</th>
                            <th style="width: 90px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($items as $item): ?>
                        <tr>
                            <td><?php echo ($offset+$i++); ?>.</td>
                            <td><?php echo $item->title; ?></td>
                            <td><?php echo $item->category; ?></td>
                            <td class="text-center">
                                <?php if ($item->highlight): ?>
                                <i class="fa fa-check-circle text-primary" data-toggle="tooltip" title="Highlight"></i>
                                <?php else: ?>
                                <i class="fa fa-check-circle-o text-gray" data-toggle="tooltip" title="Highlight"></i>
                                <?php endif; ?>
                                <?php if ($item->slider): ?>
                                <i class="fa fa-check-circle text-primary" data-toggle="tooltip" title="Slider news"></i>
                                <?php else: ?>
                                <i class="fa fa-check-circle-o text-gray" data-toggle="tooltip" title="Slider news"></i>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo date('d-m-Y H:i', $item->date); ?></td>
                            <td class="text-right"><?php echo number_format($item->view_count); ?></td>
                            <td class="text-center">
                                <?php if ($item->published==1): ?>
                                <i class="fa fa-check-circle text-primary"></i>
                                <?php else:?>
                                <i class="fa fa-check-circle-o text-gray"></i>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit" href="<?php echo site_url('cms/article/edit?id='.$item->id.'&page='.$page); ?>"><i class="fa fa-pencil-square"></i></a>
                                <a class="btn btn-xs btn-danger confirmation" data-toggle="tooltip" title="Delete" data-confirmation="Are your sure to delete this record ?" href="<?php echo site_url('cms/article/delete?id='.$item->id.'&page='.$page); ?>"><i class="fa fa-minus-square"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <!-- paging description -->
                <?php echo isset($pagination_description)? $pagination_description:''; ?>
                <!-- paging list bullets -->
                <?php echo isset($pagination)? $pagination:''; ?>
            </div>
        </div>
    </div>
</div>