<div class="row">
    <div class="col-sm-12">
        <?php if ($this->session->flashdata('message')): ?>
        <?php echo create_alert_box($this->session->flashdata('message'),$this->session->flashdata('message_type')); ?>
        <?php endif; ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Comments</h3>
                <div class="box-tools">
                    <div class="input-group">
                        <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 250px;" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            <a class="btn btn-sm btn-primary" data-toggle="tooltip" title="Create" href="<?php echo site_url('cms/comment/edit'); ?>"><i class="fa fa-plus-square"></i></a>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->
            
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered" id="data-list">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Comment</th>
                            <th>Sender</th>
                            <th>Date</th>
                            <th>Article</th>
                            <th>Approval</th>
                            <th style="width: 120px">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <div id="pagination"></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="selected-article" value="<?php echo isset($selected_article) ? $selected_article : 0; ?>" />

<script type="text/javascript">
    $(document).ready(function(){
        CommentManager.init();
        
        $('#data-list').on('click', '.btn-set-approval', function(){
            var id = $(this).attr('data-id');
            var approval = $(this).attr('data-approval');
            CommentManager.setApproval(id, (approval ? 0 : 1));
        });
    });
    var CommentManager = {
        page: 1,
        dataLimit: 20,
        reachLimit: false,
        articleId: 0,
        init: function(){
            this.loadComments();
        },
        setDataLimit: function (limit){
            this.dataLimit = parseInt(limit);
        },
        setArticle: function (id){
            this.articleId = parseInt(id);
        },
        prev: function(){
            if (this.page > 1){
                this.page = this.page - 1;
            }
        },
        next: function(){
            if (!this.dataLimit){
                this.page = this.page + 1;
            }
        },
        loadComments: function(){
            var _this= this;
            
            $('#data-list tbody').empty();
            $.getJSON('<?php echo site_url('service/comment/index'); ?>',{limit:_this.dataLimit,page:_this.page,article:_this.articleId},function(result){
                if (result.length > 0){
                    for (var i in result){
                        var s = '<tr id="'+result[i].id+'">';
                        s+= '<td>'+_this._getRecNumber(i)+'.</td>';
                        s+= '<td>'+result[i].comment+'</td>';
                        s+= '<td>'+result[i].name+'</td>';
                        s+= '<td>'+result[i].date+'</td>';
                        s+= '<td>'+result[i].title+'</td>';
                        s+= '<td class="text-center"><a data-id="'+result[i].id+'" data-approval="'+result[i].approved+'" class="btn btn-set-approval"><i class="fa '+(result[i].approved ? 'fa-check-circle text-primary':'fa-check-circle-o text-gray')+'" data-toggle="tooltip" title="" data-original-title="Approval status"></i></a></td>';
                        s+= '<td class="text-center"><a class="btn btn-xs btn-danger confirmation" data-toggle="tooltip" title="Delete" data-confirmation="Are your sure to delete this record ?" href="javascript:deleteComment('+result[i].id+')"><i class="fa fa-minus-square"></i></a></td>';
                        s+= '</tr>';

                        $('#data-list tbody').append(s);
                    }
                    if (result.length < _this.dataLimit){
                        _this.reachLimit = true;
                    }else{
                        _this.reachLimit = false;
                    }
                    
                }else{
                    _this.reachLimit = true;
                }
                
                _this._drawingPaging();
            });
        },
        deleteComment: function (id){
            var _this = this;
            $.ajax({
                url: '<?php echo site_url('service/comment/index'); ?>/'+id,
                type: 'DELETE',
                success: function (result){
                    if (result.status){
                        _this.loadComments();
                    }else{
                        alert(result.message);
                    }
                },
                contentType: 'json'
            });
        },
        setApproval: function (id, approval){
            var _this = this;
            
            $.ajax({
                url: '<?php echo site_url('service/comment/approve'); ?>/'+id,
                type: 'PUT',
                contentType: 'json',
                data: {"approval": approval},
                success: function (result){
                    var $btn = $('tr#'+id).find('a');
                    $btn.attr('data-approval', result.item.approved);
                    
                    var $icon = $('tr#'+id).find('i');
                    if (result.item.approved){
                        $icon.removeClass('fa-check-circle-o');
                        $icon.removeClass('text-gray');
                        $icon.addClass('fa-check-circle');
                        $icon.addClass('text-primary');
                    }else{
                        $icon.removeClass('fa-check-circle');
                        $icon.removeClass('text-primary');
                        $icon.addClass('fa-check-circle-o');
                        $icon.addClass('text-gray');
                    }
                }
            });
        },
        _getRecNumber: function(offset){
            var recNumber = ((this.page-1)*this.dataLimit) + parseInt(offset) + 1;
            
            return recNumber;
        },
        _drawingPaging: function (){
            var s = '<nav><ul class="pager">';
            if (this.page > 1){
                s+= '<li><a href="javascript:previousPage();">Previous</a></li>';
            }else{
                s+= '<li class="disabled"><a href="#">Previous</a></li>';
            }
            if (!this.reachLimit){
                s+= '<li><a href="javascript:nextPage();">Next</a></li>';
            }else{
                s+= '<li class="disabled"><a href="#">Next</a></li>';
            }
            s+= '</ul></nav>';
            
            $('#pagination').html(s);
        }
    };
    
    function previousPage(){
        CommentManager.prev();
        CommentManager.loadComments();
    }
    
    function nextPage(){
        CommentManager.next();
        CommentManager.loadComments();
    }
    
    function deleteComment(id){
        if (confirm('Delete this line of record ?')){
            CommentManager.deleteComment(id);
        }
    }
</script>