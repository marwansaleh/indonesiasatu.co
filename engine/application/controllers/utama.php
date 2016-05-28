<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Utama
 *
 * @author marwansaleh
 */
class Utama extends MY_News {
    
    function mobile(){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters('MOBILE');
        
        $this->data['parameters'] = $parameters;
        
        //Load popular news
        $limit = isset($parameters['MOBILE_NEWS_NUM'])?$parameters['MOBILE_NEWS_NUM']:15;
        $this->data['limit'] = $limit;
        //data load by ajax
        //$this->data['mobile_news'] = $this->_mobile_news($limit);
        
        $this->data['subview'] = 'mobile/utama/index';
        $this->load->view('_layout_mobile', $this->data);
    }
}

/*
 * file location: engine/application/controllers/Utama.php
 */
