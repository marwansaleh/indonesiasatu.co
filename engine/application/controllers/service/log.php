<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Log
 *
 * @author marwansaleh
 */
class Log extends REST_Api {
    
    
    function __construct($config='rest') {
        parent::__construct($config);
    }
    
    function index_get(){
        $lines = $this->get('lines') ? $this->get('lines'):30;
        $log = $this->read_log($lines);
        
        $data = str_getcsv($log, "\n"); //parse the rows 
        
        $result = array();
        foreach($data as $line) {
            $row = str_getcsv($line, "\t"); //parse the items in rows 
            $result [] = array(
                'datetime'              => $row[0],
                'cookie_id'             => $row[1],
                'ip_address'            => $row[2],
                'agent_string'          => $row[3],
                'event_description'     => $row[4]
            );
        }
        
        $this->response($result);
    }
}

/*
 * file location: engine/application/controllers/service/log.php
 */
