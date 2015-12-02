<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Detail
 *
 * @author marwansaleh
 */
class Detail extends MY_News {
    function __construct() {
        parent::__construct();
        
        //$this->data['mainmenus'] = $this->_mainmenu(0); //no submenu
        //load model
        $this->load->model('article/article_image_m', 'image_m');
    }
    
    function _remap($slug){
        //$this->mobile($slug);
        if ($this->is_device('MOBILE')){
            $this->mobile($slug);
        }else{
            $this->index($slug);
        }
    }
    
    function index($slug=NULL){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters('LAYOUT');
        $this->data['parameters'] = $parameters;
        
        //get item
        $article = $this->article_m->get_by(array('url_title'=>$slug), TRUE);
        if (!$article){
            redirect('home');
            exit;
        }
        
        $this->data['meta_title'] = $this->data['meta_title'] . ' - ' .$article->title;
        
        $this->_article_view_counter($article->id);
        
        //Does article has multi images
        if ($article->image_type==IMAGE_TYPE_MULTI){
            //load all images
            $article->images = $this->image_m->get_by(array('article_id'=>$article->id));
        }
        $article->share_url = $article->url_short ? $article->url_short : current_url();
        //get author name
        $article->created_by_name = $this->user_m->get_value('full_name', array('id'=>$article->created_by));
        
        $this->data['article'] = $article;
        $this->data['related_news'] = $this->_related_news(explode(',',$article->tags), 3, array('id !='=>$article->id));
        
        $widgets = explode(',',$parameters['LAYOUT_DETAIL_WIDGETS']);
        foreach ($widgets as $widget){
            $this->data['widgets'] [] = trim($widget);
        }
        $widgets = $this->data['widgets'];
        if (in_array(WIDGET_NEWSGROUP, $widgets)){
            //Load popular news
            $this->data['popular_news'] = $this->_popular_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:4);
            //Load popular news
            $this->data['recent_news'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:4);
            //Load popular news
            $this->data['commented_news'] = $this->_commented_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:4);
        }
        if (in_array(WIDGET_NEWSLATEST, $widgets)){
            //Load latest post
            $this->data['latest_post'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSLATEST_NUM'])?$parameters['LAYOUT_NEWSLATEST_NUM']:5);
        }
        if (in_array(WIDGET_STOCKS, $widgets)){
            //Load rates
            $this->data['rates'] = $this->_get_rates();
        }
        if (in_array(WIDGET_NEWSPHOTO, $widgets)){
            //store photo news
            $this->data['photo_news'] = $this->_photo_news(isset($parameters['LAYOUT_NEWSPHOTO_NUM'])?$parameters['LAYOUT_NEWSPHOTO_NUM']:10);
        }
        if (in_array(WIDGET_SELECTED_CATEGORY, $widgets)){
            //get category name
            $selected_category_name = $parameters['LAYOUT_WIDGET_SELECTED_CATEGORY'];
            $selected_category = NULL;
            if ($selected_category_name){
                //get category id
                $selected_category = $this->category_m->get_by(array('slug'=>$selected_category_name),TRUE);
                if (!$selected_category){
                    $selected_category = $this->category_m->get_select_where('id,name',NULL,TRUE);
                }
            }
            
            $this->data['selected_news_category'] = array(
                'category'  => $selected_category,
                'articles' => $this->_article_categories($selected_category->id, 
                    isset($parameters['LAYOUT_HOME_CAT_ARTICLE_NUM'])?$parameters['LAYOUT_HOME_CAT_ARTICLE_NUM']:3)
            );
        }
        
        $category_slug = $this->category_m->get_value('slug', array('id'=>$article->category_id));
        $this->data['active_menu'] = $category_slug;
        
        $this->meta_set_props(array(
            'author'            => 'IndonesiaSatu.co',
            'description'       => $article->synopsis,
            'keywords'          => $article->title,
            'canonical'         => current_url()
        ));
        
        //set og properties
        $this->og_set_props(array(
            'title'         => $article->title,
            'url'           => site_url('detail/'.$article->url_title), 
            'description'   => $article->synopsis,
            'type'          => 'article',
            //'article:author'=> $article->created_by_name,
            'image'         => get_image_thumb($article->image_url, IMAGE_THUMB_LARGE)
        ));
        //$this->data['main_slider'] = TRUE;
        $this->data['subview'] = 'frontend/detail/index';
        $this->load->view('_layout_main', $this->data);
    }
    
    function mobile($slug=NULL){
        //get item
        $article = $this->article_m->get_by(array('url_title'=>$slug), TRUE);
        if (!$article){
            redirect('home');
            exit;
        }
        
        $this->data['meta_title'] = $this->data['meta_title'] . ' - ' .$article->title;
        
        $this->_article_view_counter($article->id);
        
        //get author name
        $article->created_by_name = $this->user_m->get_value('full_name', array('id'=>$article->created_by));
        
        $this->data['article'] = $article;
        $this->data['related_news'] = $this->_related_news(explode(',',$article->tags), 6, array('id !='=>$article->id));
        
        //$this->data['main_slider'] = TRUE;
        $this->data['subview'] = 'mobile/detail/index';
        $this->load->view('_layout_mobile', $this->data);
    }
    
    private function _related_news($tags_array, $num=3, $condition=NULL){
        $limit_each_tag = 10;
        
        if ($tags_array && is_array($tags_array)){
            $current = time();
            $related = array();
            foreach ($tags_array as $tag){
                $this->db->like('tags', $tag);
                $result = $this->article_m->get_offset('id,title,url_title,synopsis,image_url,date',$condition,0,$limit_each_tag);
                
                if ($result){
                    foreach ($result as $r){
                        $related[$current - $r->date] = $r;
                    }
                }
            }
            //now sort by key (the latest)
            ksort($related);
            //create new array for last proccess
            $new_related = array();
            foreach ($related as $r){
                if (count($new_related)<$num){
                    if (!in_array($r->id, $new_related)){
                        $new_related [$r->id] = $r;
                    }
                }
            }
            
            return $new_related;
        }
        
        return NULL;
    }
}

/*
 * file location: engine/application/controllers/detail.php
 */
