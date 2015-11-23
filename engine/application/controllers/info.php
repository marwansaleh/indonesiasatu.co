<?php

class Info extends MY_Controller{
    function index(){
        echo phpinfo();
    }
    
    function getcontent(){
        echo json_decode(file_get_contents('https://www.googleapis.com/urlshortener/v1/url'));
    }
    
    function get_curl($api_key='AIzaSyAM2X5rKlNjaNr35gytxxEm3FRV3vcIjmU'){
        $api_base_url ='https://www.googleapis.com/urlshortener/v1/url';
        $long_url = 'http://tesaja';
        
        $options = array(
            'longUrl'   => $long_url
        );
        $params = array(
            'fields'    => 'id',
            'key'       => $api_key
        );
        //create curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_base_url .'?'.  http_build_query($params));
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($options));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
        //curl_setopt($curl, CURLOPT_STDERR, $fp);
            
        $output = curl_exec($curl);
        curl_close($curl);
        
        //fclose($fp);
        
        if (($decoded = json_decode($output))){
            print_r ($decoded);
            exit;
        }
        echo $output;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

