<?php
/**
* Controllers Backend login
* Last update 21 June 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 21 June 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{
	
	private $_data;
	public function __construct(){
		parent::__construct();
		
		$this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];
		$this->_data['base_url'] = $this->config->item("base_url");
		$this->_data['base_tlp_admin'] = $this->config->item("base_tlp_admin");
		$this->_data['base_url_admin'] = $this->config->item("base_url_admin");
		$this->_data['current_control'] = $this->router->class;
		$this->_data['lable'] = $this->lable;
		$this->_data['user_data'] = $this->session->userdata('login');
		
		//lchung add
		$this->_data['path_upload'] = $this->config->item('path_upload');
		$this->_action = $this->router->method; 
		$this->_data['current_method']  = $this->_action; 
		$this->load->model('users_model');
		$this->load->model('message_model');
	}
	
	public function index(){
            
	   /// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['notice'];
		
		$user = $this->_data['user_data'];
		$user_id = $user->user_id;
		$cond = ' Where a.user_id_received = ' . $user_id;
		$this->message_model->user_id_received = $user_id;
		$this->message_model->updateItem( array('received_viewed' => 1) );//cap nhat tinh trang
		$more_url = '';
		$totalItems  = $this->message_model->countItems( $cond ); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('index.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		
		$list = $this->message_model->getItems($cond, $per_page, $start); 
		$this->_data['list'] = $list;
		
		$this->_data['content'] = 'index/main';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function deleteMessage(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();	
			$user = $this->_data['user_data'];
			$user_id = (int)$user->user_id;
			$message_id = (int)$data['id'];
			$this->message_model->user_id_received = $user_id;
			$this->message_model->message_id = $message_id;
			$id = $this->message_model->removeItemMess( );
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
	
}