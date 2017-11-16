<?php
/**
* Controllers Backend login
* Last update 26 June 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 26 June 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller{
	
	private $_data;
	
	
	public function __construct(){
		parent::__construct();
		
		$this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];
		$this->_data['base_url'] = $this->config->item("base_url");
		$this->_data['base_tlp_admin'] = $this->config->item("base_tlp_admin");
		$this->_data['base_url_admin'] = $this->config->item("base_url_admin");
		$this->_data['current_control'] = $this->router->class;
		$this->_action = $this->router->method; 
		$this->_data['current_method']  = $this->_action; 
		$this->_data['lable'] = $this->lable;
		$this->_data['user_data'] = $this->session->userdata('login');
		$this->load->library('form_validation');
		
		//lchung add
		$this->_data['path_upload'] = $this->config->item('path_upload');
		$this->load->model('department_model');
		$this->load->model('users_model');
		$this->load->model('usermanagerdept_model');
		$this->load->model('userassigndept_model');
		$this->load->model('checklistresults_model');
		$this->load->model('checklist_model');	
		$this->load->model('comment_model');	
	}
	
	//the page this call from link comment.html?submitid as on page admin/checklist-results.html
	public function index(){
            
	   /// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['comment'];
		$userLogin = $this->_data['user_data'];
		//print_r( $user );
		$datecomment = $this->input->get('datecomment');
		if( $datecomment == '' ){
			$datecomment = date('Y/m/d');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('textcomment', $this->lable['comment_required'],'required');
		if( $this->input->post() ){
			$submitid = $this->input->post('submitid');
			$textcomment = $this->input->post('textcomment');
			$parent_id = (int)$this->input->post('id');
			if($this->form_validation->run()){
				
				///$on = $this->department_model->getOneById( 'Where id = ' . $parent_id )
				$daraInsert['parent_id'] = $parent_id;
				$daraInsert['submit_id'] = $submitid;
				$daraInsert['manager_id '] = $userLogin->user_id;
				$daraInsert['comments'] = $textcomment;
				$daraInsert['date_add'] = date('Y-m-d H:i:s');
				$daraInsert['last_update'] = date('Y-m-d H:i:s');
				///print_r( $daraInsert );die;
				$this->comment_model->insertItem( $daraInsert );
				redirect(admin_url('comment.html?submitid=' . $submitid )); 
			}
		}
		
		$submitid = (int)$this->input->get('submitid');
		if( $submitid == 0 ){
			redirect(admin_url('comments.html')); 
		}
		
		$cond = " Where a.submit_id = $submitid ";
		if( $userLogin->role_id < 5 ) {//nhom admin, CEO, HR, top manager
		}
		else if( $userLogin->role_id == 5 ){//nham manager
			$cond .= " AND a.manager_id = $userLogin->user_id "; 
		}
		elseif( $userLogin->role_id == 6 ) { //staff
			$cond .= " AND b.user_id = $userLogin->user_id "; 
		}
		
		$dept = $this->comment_model->getOne( "Where c.submit_id = $submitid" );
		///print_r($on);die;
		$items = $this->comment_model->getItems( $cond ); 
		
		$this->_data['datecomment'] = $datecomment;
		$this->_data['dept'] = $dept;
		$this->_data['list'] = $items;
		
		$this->_data['content'] = 'comment/index';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function listcm(){
		
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['list_comment'];
		$userLogin = $this->_data['user_data'];
		//$this->load->library('form_validation');
		//$this->form_validation->set_rules('textcomment', $this->lable['comment_required'],'required');
		$more_url = '';
		$page_more_url = '';
		$cond = " Where a.parent_id = 0 "; 
		$dept_id = (int)$this->input->get('dept');
		$datecomment = $this->input->get('datecomment');
		if( $datecomment == '' ){
			$datecomment = date('Y/m/d');
		}
		
		$more_url .= "&datecomment=$datecomment";
		$page_more_url = "datecomment=$datecomment";	
		$strtime = strtotime(str_replace("/", "-", $datecomment ));
		$cond .= " AND DATE(a.date_add) = DATE('" . str_replace("/", "-", $datecomment ) . "')";
		
		if( $dept_id ){
			$cond .= " AND e.department_id = $dept_id";
			$more_url .= "&dept=$dept_id";
			$page_more_url .= "&dept=$dept";
		}
		
		if( $userLogin->role_id < 5 ) {//nhom admin, CEO, HR, top manager
		}
		else if( $userLogin->role_id == 5 ){//nham manager
			$cond .= " AND a.manager_id = $userLogin->user_id "; 
		}
		elseif( $userLogin->role_id == 6 ) { //staff
			$cond .= " AND b.user_id = $userLogin->user_id "; 
		}		
		
		$this->_data['more_url'] = $more_url;
		
		$totalItems  = $this->comment_model->countItems($cond);
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('comments.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		$items = $this->comment_model->getItems($cond, $per_page, $start); 
		
		$cond = '';
		if( $userLogin->role_id > 4 ){//truong hop chi lay nhung phong ban thuoc nham manager
			$cond = ' Where b.manager_id  = ' . $userLogin->user_id;
		}	
		$listDept = $this->department_model->getAll( $cond );

		$this->_data['datecomment'] = $datecomment;
		$this->_data['strtime'] = $strtime;
		$this->_data['listDept'] = $listDept;
		$this->_data['dept_id'] = $dept_id;
		$this->_data['list'] = $items;
		
		$this->_data['content'] = 'comment/list';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
}