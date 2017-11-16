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

class Report extends MY_Controller{
	
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
		$this->load->model('report_model');
		
		//nhung nhom khong thuoc Top manager & Manager thi khong duoc vao trang nay
		///if( $this->_data['user_data']->role_id != 4 && $this->_data['user_data']->role_id != 5 ){ 
		if( $this->_data['user_data']->role_id >= 6){//sua lai cho ca admin va seo vao duoc
			redirect(admin_url('index.html'));
		}
	}
	
	public function index(){
	   /// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['report_title_page'];
		$userLogin = $this->_data['user_data'];
		$cond = '';
		if( $userLogin->role_id == 5 ){
			$cond = ' WHERE a.manager_id = ' . $userLogin->user_id;
		}
		elseif( $userLogin->role_id == 4 ){
			$cond = ' WHERE a.top_manager_id = ' . $userLogin->user_id;
		}
		
		$totalItems  = $this->report_model->countItems($cond);
		$more_url = '';
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('reports.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;		
		$items = $this->report_model->getItems($cond, $per_page, $start);
		$this->_data['list'] = $items; 
		
		$this->_data['content'] = 'report/index';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function detail(){
		
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['report_title_page'];
		$userLogin = $this->_data['user_data'];
		$id = (int)$this->input->get('id');
		$item = new stdClass();
		$detail = NULL;
		if( $id > 0 ){
			$detail = $this->report_model->getItemsRD(" WHERE report_id = $id");
			///print_r( $detail );die;
		}
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('data[field][]', $this->lable['report_field_required'],'required');
		*/
		$this->_data['detail'] = $detail; 
		if( $this->input->post() ){
			
			//Chi có Manager moi duoc gui report
			if( $userLogin->role_id == 4 ){ //4 la nhom Top manager khg duoc submit report chi xem
				redirect(admin_url('index.html'));
			}
			
			$data = $this->input->post('data'); 
			$item->field = $data['field'];			
			$data = $this->input->post('data');
			if( $data['field'][1][0] != '' && $data['field'][2][0] != ''  ){
				$top_manager_id = (int)@$this->users_model->getItem(" Where b.role_id = 4 ")->user_id;
				$_dataInsert['manager_id'] = $userLogin->user_id;
				$_dataInsert['date_add'] = date('Y-m-d H:i:s');
				$_dataInsert['last_update'] = date('Y-m-d H:i:s');
				$_dataInsert['top_manager_id'] = $top_manager_id;
				$_dataInsert['manager_id'] = $userLogin->user_id;
				
				$report_id = $this->report_model->insertItem($_dataInsert);
				
				$_data['report_id'] = $report_id;
				$_data['staff_event_1'] = $data['field'][1][0];
				$_data['staff_event_2'] = $data['field'][1][1];;				
				$_data['nursing_dept_event_1'] = $data['field'][2][0];;
				$_data['nursing_dept_event_2'] = $data['field'][2][1];;
				$id = $this->report_model->insertItemRD($_data);
				
				if( $data['field'][1][2] != '' || $data['field'][2][2] != '' ){
					$_data['report_id'] = $report_id;
					$_data['staff_event_1'] = $data['field'][1][2];
					$_data['staff_event_2'] = $data['field'][1][3];;				
					$_data['nursing_dept_event_1'] = $data['field'][2][2];
					$_data['nursing_dept_event_2'] = $data['field'][2][3];
					$id = $this->report_model->insertItemRD($_data);
				}
				
				redirect(admin_url('reports.html')); 
				//save
			}//End if( $data['field'][1][0] != '' && $data['field'][2][0] != ''  ){
		}	//End if( $this->input->post() ){
		
		$manager_report = $this->config->item('manager_report');
		$this->_data['manager_report'] = $manager_report;
		$this->_data['content'] = 'report/detail';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
}