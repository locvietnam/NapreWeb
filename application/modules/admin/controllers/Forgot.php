<?php
/**
* Controllers Backend Forgot password
* Last update 8 Jun 2017
* 
* @package backend
* @copyright A-Line
* @author Panpic-team
* @author position: PHP Developer
* @since 8 Jun 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends CI_Controller{
	
	private $_data;
	private $lable;

        public function __construct(){
		parent::__construct();

		$this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];
		$this->_data['base_url'] = $this->config->item("base_url");
		$this->_data['base_tlp_admin'] = $this->config->item("base_tlp_admin");
		$this->_data['base_url_admin'] = $this->config->item("base_url_admin");
		
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('login_model');		
		$this->load->model('lang_model');
		$this->lable = $this->lang_model->items();
		
		$this->_data['lable'] = $this->lable;
        		
	}
	
	public function index(){
            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
            $this->_data['error'] = '';
            
            if($this->input->post()) {
                
                $email = $this->input->post('email'); 
                
                if($email) {
                    // $where = array('user_email' => $email);
                    // print_r($where);
                    // $user = $this->login_model->check_exists($where);
                    $user = $this->login_model->getItemByCond(" user_email = '$email' ");
                    if($user->user_email) {
                        // print_r($user);
                        
                        $user_email = $user->user_email;
                        echo $link_confirm = base_url()."admin/forgot/newpassword/?e=".$email."&d=".$user->user_id;
                        
                        $data['params'] = array(
                            'email'         => $user_email,
                            'email_title'   => $this->lable['forgot_password'],
                            'link_confirm'  => $link_confirm,
                            'email_support' => $this->lable['email_support'],
                            'base_url'      => base_url(),
                            'email_footer'  => $this->lable['email_footer']
                        );
                        
                        $email_content = $this->parser->parse('email/forgot_password.tpl', $data, TRUE);
                        
                        require_once(APPPATH.'config/email.php');
                        $this->load->library('email');
                        $this->email->initialize($config);

                        $this->email->from($this->lable['aline_service']);
                        $this->email->to($email);
                        $this->email->subject($this->lable['forgot_password']);
                        $this->email->message($email_content);
                        
                        /*
                        $back_url = base_url('admin');
                        $send = false;
                        if ( ! $send ) { // $this->email->send()
                            $this->_data['alert'] = 'danger';
                            $this->_data['msg'] = $this->lable['system_send_email_fail'];
                            $this->_data['data'] = $data;
                            $this->parser->parse("forgot/index.tpl", $this->_data);
                            return;
                        } else {
                            $email = explode('@', $email);
                            $note_email_forgot_request = stripslashes($this->lable['note_email_forgot_request']);
                            $msg = sprintf($note_email_forgot_request, $email[1]);

                            $back_url = base_url();
                            $this->_data['alert'] = 'success';
                            $this->_data['msg'] = $msg;
                            $this->parser->parse("forgot/index.tpl", $this->_data);    
                            header("refresh:". $this->lable['timewait'].";url=$back_url");
                            return;
                        } 
                        */
                    } else {
                        
                        $this->_data['alert'] = 'danger'; 
                        $this->_data['msg']  = $this->lable['email_not_exist'];
            
                    }
                }
                
            }  
            
            $this->parser->parse("forgot/index.tpl", $this->_data); 
	}



        function newpassword() {
            
            // $lable_change_password = ;
            // $this->_data['seo'] = array('title' => $lable_change_password);
            
            $this->_data['task'] = $this->lable['lable_change_password'];
            
            $this->_data['alert'] = '';

            $email = $this->input->get('e');
            $user_id = $this->input->get('d');

            $user = $this->login_model->getItemByCond(" user_id = $user_id AND user_email='$email' ");

            $this->_data['valid'] = array('confirm_new_pwd'=>'');

            if($user) {

                $this->_data['data'] = array(
                    'email'     => $email,
                    'user_id'   => $user_id
                );

                if($this->input->post()) {
                    
                    $data = $this->input->post('data');
                    $new_pwd = trim($data['new_pwd']);
                    $confirm_new_pwd = trim($data['confirm_new_pwd']);

                    if($new_pwd != $confirm_new_pwd) { 
                        $valid = array('confirm_new_pwd' => $this->lable['passsword_not_match']); 
                        $this->_data['alert'] = 'danger';
                        $this->_data['msg'] = $this->lable['update_fail'];
                        $this->_data['valid'] = $valid;

                        $this->parser->parse("forgot/newpassword.tpl", $this->_data);
                        return;
                    }

                    // update
                    $this->login_model->id = $user_id;
                    $update = $this->login_model->updateItem(array('user_password'=> md5($new_pwd)));

                    if ($update) { 
                        $back_url = base_url('admin');
                        $this->_data['alert'] = 'success';
                        $this->_data['msg'] = $this->lable['update_succ'];
                        $this->parser->parse("forgot/newpassword.tpl", $this->_data);
                        header("refresh:" . $this->lable['timewait'].";url=".$back_url."");
                        return; 
                    } else {
                        $this->_data['alert'] = 'danger';
                        $this->_data['msg'] = $this->lable['update_newpassword_fail'];
                        $this->parser->parse("forgot/newpassword.tpl", $this->_data);
                        return;
                    } 
                }

                $this->parser->parse("forgot/newpassword.tpl", $this->_data);

            } else {
                $back_url = base_url('admin');
                $this->_data['alert'] = 'success';
                $this->_data['msg'] = $this->lable['system_not_found'];
                $this->parser->parse("forgot/newpassword.tpl", $this->_data);    
                header("refresh:". $this->lable['timewait'].";url=$back_url");
                return;
            }
        }

        
        
}


	
	
	


