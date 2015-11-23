<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Tags_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Attributes_m extends MY_Model {
    protected $_table_name = 'article_exts';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'category_id,attr_name';
    
    public function save($data, $id = NULL) {
        if ($id && $this->get_count(array('id!='=>$id,'category_id'=>$data['category_id'], 'attr_name'=>$data['attr_name']))){
            $this->_last_message = 'Duplicate entry for '.$data['attr_name'].' in category_id:'.$data['category_id'];
            return FALSE;
        }else if (!$id && $this->get_count(array('category_id'=>$data['category_id'], 'attr_name'=>$data['attr_name']))){
            $this->_last_message = 'Duplicate entry for '.$data['attr_name'].' in category_id:'.$data['category_id'];
            return FALSE;
        }
        return parent::save($data, $id);
    }
}

/*
 * file location: /application/models/article/tags_m.php
 */
