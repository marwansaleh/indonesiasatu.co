<?php

class Info extends MY_Controller{
    function index(){
        echo phpinfo();
    }
    
    function https(){
        echo json_decode(file_get_contents('https://www.googleapis.com/urlshortener/v1/url'));
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

