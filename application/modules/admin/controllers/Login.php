<?php
/**
* Controllers Backend login
* Last update 8 Jun 2017
* 
* @package backend
* @copyright A-Line
* @author Panpic-team
* @author position: PHP Developer
* @since 8 Jun 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{
	
	private $_data;
	
	
	public function __construct(){
		parent::__construct();

        $this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];
        $this->_data['base_url'] = $this->config->item("base_url");
        $this->_data['base_tlp_admin'] = $this->config->item("base_tlp_admin");
        $this->_data['base_url_admin'] = $this->config->item("base_url_admin");


        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('login_model');
        $this->load->model('users_model');
        $this->load->model('sessions_model');

        $this->_data['lable'] = $this->lable;
        		
	}
	
	public function index(){
            
            $this->_data['error'] = '';

            if($this->input->post()) { 
			
                $this->form_validation->set_rules('login' ,'login', 'callback_check_login');
                if($this->form_validation->run())
                {
                    $username = $this->input->post('username'); 
                    $password = $this->input->post('password'); 
                    $password = md5($password); 
                    $where = array(
                        'user_name' => $username , 
                        'user_password' => $password,
                        'role_id <' => 6
                    );
                    $userInfo = $this->login_model->get_info_user($where); 
					$this->users_model->id = $userInfo->user_id;
					$userInfo = $this->users_model->getInfo();
					
                    $this->session->set_userdata('login', $userInfo);
                    $session_id = $this->session->userdata('session_id');
                    $dataInsert['session_id'] = $session_id;
                    $dataInsert['user_id'] = $this->users_model->id;
                    $dataInsert['ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $dataInsert['user_agent'] = $userInfo->user_fullname;
                    $dataInsert['last_activity'] = time();
                    $dataInsert['user_data'] = json_encode($userInfo);
                    $this->sessions_model->insertItem($dataInsert);
                    redirect(admin_url('index.html'));
                }
            }  
            
            $this->parser->parse("login/index.tpl", $this->_data);
        	
	}


    /*
    * Kiem tra username va password co chinh xac khong
    */
    function check_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);
        $where = array('user_name' => $username , 'user_password' => $password);
        if($this->login_model->check_exists($where))
        {
            return true;
        }
        $this->form_validation->set_message(__FUNCTION__, $this->lable['username_password_notmatch']);
        return false;
    }

    /*
	* Kiểm tra đã đăng nhập hay chưa
	*/
    private function _user_is_login()
    {
    	$user_data = $this->session->userdata('login');
    //neu chua login
    	if(!$user_data)
    	{
    		return false;
    	}
    	return true;
    }

    /*
    * Phuong thuc dang xuat
    */
    public function logout()
    {
        if($this->_user_is_login())
        {
           //neu thanh vien da dang nhap thi xoa session login
           $this->session->unset_userdata('login');
        }
        $this->session->set_flashdata('flash_message', $this->lable['logout_success']);
        redirect();
    }

    


	

	

        
        
}


	
	
	


