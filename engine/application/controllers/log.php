<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Log
 *
 * @author marwansaleh
 */
class Log extends MY_BaseController {
    function __construct() {
        parent::__construct();
    }
    
    function index($lines=5,$token=NULL){
        if ($token && $token == 'melog'){
            $log = $this->read_log($lines);
            echo '<pre>'.$log.'</pre>';
        }else{
            show_404();
        }
    }
}

/*
 * file location: engine/application/controllers/log.php
 */
