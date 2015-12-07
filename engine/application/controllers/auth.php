<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Home
 *
 * @author marwansaleh
 */
class Auth extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->data['body_class'] = 'login-img-body';
    }
    
    function index(){
        $this->load->helper('cookie');
        
        if ($this->users->isLoggedin()){
            if ($this->users->has_access('CAN_CP')){
                redirect('cms/dashboard');
            }else{
                if ($this->session->userdata('success_redirect')){
                    redirect($this->session->userdata('success_redirect'));
                }else{
                    redirect('home');
                }
            }
        }
        
        if ($this->session->flashdata('message')){
            $this->data['message_error'] = create_alert_box($this->session->flashdata('message'), $this->session->flashdata('message_type'));
            $this->_write_log('Flashsession:'.$this->session->flashdata('message'));
        }else{
            $this->_write_log('Flashsession:--empty---');
        }
        
        $cookie_login = $this->input->cookie('cookie-login');
        if ($cookie_login){
            $this->data['remember'] = json_decode($cookie_login);
        }else{
            $this->data['remember'] = NULL;
        }
        
        $this->_write_log('Try to login');
        
        $this->data['submit'] = site_url('auth/login');
        $this->data['subview'] = 'login/index';
        //var_dump($cookie_login);
        $this->load->view('_layout_login', $this->data);
    }
    
    function login(){
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        
        $rules = $this->user_m->rules_login;
        $this->form_validation->set_rules($rules);
        //exit(print_r($rules));
        if ($this->form_validation->run() != FALSE) {
            
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');
        
            //check flag remember me to create cookie
            if ($remember){
                $cookie = array(
                    'name'   => 'cookie-login',
                    'value'  => json_encode(array('username'=>$username, 'password'=>$password))
                );

                $this->input->set_cookie($cookie);
            }else{
                delete_cookie('cookie-login');
            }
            
            $user = $this->users->login($username, $password);
            
            $this->_write_log('Login using username:'.$username.' and password:'.md5($password));
            
            if (!$user){
                $this->session->set_flashdata('message_type','error');
                $this->session->set_flashdata('message', $this->users->get_message());
                $this->_write_log('Failed login');
            }else{
                $this->_write_log('Success with return value:' . json_encode($user));
            }
        }
        
        if (validation_errors()){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', validation_errors());
            
            $this->_write_log('Failed login with message:'. validation_errors());
        }
        
        redirect('auth');
    }
    
    function logout(){
        $can_cp = $this->users->has_access('CAN_CP');
        $success_redirect = $this->input->get('redirect') ? $this->input->get('redirect') : site_url('home');
        
        $this->users->logout();
        if ($can_cp){
            redirect('auth');
        }else{
            redirect($success_redirect);
        }
    }
    
    private function _get_twitter_params(){
        $params = $this->get_sys_parameters('TW_');
        $result = array(
            'consumer_key'      => isset($params['TW_API_KEY']) ? $params['TW_API_KEY'] : 'NXOtnYZ2qqSWPErSBWuVLnSaY',
            'consumer_secret'   => isset($params['TW_API_SECRET']) ? $params['TW_API_SECRET'] : 'QOcUJiQup7UciWXWWje4VpPS6JfKtzZ504C4FrQvELboYCcDEc',
            'oauth_callback'    => isset($params['TW_OAUTH_CALLBACK']) ? $params['TW_OAUTH_CALLBACK'] : '/auth/twitter_callback',
        );
        
        return $result;
    }
    
    function twitter_redirect(){
        $this->load->library('twconnect', $this->_get_twitter_params());
        $success_redirect = $this->input->get('redirect') ? $this->input->get('redirect') : site_url('home');
        $this->session->set_userdata('success_redirect', $success_redirect);
        /* twredirect() parameter - callback point in your application */
        /* by default the path from config file will be used */
        $ok = $this->twconnect->twredirect('auth/twitter_callback');

        if (!$ok) {
            echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }
    }
    
    function twitter_callback(){
        $this->load->library('twconnect', $this->_get_twitter_params());

        $ok = $this->twconnect->twprocess_callback();

        if ( $ok ) { redirect('auth/twitter_success'); }
        else { redirect ('auth/twitter_failure'); }
    }
    
    function twitter_success(){
        $this->load->library('twconnect', $this->_get_twitter_params());
        //Load data model
        $this->load->model(array('users/user_socmed_m', 'users/usergroup_m'));

        // saves Twitter user information to $this->twconnect->tw_user_info
        // twaccount_verify_credentials returns the same information
        $this->twconnect->twaccount_verify_credentials();

        //echo 'Authenticated user info ("GET account/verify_credentials"):<br/><pre>';
        //print_r($this->twconnect->tw_user_info); echo '</pre>';
        
        $userinfo = $this->twconnect->tw_user_info;
        
        $username = CLIENTAPP_TWITTER .'_'. $userinfo->id;
        $password = $userinfo->id;
        //check if account exists
        if (!$this->user_socmed_m->get_count(array('client_app' => CLIENTAPP_TWITTER, 'client_id' => $userinfo->id))){
            
            //create new user internall database
            $user_id = $this->user_m->save(array(
                'username'  => $username,
                'password'  => $this->users->hash($password),
                'full_name' => $userinfo->name ? $userinfo->name : $userinfo->screen_name,
                'group_id'  => $this->usergroup_m->get_value('group_id',array('group_name' => 'Socmed')),
                'type'      => USERTYPE_EXTERNAL,
                'avatar'    => $userinfo->profile_image_url,
                'last_ip'   => $this->input->ip_address(),
                'created_on'=> time(),
                'is_active' => 1
            ));
            if ($user_id){
                $this->user_socmed_m->save(array(
                    'user_id'       => $user_id,
                    'client_app'    => CLIENTAPP_TWITTER,
                    'client_id'     => $userinfo->id,
                    'client_name'   => $userinfo->name ? $userinfo->name : $userinfo->screen_name,
                    'client_email'  => ''
                ));
                
                $this->_write_log('New socmed account created successfully');
            }
        }else{
            $this->_write_log('Socmed account exists');
        }
        
        //login using internal account
        if (!$this->users->login($username, $password)){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', $this->users->get_message());
            
            $this->_write_log('Failed login using socmed account');
        }else{
            $this->_write_log('Login successfull using socmed account');
        }
        redirect('auth');
    }
    
    function twitter_failure(){
        $this->session->set_flashdata('message_type','error');
        $this->session->set_flashdata('message', 'Login failure using twitter account');
        redirect('auth');
    }
    
    
    function hashit(){
        $subject = $this->input->get('subject');
        
        echo $this->users->hash($subject);
    }
}

/*
 * file location: engine/application/controllers/auth.php
 */
