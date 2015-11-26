<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Weather
 *
 * @author marwansaleh
 */
class Weather extends MY_AdminController {
    protected $icon_base = 'http://openweathermap.org/img/w/';
    protected $icon_ext = '.png';
    protected $icon_local_path = 'assets/img/cuaca/';
    
    function __construct() {
        parent::__construct();
        $this->data['active_menu'] = 'weather';
        $this->data['page_title'] = '<i class="fa fa-cloud"></i> Adverts';
        $this->data['page_description'] = 'List and update weather';
        
        //load models
        $this->load->model(array('weather/ow_city_m','weather/ow_cuaca_m'));
    }
    
    function index(){
        $page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE):1;
        
        $this->data['page'] = $page;
        $offset = ($page-1) * $this->REC_PER_PAGE;
        $this->data['offset'] = $offset;
        
        $where = NULL;
        
        //count totalRecords
        $this->data['totalRecords'] = $this->ow_cuaca_m->get_count($where);
        //count totalPages
        $this->data['totalPages'] = ceil ($this->data['totalRecords']/$this->REC_PER_PAGE);
        $this->data['items'] = array();
        if ($this->data['totalRecords']>0){
            $items = $this->ow_cuaca_m->get_offset('*',$where,$offset,  $this->REC_PER_PAGE);
            if ($items){
                foreach($items as $item){
                    $this->data['items'][] = $item;
                }
                $url_format = site_url('cms/weather/index?page=%i');
                $this->data['pagination'] = smart_paging($this->data['totalPages'], $page, $this->_pagination_adjacent, $url_format, $this->_pagination_pages, array('records'=>count($items),'total'=>$this->data['totalRecords']));
            }
        }
        $this->data['pagination_description'] = smart_paging_description($this->data['totalRecords'], count($this->data['items']));
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Weather forecast', site_url('cms/weather'), TRUE);
        
        $this->data['subview'] = 'cms/weather/index';
        $this->load->view('_layout_admin', $this->data);
    }
    
    function sync($city_id=NULL){
        
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
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Can not get api content');
            redirect('cms/weather');
        }
        $wheather_data = json_decode($wheather_data_json);
        if (!$wheather_data) {
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Can not parsing data return from api');
            redirect('cms/weather');
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
            $this->session->set_flashdata('message_type','success');
            $this->session->set_flashdata('message', 'New data api inserted into database successfully');
        } else {
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Failed to save data api into database');
        }

        //check if we have the icon on local
        if (!file_exists($data['icon_local_url'])) {
            $this->_save_weather_icon($data['icon_original_url'],$data['icon_local_url']);
        }
        
        redirect('cms/weather');
    }
    
    private function _get_cityId($city_name) {
        $city_id = $this->ow_city_m->get_value('_id', array('name' => $city_name));

        return $city_id;
    }
    
    private function _save_weather_icon($url, $save_name) {
        $ch = curl_init($url);
        $fp = fopen($save_name, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
    
    function delete(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        //check if found data item
        $item = $this->ow_cuaca_m->get($id);
        if (!$item){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Could not find data item. Delete item failed!');
        }else{
            if ($this->ow_cuaca_m->delete($id)){
                $this->session->set_flashdata('message_type','success');
                $this->session->set_flashdata('message', 'Data item deleted successfully');
            }else{
                $this->session->set_flashdata('message_type','error');
                $this->session->set_flashdata('message', $this->ow_cuaca_m->get_last_message());
            }
        }
        
        redirect('cms/weather/index?page='.$page);
    }
}

/*
 * file location: engine/application/controllers/cms/weather.php
 */
