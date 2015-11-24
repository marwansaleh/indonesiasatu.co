<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Advtype_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Advtype_m extends MY_Model {
    protected $_table_name = 'advert_types';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'name';
}

/*
 * file location: /application/models/advert/advtype_m.php
 */
