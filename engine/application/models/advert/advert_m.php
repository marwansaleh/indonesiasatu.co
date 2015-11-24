<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Advert_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Advert_m extends MY_Model {
    protected $_table_name = 'adverts';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'start_date desc, end_date desc';
}

/*
 * file location: /application/models/advert/advert_m.php
 */
