<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Comment
 *
 * @author marwansaleh
 */
class Comment extends REST_Api {
    function __construct($config='rest') {
        parent::__construct($config);
    }
    
    function index_get($id=NULL){
        //load models
        $this->load->model(array('article/article_m','article/comment_m','users/user_m'));
        $this->load->helper('general');
        $remap_fields = array(
            'id'                => 'id',
            'sender'            => 'user_id',
            'ip_address'        => 'ip_address',
            'date'              => 'date',
            'article_id'        => 'article_id',
            'article_title'     => 'article_title',
            'comment'           => 'comment',
            'is_approved'       => 'approved'
        );
        
        if ($id){
            $item = $this->comment_m->get($id);
            $this->result = $this->remap_fields($remap_fields, $this->_proccess_item($item));
        }else{
            $limit = $this->get('limit') ? $this->get('limit') : 100;
            $page = $this->get('page') ? $this->get('page') : 1;
            $article_id = $this->get('article') ? $this->get('article') : 0;
            
            $condition = array ('is_approved' => 1);
            if ($article_id){
                $condition['article_id'] = $article_id;
            }
            
            $items = $this->comment_m->get_offset('*',$condition,($page-1)*$limit,$limit);
            foreach ($items as $item){
                $this->result [] = $this->remap_fields($remap_fields, $this->_proccess_item($item));
            }
        }
        
        $this->response($this->result);
    }
    
    private function _proccess_item($item){
        $item->date = date('d-M-Y H:i:s', $item->date);
        $item->article_title = $this->article_m->get_value('title',array('id'=>$item->article_id));
        $item->is_approved = (bool) $item->is_approved;
        return $item;
    }
    
}

/*
 * file location: engine/application/controllers/service/comment.php
 */
