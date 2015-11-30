<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Weather
 *
 * @author marwansaleh
 */
class Weather extends MY_Controller {
    protected $icon_base = 'http://openweathermap.org/img/w/';
    protected $icon_ext = '.png';
    protected $icon_local_path = 'assets/img/cuaca/';
    
    function __construct() {
        parent::__construct();
        //load models
        $this->load->model(array('weather/ow_city_m','weather/ow_cuaca_m'));
    }
    
    function sync($city_id=NULL){
        $result = array();
        
        $api_key = '3330aaf0f92c101dc121d1c537a1406e';
        $api_base = 'http://api.openweathermap.org/data/2.5/weather?appid=' . $api_key . '&id=';

        $date = date('Y-m-d');
        $datetime = time();

        //get data from api
        $city_name = 'Jakarta';
        if (!$city_id) {
            $city_id = $this->_get_cityId($city_name);
        }

        //set api_end_point
        $api_end_point = $api_base . $city_id;
        $wheather_data_json = file_get_contents($api_end_point);
        if (!$wheather_data_json) {
            $result['message'] = 'Can not get api content';
        }
        $wheather_data = json_decode($wheather_data_json);
        if (!$wheather_data) {
            $result['message'] = 'Can not parsing data return from api';
        }

        //insert into database
        $data = array(
            'city_id' => $city_id,
            'city_name' => $city_name,
            'last_checked_date' => $date,
            'last_checked_time' => $datetime,
            'api_end_point' => $api_end_point,
            'api_result' => $wheather_data_json,
            'api_result_summary' => $wheather_data->weather[0]->description,
            'temp'  => $wheather_data->main->temp,
            'pressure' => $wheather_data->main->pressure,
            'humidity' => $wheather_data->main->humidity,
            'icon' => $wheather_data->weather[0]->icon,
            'icon_original_url' => $this->icon_base . $wheather_data->weather[0]->icon . $this->icon_ext,
            'icon_local_url' => $this->icon_local_path . $wheather_data->weather[0]->icon . $this->icon_ext
        );

        if ($this->ow_cuaca_m->save($data)) {
            $result['message'] = 'New data api inserted into database successfully';
        } else {
            $result['message'] = 'Failed to save data api into database';
        }

        //check if we have the icon on local
        if (!file_exists($data['icon_local_url'])) {
            $result_icon = $this->_save_weather_icon($data['icon_original_url'],$data['icon_local_url']);
            if ($result_icon){
                $result['icon'] = 'Icon copied successfully';
            }else{
                $result['icon'] = 'Icon failed to copy from server';
            }
        }else{
            $result['icon'] = 'Icon exists';
        }
        
        echo json_encode($result);
    }
    
    private function _get_cityId($city_name) {
        $city_id = $this->ow_city_m->get_value('_id', array('name' => $city_name));

        return $city_id;
    }
    
    private function _save_weather_icon($url, $save_name) {
        $image = file_get_contents($url);
        if ($image){
            if (file_put_contents($save_name, $image)){
                return TRUE;
            }
        }
        
        return FALSE;
//        $ch = curl_init($url);
//        $fp = fopen($save_name, 'wb');
//        curl_setopt($ch, CURLOPT_FILE, $fp);
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_exec($ch);
//        curl_close($ch);
//        fclose($fp);
    }
    
}

/*
 * file location: engine/application/controllers/service/weather.php
 */
