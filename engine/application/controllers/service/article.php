<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Weather
 *
 * @author marwansaleh
 */
class Article extends REST_Api {
    function __construct($config='rest') {
        parent::__construct($config);
    }
    
    function index_get($id=NULL){
        //load models
        $this->load->model(array('article/article_m','article/category_m','article/article_image_m','users/user_m'));
        $this->load->helper('general');
        $remap_fields = array(
            'id'                => 'id',
            'category_id'       => 'category_id',
            'category_name'     => 'category',
            'title'             => 'title',
            'url_title'         => 'url_title',
            'link_href'         => 'link_href',
            'date'              => 'article_date',
            'day'               => 'day',
            'month'             => 'month',
            'year'              => 'year',
            'synopsis'          => 'synopsis',
            'content'           => 'content',
            'image_url'         => 'image_url',
            'image_type'        => 'image_type',
            'image_urls'        => 'image_urls',
            'tags'              => 'tags',
            'types'             => 'types',
            'allow_comment'     => 'allow_comment',
            'published'         => 'published',
            'view_count'        => 'view',
            'created'           => 'created',
            'modified'          => 'modified',
            'created_by'        => 'created_by',
            'created_by_name'   => 'created_by_name',
            'ext_attributes'    => 'ext_attributes'
            
        );
        
        if ($id){
            $item = $this->article_m->get($id);
            $this->result = $this->remap_fields($remap_fields, $this->_article_proccess($item));
        }else{
            $limit = $this->get('limit') ? $this->get('limit') : 100;
            $page = $this->get('page') ? $this->get('page') : 1;
            $category_id = $this->get('category') ? $this->get('category') : 0;
            
            if ($category_id){
                $category_id_list = array($category_id);
                //get children category
                $children_categories = $this->category_m->get_select_where('id',array('parent'=>$category_id));
                if ($children_categories){
                    foreach ($children_categories as $child){
                        $category_id_list [] = $child->id;
                    }
                }
                $this->db->where_in('category_id', $category_id_list);
            }
            
            $items = $this->article_m->get_offset('*',array('published'=>1),($page-1)*$limit,$limit);
            foreach ($items as $item){
                $this->result [] = $this->remap_fields($remap_fields, $this->_article_proccess($item));
            }
        }
        
        $this->response($this->result);
    }
    
    private function _article_proccess($item){
        $thumb_sizes =  array(
            'original' => IMAGE_THUMB_ORI,'large' => IMAGE_THUMB_LARGE,
            'portrait' => IMAGE_THUMB_PORTRAIT,'medium' => IMAGE_THUMB_MEDIUM,
            'small' => IMAGE_THUMB_SMALL, 'smaller' => IMAGE_THUMB_SMALLER,
            'square' => IMAGE_THUMB_SQUARE, 'tiny' => IMAGE_THUMB_TINY
        );
        $item->date = date('d-M-Y H:i', $item->date);
        $item->category_name = $this->category_m->get_value('name',array('id'=>$item->category_id));
        $item->link_href = site_url('detail/'.$item->url_title);
        if ($item->image_url){
            $image_url = $item->image_url;
            $item->image_url = new stdClass();
            foreach ($thumb_sizes as $label => $key_value){
                $item->image_url->{$label} = get_image_thumb($image_url, $key_value);
            }
        }else{
            $item->image_url = NULL;
        }
        $item->image_urls = array();
        if ($item->image_type == IMAGE_TYPE_MULTI){
            $images = $this->article_image_m->get_by(array('article_id'=>$item->id));
            if ($images){
                foreach ($images as $img){
                    $image = new stdClass();
                    foreach($thumb_sizes as $label => $key_value){
                        $image->{$label} = get_image_thumb($img->image_url, $key_value);
                    }
                    
                    $item->image_urls[] = $image;
                }
            }
        }else{
            $item->image_urls = NULL;
        }
        $item->tags = $item->tags ? explode(',', $item->tags) : NULL;
        $item->types = $item->types ? explode(',', $item->types) : NULL;
        $item->allow_comment = (bool) $item->allow_comment;
        $item->published = (bool) $item->published;
        $item->created = date('Y-m-d H:i:s', $item->created);
        $item->modified = date('Y-m-d H:i:s', $item->modified);
        $item->created_by_name = $this->user_m->get_value('full_name',array('id'=>$item->created_by));
        $item->ext_attributes = $item->ext_attributes ? json_decode($item->ext_attributes):NULL;
        return $item;
    }
    
}

/*
 * file location: engine/application/controllers/service/article.php
 */
