<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class wrapper for REST_Controller
 *
 * @author marwansaleh <amazzura.biz@gmail.com>
 */

class REST_Api extends REST_Controller {
    protected $_recs_per_page = 100;
    protected $result = array();
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        //Load api helper
        $this->load->helper('api');
    }
    
    public function service_not_found(){
        $this->result['status'] = FALSE;
        $this->result['message'] = 'Service not found';
        $this->response($this->result);
    }
    
    protected function remap_fields($arr_map, $data){
        $result = NULL;
        
        if (is_array($data)){
            $result = array();
            foreach ($data as $item){
                $result [] = $this->_remap_object_properties($arr_map, $item);
            }
        }else{
            $result = $this->_remap_object_properties($arr_map, $data);
        }
        
        return $result;
    }
    
    private function _remap_object_properties($maps,$object){
        $new_class = new stdClass();
        foreach ($maps as $src => $dest){
            $new_class->{$dest} = isset($object->{$src})? $object->{$src} : NULL;
        }
        return $new_class;
    }
}
