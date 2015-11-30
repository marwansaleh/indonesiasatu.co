<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class wrapper for REST_Controller
 *
 * @author marwansaleh <amazzura.biz@gmail.com>
 */

class REST_Api extends REST_Controller {
    protected $_recs_per_page = 100;
    
    protected $_error_messages = array();
    
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
}
