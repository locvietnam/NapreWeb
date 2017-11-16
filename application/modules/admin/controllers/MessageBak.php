<?php
/**
* Controllers Backend login
* Last update 3 Jan 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 3 Jan 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller{
	
	private $_data;
	public function __construct(){
            parent::__construct();
            $this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];            
            $this->_data['base_url'] = $this->config->item("base_url");
            $this->_data['base_tlp_admin'] = $this->config->item("base_tlp_admin");
            $this->_data['base_url_admin'] = $this->config->item("base_url_admin");

            $this->_data['lable'] = $this->lable;
            $this->_data['user_data'] = $this->session->userdata('login');
			
			//lchung add
			$this->_data['path_upload'] = $this->config->item('path_upload');
            $this->load->model('department_model');
			$this->_control                 = $this->router->class;
			$this->_action                  = $this->router->method; 
			$this->_pathLogo                = $this->config->item('path_logo');
			$this->_data['current_control'] = $this->_control; 
			$this->_data['current_method']  = $this->_action; 
			$this->load->model('users_model');
			$this->load->model('message_model');
	}
	
	public function index(){
            die('==');
            ///error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
            $this->_data['task'] = '';
            $this->_data['breadcrumb'] = '';
            $this->_data['alert'] = '';
			$this->_data['title_page'] = $this->lable['title_page_message'];
			$user = $this->_data['user_data'];
			$user_id = $user->user_id;
			$where = " Where a.user_id != " . $user_id;
			if( $user->role_id == 5 ) {
				$where .= ' AND b.manager_id = ' . $user_id;
			}
			else if( $user->role_id == 4) {//group top-manager the get roel_id = 5 as group manager
				$where .= ' AND a.role_id = 5';
			}
			$list = $this->users_model->getAll( $where ); 
			$this->_data['list'] = $list;
			///print_r( $this->_data['user_data'] );die;
			if($this->input->post()) { 
			
				$data = $this->input->post();
				if( $data['user_id'] != '' ) {
					$userArr = explode(",", $data['user_id']);
					///print_r( $data );die;
					$dataInsert['title'] = $data['title'];
					$dataInsert['message_type'] = ($user->role_id <= 3 ) ? 'HR' : 'U';
					$dataInsert['contents'] = $data['message'];				
					$dataInsert['date_add'] = date('Y-m-d H:i:s');
					$dataInsert['last_update'] = date('Y-m-d H:i:s');			
					$id_insert = $this->message_model->insertItem( $dataInsert );
					
					foreach ( $userArr as $v ) {
						$dataInsert2['message_id'] = $id_insert;
						$dataInsert2['user_id_received'] = $v;
						$dataInsert2['user_id_send'] = $user_id;
						$this->message_model->insertItemMesRece( $dataInsert2 );
					}
					if( $id_insert > 0 ){
						$this->session->set_flashdata('alert_class', 'alert-success');
						$this->session->set_flashdata('send_message', $this->lable['send_message_success']);
					}
					else{
						$this->session->set_flashdata('alert_class', 'alert-error');
						$this->session->set_flashdata('send_message', $this->lable['send_message_failure']);
					}
				}
				else {
					$this->session->set_flashdata('alert_class', 'alert-warning');
					$this->session->set_flashdata('send_message', $this->lable['not_choose_receiver']);
				}
				redirect(admin_url('message.html'));
			}
			
            $this->_data['content'] = 'message/index';
            $this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function add(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();
			$data['date_add'] = date('Y-m-d');
			$data['last_update'] = date('Y-m-d H:i:s');
			$id = $this->department_model->insertItem( $data );
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	public function update(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();
			$data['last_update'] = date('Y-m-d H:i:s');
			$this->department_model->department_id = (int)$data['department_id'];
			unset( $data['department_id'] );
			$id = $this->department_model->updateItem( $data );
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	public function del(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();
			$this->department_model->department_id = (int)$data['department_id'];
			$id = $this->department_model->removeItem();
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	public function usermanagerdep(){
		//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['admin_sidebar_user_manager_dep'];
		
		
		$more_url = '';
		$page_more_url = '';
		$cond = '';
		$keyword = trim(strip_tags($this->input->get('keyword')));
		
		if($keyword){
			$cond .= " Where b.user_name LIKE '%$keyword%' OR b.user_fullname LIKE '%$keyword%' ";
			$more_url .= "&keyword=$keyword";
			$page_more_url = "keyword=$keyword";
		}
		
		$this->_data['keyword'] = $keyword;
		$this->_data['more_url'] = $more_url;
		
		$totalItems  = $this->usermanagerdept_model->countItems($cond); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('department/user-manager-dep.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		
		$list = $this->usermanagerdept_model->getItems($cond, $per_page, $start); 
		$this->_data['list'] = $list; 
		
		$this->_data['content'] = 'department/user-manager-dep';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function addusermanagerdep(){
		
		//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['admin_add_user_manager_dep'];
		
		$item = new stdClass();
		$item->user_idArr = array();
		$item->department_id = 0;
		if( $this->input->post() ){
			$data = $this->input->post('data'); 
			if( isset( $data['user_id'] ) )
			$item->user_idArr = $data['user_id'];
			$item->department_id = $data['department_id'];
		}
		
		$this->_data['data'] = $item; 
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('data[department_id]', $this->lable['department_id_required'],'required');
		$this->form_validation->set_rules('data[user_id][]', $this->lable['user_id_required'],'required');
		
		//chech validate
		if($this->form_validation->run()){
			$data = $this->input->post('data'); 
			$this->usermanagerdept_model->removeItem($data);
			foreach( $data['user_id'] as $user_id ){
				$_data['manager_id'] = $user_id;
				$_data['department_id'] = $data['department_id'];
				$status = $this->usermanagerdept_model->insertItem($_data);
			}
			
			redirect(admin_url($this->_control . '/user-manager-dep.html')); 
			//save
		}		
		
		$listDep = $this->department_model->getAll( ); 
		$this->_data['listDep'] = $listDep;
		
		$where = ' Where c.role_id < 6 ';//chi lay nhung user co role_id < 6 la role Manager
		$listUser = $this->users_model->getItems( $where ); 
		$this->_data['listUser'] = $listUser;
		
		$this->_data['content'] = 'department/add-user-manager-dep';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function delusermanagerdep(){
		
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$manager_id = (int)$this->input->post('manager_id');
			$department_id = (int)$this->input->post('department_id');
			$_dataDel['department_id'] = $department_id;
			$_dataDel['user_id'] = $manager_id;
			$id = $this->usermanagerdept_model->removeItem($_dataDel);
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	public function userassigndept(){
		//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['admin_sidebar_user_assign_dept'];
		
		
		$more_url = '';
		$page_more_url = '';
		$cond = '';
		$keyword = trim(strip_tags($this->input->get('keyword')));
		
		if($keyword){
			$cond .= " Where b.user_name LIKE '%$keyword%' OR b.user_fullname LIKE '%$keyword%' ";
			$more_url .= "&keyword=$keyword";
			$page_more_url = "keyword=$keyword";
		}
		
		$this->_data['keyword'] = $keyword;
		$this->_data['more_url'] = $more_url;
		
		$totalItems  = $this->userassigndept_model->countItems($cond); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('department/user-manager-dep.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		
		$list = $this->userassigndept_model->getItems($cond, $per_page, $start); 
		$this->_data['list'] = $list; 
		
		$this->_data['content'] = 'department/user-assign-dept';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function adduserassigndept(){
		
		//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['add_user_assign_dept'];
		
		$item = new stdClass();
		$item->user_idArr = array();
		$item->department_id = 0;
		$item->manager_id = 0;
		if( $this->input->post() ){
			$data = $this->input->post('data'); 
			if( isset( $data['user_id'] ) )
			$item->user_idArr = $data['user_id'];
			$item->department_id = $data['department_id'];
			$item->manager_id = $data['manager_id'];
		}
		
		$this->_data['data'] = $item; 
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('data[department_id]', $this->lable['department_id_required'],'required');
		$this->form_validation->set_rules('data[manager_id]', $this->lable['manager_id_required'],'required');
		$this->form_validation->set_rules('data[user_id][]', $this->lable['user_id_required'],'required');
		
		//chech validate
		if($this->form_validation->run()){
			$data = $this->input->post('data'); 
			$this->userassigndept_model->removeItem($data);
			foreach( $data['user_id'] as $user_id ){
				$_data['manager_id'] = $data['manager_id'];
				$_data['user_id'] = $user_id;
				$_data['department_id'] = $data['department_id'];
				$_data['avail'] = 1;
				$status = $this->userassigndept_model->insertItem($_data);
			}
			
			redirect(admin_url($this->_control . '/user-assign-dept.html')); 
			//save
		}		
		
		$listDep = $this->department_model->getAll( ); 
		$this->_data['listDep'] = $listDep;
		
		$where = ' Where c.role_id < 6 ';//chi lay nhung user co role_id < 6 la role Manager
		$listUserManager = $this->users_model->getItems( $where ); 
		$this->_data['listUserManager'] = $listUserManager;
		
		$where = ' Where c.role_id = 6 ';//chi lay nhung user co role_id < 6 la role Staff
		$listUser = $this->users_model->getItems( $where ); 
		$this->_data['listUser'] = $listUser;
		
		$this->_data['content'] = 'department/add-user-assign-dept';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
}