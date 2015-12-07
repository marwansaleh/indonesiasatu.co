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
    
    protected function get_sys_vars($pattern=NULL){
        $this->load->model('system/sys_variables_m','sysvar_m');
        
        $sysvars = array();
        $result = NULL;
        
        if (!$pattern){
            $result = $this->sysvar_m->get();
        }else{
            if (is_array($pattern)){
                foreach($pattern as $index => $p){
                    if ($index==0):
                        $this->db->like('var_name', $p);
                    else:
                        $this->db->or_like('var_name', $p);
                    endif;
                }
            }else{
                $this->db->like('var_name', $pattern);
            }
            $result = $this->sysvar_m->get();
        }
        if ($result){
            foreach ($result as $var){
                $sysvars[$var->var_name] = variable_type_cast($var->var_value,$var->var_type);
            }
        }
        
        return $sysvars;
    }
}
