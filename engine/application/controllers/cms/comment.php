<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Comment
 *
 * @author marwansaleh
 */
class Comment extends MY_AdminController {
    
    function __construct() {
        parent::__construct();
        $this->data['active_menu'] = 'comment';
        $this->data['page_title'] = '<i class="fa fa-comments"></i> Comments';
        $this->data['page_description'] = 'List and update comments';
        
        //load models
        $this->load->model(array('article/article_m'));
    }
    
    function index(){
        
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Comments', site_url('cms/comment'), TRUE);
        
        $this->data['subview'] = 'cms/comment/index';
        $this->load->view('_layout_admin', $this->data);
    }
}

/*
 * file location: engine/application/controllers/cms/comment.php
 */
