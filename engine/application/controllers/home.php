<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Home
 *
 * @author marwansaleh
 */
class Home extends MY_News {
    function __construct() {
        parent::__construct();
        
        $this->data['main_slider'] = TRUE;
        $this->data['mainmenus'] = $this->_mainmenu(0); //no submenu
        $this->data['active_menu'] = 'home';
    }
    
    function _remap(){
        //$this->mobile();
        if ($this->is_device('MOBILE')){
            $this->mobile();
        }else{
            $this->index();
        }
    }
    
    function index(){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters(array('LAYOUT'));
        $this->data['parameters'] = $parameters;
        
        $widgets = explode(',',$parameters['LAYOUT_HOME_WIDGETS']);
        $this->data['widgets'] = $widgets;
        if (in_array(WIDGET_NEWSGROUP, $widgets)){
            //Load popular news
            $this->data['popular_news'] = $this->_popular_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:5);
            //Load popular news
            $this->data['recent_news'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:5);
            //Load popular news
            $this->data['commented_news'] = $this->_commented_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:5);
        }
        if (in_array(WIDGET_NEWSLATEST, $widgets)){
            //Load latest post
            $this->data['latest_post'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSLATEST_NUM'])?$parameters['LAYOUT_NEWSLATEST_NUM']:6);
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
        
        $this->data['inspirasi'] = $this->_inspiration();
        
        //Load slider news
        $this->data['slider_news'] = $this->_slider_news(5);
        //Load highlight news
        $this->data['highlight_news'] = $this->_highlight_news(4);
        
        
        
        //Load popular news
        $this->data['latest_news'] = $this->_latest_news(isset($parameters['LAYOUT_HOME_LATEST_NUM'])?$parameters['LAYOUT_HOME_LATEST_NUM']:15);
        
        //Load categories in home
        $home_categories = $this->_home_category(isset($parameters['LAYOUT_HOME_CAT_NUM'])?$parameters['LAYOUT_HOME_CAT_NUM']:3);
        $this->data['categories'] = array();
        
        //Get number of articles within selected categories
        $category_articles_num = isset($parameters['LAYOUT_HOME_CAT_ARTICLE_NUM'])?$parameters['LAYOUT_HOME_CAT_ARTICLE_NUM']:3;
        foreach ($home_categories as $category){
            //Get articles for this category
            $category->articles = $this->_article_categories($category->id, $category_articles_num);
            $this->data['categories'][] = $category;
        }
        
        $this->data['subview'] = 'frontend/home/index';
        $this->load->view('_layout_main', $this->data);
    }
    
    function _article_categories($category_id, $num=3){
        if (!isset($this->article_m)){
            $this->load->model('article/article_m');
        }
        
        $articles = array();
        $result = $this->article_m->get_offset('*',array('category_id'=>$category_id),0,$num);
        foreach ($result as $item){
            $item->created_by_name = $this->user_m->get_value('full_name', array('id'=>$item->created_by));
            $articles [] = $item;
        }
        
        return $articles;
    }
    
    function mobile(){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters('MOBILE');
        
        $this->data['parameters'] = $parameters;
        
        //Load popular news
        $limit = isset($parameters['MOBILE_NEWS_NUM'])?$parameters['MOBILE_NEWS_NUM']:10;
        $this->data['limit'] = $limit;
        $this->data['mobile_news'] = $this->_mobile_news($limit);
        
        $this->data['subview'] = 'mobile/home/index';
        $this->load->view('_layout_mobile', $this->data);
    }
    
    function _inspiration(){
        //get category id for inspiration
        $category_id = $this->category_m->get_value('id', array('slug' => 'inspirasi'));
        if (!$category_id){
            $category = $this->category_m->get_select_where('id',array('parent'=>0, 'is_menu'=>1, 'is_home'=>1), TRUE);
            if ($category){
                $category_id = $category->id;
            }
        }
        //get the article
        $inspiration = $this->article_m->get_select_where('*', array('category_id'=>$category_id, 'published'=>1), TRUE);
        
        if ($inspiration && $inspiration->ext_attributes){
            $inspiration->ext_attributes = json_decode($inspiration->ext_attributes);
        }
        return $inspiration;
    }
    
    function teshttps(){
        echo json_decode(file_get_contents('https://www.googleapis.com/urlshortener/v1/url'));
    }
}

/*
 * file location: engine/application/controllers/home.php
 */
