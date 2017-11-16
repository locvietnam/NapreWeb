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

class Setup extends MY_Controller{
	
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
		$this->_control                 = $this->router->class;
		$this->_action                  = $this->router->method; 
		$this->_pathLogo                = $this->config->item('path_logo');
		$this->_data['current_control'] = $this->_control; 
		$this->_data['current_method']  = $this->_action; 
		$this->load->model('setup_model');
		//nhung nhom staff, manager, top manager khong duoc vào
		if( $this->_data['user_data']->role_id >= 4 ){
			redirect(admin_url('index.html'));
		}
		
	}
	
	public function index(){
            
		///error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['setup'];
		
		$more_url = '';
		$page_more_url = '';
		$cond = ""; 
		$keyword = trim(strip_tags($this->input->get('keyword')));
		
		if($keyword){
			$keyword_ = $this->setup_model->db->escape("%$keyword%");
			$cond .= " Where name LIKE $keyword_ OR value LIKE $keyword_";
			$more_url .= "&keyword=$keyword";
			$page_more_url = "keyword=$keyword";
		}

		$this->_data['keyword'] = $keyword;
		$this->_data['more_url'] = $more_url;
		
		$totalItems  = $this->setup_model->countItems($cond); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('setup.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		$list = $this->setup_model->getItems($cond, $per_page, $start); 
		$this->_data['list'] = $list;
		$this->_data['content'] = 'setup/main';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function add(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();
			$id = $this->setup_model->insertItem( $data );
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	public function update(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();			
			$objArr = explode("__", $data['obj']);
			if( count( $objArr ) > 1 && $objArr[0] != '' && $objArr[1] != '' ){
				$dataUpdate['name'] = $objArr[0];
				$dataUpdate['lang'] = $objArr[1];
				$dataUpdate['value'] = $data['value'];
				$id = $this->setup_model->updateItem( $dataUpdate );
				$mess['not_error'] = $id;
			}
		}
		die (json_encode( $mess ));
	}
}