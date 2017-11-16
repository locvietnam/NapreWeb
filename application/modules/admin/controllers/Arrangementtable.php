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

class Arrangementtable extends MY_Controller{
	
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
		$this->load->model('department_model');
		$this->load->model('usermanagerdept_model');
		$this->load->model('userassigndept_model');
	}
	
	public function index(){
            
	   /// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['arrangement_table'];
		$userLogin = $this->_data['user_data'];
		if( $this->input->post() ){
			
			$data = $this->input->post();
			///print_r( $data );die;		
			$_data['department_id'] = $data['position'];
			if( !isset( $data['avail'] ) ) {
				$_data['avail'] = 0;
			}
			else {
				$_data['avail'] = 1;
			}
			$this->userassigndept_model->id = (int)$data['id'];
			///print_r( $_data );die;
			$status = $this->userassigndept_model->updateItem($_data);			
			redirect(admin_url('arrangement-table.html'));
		}
		
		$list = $this->department_model->getAll( );
		
		$data = array();
		$managerArr = array();
		$staffArr = array();
		$staffMax = 0;
		$cond = ' Where b.avail = 1 ';
		if( $userLogin->role_id > 4 ){
			$cond .= ' AND a.manager_id  = ' . $userLogin->user_id;
		}
		$manager = $this->usermanagerdept_model->getItems( $cond );
		///print_r( $manager );
		$staff = array();
		foreach( $manager as $m ){
			$where = " Where a.manager_id = " . (int)$m['manager_id'] . ' AND a.department_id = ' . (int)$m['department_id'];
			$where .= " AND b.avail = 1"; 
			$staff = $this->userassigndept_model->getItems( $where );
			$cStaff = count( $staff );
			if( $staffMax < $cStaff ){
				$staffMax = $cStaff;
			}				
			$m['staff'] = $staff;
			$managerArr[] = $m;
		}
			
		$this->_data['maxstaff'] = $staffMax;
		$this->_data['listmanager'] = $managerArr;
		$this->_data['listdept'] = $list;
		
		$this->_data['content'] = 'arrangementtable/index';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function getDeptofmanager(){
		
		$manager_id = (int)$this->input->get('managerid');
		$where = " Where a.manager_id = " . $manager_id;
		$manager = $this->usermanagerdept_model->getItems( $where );
		echo json_encode( array('data' => $manager ) );die;
	}
}