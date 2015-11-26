<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Advert_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Ow_city_m extends MY_Model {
    protected $_table_name = 'owm_city';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'country, name';
}

/*
 * file location: /application/models/weather/ow_city_m.php
 */
