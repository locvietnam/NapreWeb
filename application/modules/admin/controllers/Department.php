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

class Department extends MY_Controller{
	
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
		$this->load->model('department_model');
		$this->_data['current_control'] = $this->_control; 
		$this->_data['current_method']  = $this->_action; 
		$this->load->model('users_model');
		$this->load->model('usermanagerdept_model');
		$this->load->model('userassigndept_model');
        $this->load->model('hospital_model');
		//nhung nhom staff, manager, top manager khong duoc vào
		if( $this->_data['user_data']->role_id >= 5 ){
			redirect(admin_url('index.html'));
		}		
	}
	
	public function index(){
		
		//Chi co Admin CEO HR duoc vào khg thi redirect to home
		if( $this->_data['user_data']->role_id >= 4 ){
			redirect(admin_url('index.html'));
		}	
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		
		$this->_data['task'] = $this->lable['add'];
		$this->_data['breadcrumb'] = $this->lable['general_variable'];
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['department'];
		
        $hospital_id = (int)$this->input->get('hospital_id');
        $strWhere = '';
        if( $hospital_id > 0 ){
            $strWhere = " WHERE a.hospital_id = $hospital_id";
        }
		$list = $this->department_model->getAll( $strWhere . ' GROUP BY department_id ' );
		$this->_data['list'] = $list;
        $this->_data['hospitalData'] = $this->hospital_model->getItems();
        
		$this->_data['content'] = 'department/main';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function add(){
		$mess['not_error'] = '0';
		$userLogin = $this->_data['user_data'];
		if( $userLogin->role_id <= 4 ){//chi co nhom Top manager, Admin, HR mới có quyền thêm xóa sửa phòng ban
			if($this->input->post()) { 
				$data = $this->input->post();
				$data['date_add'] = date('Y-m-d');
				$data['last_update'] = date('Y-m-d H:i:s');
				$id = $this->department_model->insertItem( $data );
				$mess['not_error'] = $id;
			}
		}
		die (json_encode( $mess ));
	}
	
	public function update(){
		$mess['not_error'] = '0';
		$userLogin = $this->_data['user_data'];
		if( $userLogin->role_id <= 4 ){//chi co nhom Top manager, Admin, HR mới có quyền thêm xóa sửa phòng ban
			if($this->input->post()) { 
				$data = $this->input->post();
				$data['last_update'] = date('Y-m-d H:i:s');
				$this->department_model->department_id = (int)$data['department_id'];
				unset( $data['department_id'] );
				$id = $this->department_model->updateItem( $data );
				$mess['not_error'] = $id;
			}
		}
		die (json_encode( $mess ));
	}
	
	public function del(){
		$mess['not_error'] = '0';
		$userLogin = $this->_data['user_data'];
		if( $userLogin->role_id <= 4 ){//chi co nhom Top manager, Admin, HR mới có quyền thêm xóa sửa phòng ban
			if($this->input->post()) { 
				$data = $this->input->post();
				
				$cond = ' WHERE department_id=' . (int)$data['department_id'];
				$c = $this->department_model->getCountChecklistCate( $cond );
				if( $data['confirm'] == 'yes' || $c == 0 ) {
					$this->department_model->department_id = (int)$data['department_id'];
					$id = $this->department_model->removeItem();
					$mess['not_error'] = $id;
				}
				else {
					$mess['not_error'] = '';
					$mess['confirm'] = $this->lable['confirm_del_department_have_checklist_category'];
					$mess['id'] = (int)$data['department_id'];
				}
				
			}
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
		
		if( $keyword ){
			$cond .= " Where (b.user_name LIKE '%$keyword%' OR b.user_fullname LIKE '%$keyword%') ";
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
		///$this->form_validation->set_rules('data[department_id]', $this->lable['department_id_required'],'required');
		///$this->form_validation->set_rules('data[user_id][]', $this->lable['user_id_required'],'required');
		$this->form_validation->set_rules('data[department_id]', '', 'required', array('required' => $this->lable['department_id_required'] ));
		$this->form_validation->set_rules('data[user_id][]', '', 'required', array('required' => $this->lable['user_id_required'] ));
		
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
		
		$where = ' Where c.role_id = 5';//chi lay nhung user co role_id = 5 la role Manager 
		$listUser = $this->usermanagerdept_model->getAll( $where ); 
		///print_r( $listUser );die;
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
		$avail_str = trim(strip_tags($this->input->get('avail')));
		if( $avail_str != 'trash' || $avail_str == 1 ) {
			$avail = '1';
		}
		else {
			$avail = '0';
		}
		if($keyword || $avail_str == 'trash' ){
			if( $keyword != '' )
				$cond .= " Where (b.user_name LIKE '%$keyword%' OR b.user_fullname LIKE '%$keyword%') AND a.avail = $avail";
			else
				$cond .= " Where a.avail = 0";
				
			$more_url .= "&keyword=$keyword&avail=$avail";
			$page_more_url = "keyword=$keyword&avail=$avail";
		}
		else if( $avail_str == '' || $avail_str == 1 ) {
			$cond .= " Where a.avail = $avail";
			///$more_url .= "&avail=$avail";
			///$page_more_url = "avail=$avail";
		}

		$this->_data['keyword'] = $keyword;
		$this->_data['more_url'] = $more_url;
		
		$totalItems  = $this->userassigndept_model->countItems($cond); 
		$trash = $this->userassigndept_model->countItems(' Where a.avail = 0 '); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('department/user-assign-dept.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		
		$list = $this->userassigndept_model->getItems($cond, $per_page, $start); 
		
		$this->_data['list'] = $list; 
		$this->_data['trash'] = $trash;
		///print_r( $list );die;
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
		///$this->form_validation->set_rules('data[department_id]', $this->lable['department_id_required'],'required');
		///$this->form_validation->set_rules('data[manager_id]', $this->lable['manager_id_required'],'required');
		///$this->form_validation->set_rules('data[user_id][]', $this->lable['user_id_required'],'required');
		
		$this->form_validation->set_rules('data[department_id]', '', 'required', array('required' => $this->lable['department_id_required'])
);

		$this->form_validation->set_rules('data[manager_id]', '', 'required', array('required' => $this->lable['manager_id_required'])
);
		$this->form_validation->set_rules('data[user_id][]', '', 'required', array('required' => $this->lable['user_id_required']));
		
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
		
		$where = ' Where a.department_id = ' . (int)$item->department_id;//chi lay nhung user co role_id = 5 la role Manager
		$listUserManager = $this->usermanagerdept_model->getItems( $where ); 
		$this->_data['listUserManager'] = $listUserManager;
		
		$where = ' Where a.role_id = 6 AND a.avail = 1';//chi lay nhung user co role_id < 6 la role Staff va avail = 1 vi chua dua vao thung rác
		$listUser = $this->userassigndept_model->getAll( $where ); 
		$this->_data['listUser'] = $listUser;
		
		$this->_data['content'] = 'department/add-user-assign-dept';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function deluserassigndept(){
		
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$id = (int)$this->input->post('id');
			$this->userassigndept_model->id = $id;
			$id = $this->userassigndept_model->removeItem();
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	//get ajax on page add-user-manager-dep.tpl
	public function getusermanager(){
		$where = ' Where c.role_id = 5';//chi lay nhung user co role_id = 5 la role Manager
		$d = $this->usermanagerdept_model->getAll( $where ); 
		$department_id = (int)$this->input->get('department_id'); 
		$str = '';
		foreach ( $d as $item ) {
			$disabled = '';
			$disabledClass = '';
			if( $item['Bmanager_id'] == $item['Amanager_id'] && $department_id == $item['department_id']){
				$disabled = 'disabled="disabled"';
				$disabledClass = 'disabled';
			}
			$str .= '<label class="' . $disabledClass . '">
					<input type="checkbox" ' . $disabled . ' name="data[user_id][]" value="' . $item['Amanager_id'] . '" />
					' . $item['user_fullname'] . ' (' . $item['role_name'] .' ' . $item['department_name'] . ')
					</label><br />';
		}
		echo json_encode( array('data' => $str ) );
		die;
	}
	
	//get ajax on page add-user-assign-dept.tpl
	public function getmanager(){
		$department_id = (int)$this->input->get('department_id'); 
		$where = " Where a.department_id = $department_id";
		$d = $this->usermanagerdept_model->getItems( $where );
		echo json_encode( array('data' => $d ) );
		die;
	}
	
	//get ajax on page add-user-assign-dept.tpl
	public function getstaff(){
		$where = ' Where a.role_id = 6 AND a.avail = 1';//chi lay nhung user co role_id < 6 la role Staff va avail = 1 vi chua dua vao thung rác
		$d = $this->userassigndept_model->getAll( $where ); 
		$str = '';
		foreach ( $d as $item ) {
			$disabled = '';
			$disabledClass = '';
			if( $item['Buser_id'] == $item['Auser_id'] ){
				$disabled = 'disabled="disabled"';
				$disabledClass = 'disabled';
			}
			$str .= '<label class="' . $disabledClass . '">
					<input type="checkbox" ' . $disabled . ' name="data[user_id][]" value="' . $item['Auser_id'] . '" />
					' . $item['user_fullname'] . ' (' . $item['role_name'] . ')
					</label><br />';
		}
		echo json_encode( array('data' => $str ) );
		die;
	}
	
	public function resetuserassigndept(){
		$id = (int)$this->input->get('id'); 
		$this->userassigndept_model->id = $id;
		$data['avail'] = 1;
		$this->userassigndept_model->updateItem( $data );
		redirect(admin_url($this->_control . '/user-assign-dept.html'));
	}
}