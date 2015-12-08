<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of User
 *
 * @author marwansaleh
 */
class User extends REST_Api {
    
    function __construct($config='rest') {
        parent::__construct($config);
        //load models
        $this->load->model(array('weather/ow_city_m','weather/ow_cuaca_m'));
    }
    
    function socmed_post(){
        $result = array('status' => FALSE);
        //Load data model
        $this->load->model(array('users/user_socmed_m', 'users/usergroup_m'));
        
        $client_app = $this->post('app');
        $client_id = $this->post('id');
        $name = $this->post('name');
        $email = $this->post('email');
        $picture = $this->post('picture');
        
        //check user scomed exists
        $user_filter_condition = array('client_app' => $client_app, 'client_id' => $client_id);
        if (!$this->user_socmed_m->get_count($user_filter_condition)){
            
            //create new user internall database
            $user_id = $this->user_m->save(array(
                'username'  => $client_app .'_'. $client_id,
                'password'  => $this->users->hash($client_id),
                'full_name' => $name,
                'group_id'  => $this->usergroup_m->get_value('group_id',array('group_name' => 'Socmed')),
                'type'      => USERTYPE_EXTERNAL,
                'email'     => $email,
                'avatar'    => $picture,
                'last_ip'   => $this->input->ip_address(),
                'created_on'=> time(),
                'is_active' => 1
            ));
            if ($user_id){
                $this->user_socmed_m->save(array(
                    'user_id'       => $user_id,
                    'client_app'    => $client_app,
                    'client_id'     => $client_id,
                    'client_name'   => $name,
                    'client_email'  => $email
                ));
                $new_user = new stdClass();
                $new_user->id = $user_id;
                
                $result['status'] = TRUE;
                $result['user'] = $new_user;
            }else{
                $result['message'] = 'Faile creating new user';
            }
        }else{
            $result['status'] = TRUE;
            $user = $this->user_socmed_m->get_select_where('user_id as id',$user_filter_condition, TRUE);
            $result['user'] = $user;
        }
        
        $this->response($result);
    }
}

/*
 * file location: engine/application/controllers/service/user.php
 */
