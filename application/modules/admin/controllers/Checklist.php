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

class Checklist extends MY_Controller{
	
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
			$this->_control                 = $this->router->class;
			$this->_action                  = $this->router->method; 
			$this->_pathLogo                = $this->config->item('path_logo');
			$this->_data['current_control'] = $this->_control; 
			$this->_data['current_method']  = $this->_action; 
			
			$this->load->model('checklist_model');
			$this->load->model('department_model');
			$this->load->model('users_model');
			$this->load->model('usermanagerdept_model');
			$this->load->model('userassigndept_model');
            $this->load->model('hospital_model');
	}
	
	public function index(){
           
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['checklist'];
		$userLogin = $this->_data['user_data'];
		$this->session->unset_userdata('checklist_category');
		$this->session->unset_userdata('checklist_sub_category');
		
		$cond = ' WHERE a.department_id > 0 ';
		if( $userLogin->role_id > 4 ){//truong hop chi lay nhung phong ban thuoc nham manager
			$cond = ' AND b.manager_id  = ' . $userLogin->user_id;
		}	
        
        $hospital_id = (int)$this->input->get('hospital_id');
        if( $hospital_id > 0 ){
            $cond .= " AND a.hospital_id = $hospital_id";
        }
        
		$cond .= ' GROUP BY a.department_id ';
		$listDep = $this->department_model->getAll( $cond ); 
		$this->_data['listDep'] = $listDep;
		$dept = (int)$this->input->get('dept');
		if( $dept == 0 && !empty($listDep) ){
			$dept = (int)$listDep[0]->department_id;
		}
		///$dept = 2;
		$cond = 'Where a.department_id = ' . $dept . ' AND a.parent_category_id = 0 AND a.avail = 1 ';
		$listArr = $this->checklist_model->getallCate( $cond );
		$list = array();
		$list2 = array();
		foreach ( $listArr as $itemP ) {
			$id1 = $itemP->checklist_category_id;
			$cond = 'Where a.department_id = ' . $dept . ' AND a.parent_category_id = ' . $id1 . ' AND a.avail = 1 ';
			$listArrS = $this->checklist_model->getallCate( $cond );
			$itemP->subcate = array();
			$list[$id1] = (array)$itemP;
			foreach ($listArrS as $item ) {
				$id2 = $item->checklist_category_id;
				$cond = ' WHERE checklist_category_id = ' . (int)$id2;
				$item->checklist = $this->checklist_model->getAll( $cond );
				$list[$id1]['subcate'][] = (array)$item;
			}
		}
		//print_r( $list );die;
		$this->_data['list'] = $list;
		$this->_data['dept'] = $dept;
        $this->_data['hospitalData'] = $this->hospital_model->getItems();
		$this->_data['content'] = 'checklist/index';	
		$this->parser->parse("layout/index.tpl", $this->_data);           
	}
	
	public function results(){
		
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['admin_sidebar_checklist_results'];
		
		$cond = '';
		$more_url = '';
		$totalItems  = $this->checklist_model->countItems( ); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('checklist-results.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		
		$list = $this->checklist_model->getItems($cond, $per_page, $start); 
		$this->_data['list'] = $list; 
		
		$this->_data['content'] = 'checklist/results';
	
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function addchecklist(){
		$userLogin = $this->_data['user_data'];
		if( $userLogin->role_id > 5 ){ //chi co Admin & CEO, Top manager, 5=>manager duoc vào
			redirect(admin_url('index.html'));
		}
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['checklist_create'];
		
		$this->load->library('form_validation');
		$step = 1;
			
		$item = new stdClass();
		$item->user_idArr = array();
		$item->department_id = 0;
		$item->manager_id = 0;
		$item->checklist_type_id = '';
		$item->weekday_num = 0;
		$item->step = $step;
		$item->checklist_category = '';
		$item->checklist_sub_categories = null;
		$item->parent_category_id = 0;
		
		$id = (int)$this->input->get('id');
		if( $id > 0 && !$this->input->post() ){
			$cond = " Where checklist_category_id = $id";
			$item = $this->checklist_model->getItems($cond); 
			
			if( $item ) {
				$item = (object)$item[0];
				switch( $item->checklist_type ){
					case"The end of month":
						$item->checklist_type = 'dm';
					break;
					case"Day of weekend":
						$item->checklist_type = 'dw';
					break;
					default:
						$item->checklist_type = 'd';
				}
			}
			if( (int)$this->input->get('step') == 2 ){
				$checklist_sub_categories = $this->checklist_model->getAll( $cond );
				if( !empty( $checklist_sub_categories ) ){
					$array = array();
					foreach ($checklist_sub_categories as $vl ) {
						$array[] = $vl->title;
					}
					$item->checklist_sub_categories = $array;
				}
				else {
					$item->checklist_sub_categories = null;
				}
				//print_r( $item->checklist_sub_categories );die;
			}
			
			if( (int)$this->input->get('step') == 3 ){
				$user_idArr = $this->checklist_model->getallCateUser( $cond );
				if( !empty( $user_idArr ) ){
					$array = array();
					foreach ($user_idArr as $vl ) {
						$array[] = $vl->user_id;
					}
					$item->user_idArr = $array;
				}
				else {
					$item->user_idArr = array();
				}
				///print_r( $item->user_idArr );die;
			}
			
		}
		
		if( $this->input->post() ){
			$data = $this->input->post('data');
			
			switch( $data['step'] ) {
				case"1":
					///$this->form_validation->set_rules('data[checklist_category]', $this->lable['checklist_title_required'],'required');
					///$this->form_validation->set_rules('data[department_id]', $this->lable['department_id_required'],'required');
					///$this->form_validation->set_rules('data[manager_id]', $this->lable['manager_id_required'],'required');
					///$this->form_validation->set_rules('data[checklist_type_id]', $this->lable['checklist_type_id_empty'],'required');
					
					 $this->form_validation->set_rules('data[checklist_category]', '', 'required', array('required' => $this->lable['checklist_title_required'])
);
					$this->form_validation->set_rules('data[department_id]', '', 'required', array('required' => $this->lable['department_id_required'])
);
					$this->form_validation->set_rules('data[manager_id]', '', 'required', array('required' => $this->lable['manager_id_required'])
);
					$this->form_validation->set_rules('data[checklist_type_id]', '', 'required', array('required' => $this->lable['checklist_type_id_empty'])
);
					
					$item->checklist_type_id = $data['checklist_type_id'];
					
					if( $item->checklist_type_id == 'dw' ){
						$this->form_validation->set_rules('data[weekday_num]', $this->lable['weekday_num_required'],'required');
					}
					
					$item->parent_category_id = (isset( $data['parent_category_id'] )) ? $data['parent_category_id']: 0;
					$item->checklist_category = (isset( $data['checklist_category'] ) ) ? $data['checklist_category'] : 0;					
					$item->department_id = (isset( $data['department_id'] )) ? $data['department_id'] : 0;
					$item->manager_id = (isset( $data['manager_id'] )) ? $data['manager_id'] : 0;
					
					$item->weekday_num = $data['weekday_num'];
					//chech validate
					if($this->form_validation->run()){
						
						$this->session->set_userdata('checklist_category', $data);
						$item->step = $data['step']+1;
						redirect(admin_url('checklist-create.html?step=' . $item->step . '&id=' . $id )); 
						//save
					}	
				break;
				case"2":
					$item->checklist_sub_categories = $data['checklist_sub_categories'];
					///$this->form_validation->set_rules('data[checklist_sub_categories][]', $this->lable['checklist_sub_categories_required'],'required');
					$this->form_validation->set_rules('data[checklist_sub_categories][]', '', 'required', array('required' => $this->lable['checklist_sub_categories_required'])
);
					if($this->form_validation->run()){
						$item->step = $data['step']+1;
						$this->session->set_userdata('checklist_sub_category', $data);
						redirect(admin_url('checklist-create.html?step=' . $item->step . '&id=' . $id )); 
					}
				
				break;
				case"3":
					///$this->form_validation->set_rules('data[user_id][]', $this->lable['user_id_required'],'required');
					///$this->form_validation->set_rules('data[user_id][]', '', 'required', array('required' => $this->lable['user_id_required']));
					if( isset( $data['user_id'] ) )//kiem tra nau khg chon se sinh ra loi
						$item->user_idArr = $data['user_id'];
					///not validation data[user_id][]
					///if($this->form_validation->run()){
						
						///$item->user_idArr = $data['user_id'];
						
						$checklist_category = $this->session->userdata('checklist_category');
						$checklist_sub_category = $this->session->userdata('checklist_sub_category');
						$checklist_category['avail'] = 1;
						unset( $checklist_category['step'] );
						
						$idCate = $id;
						if( $id > 0 ) {
							$this->checklist_model->checklist_category_id = $id;
							$is_up = $this->checklist_model->updateItemCate( $checklist_category );
						}
						else {
							$idCate = $this->checklist_model->insertItemCate( $checklist_category );
						}

						//truong hop edit thi ta xoa het cai cu va insert new 
						if( $id > 0 ) {
							$this->checklist_model->checklist_category_id = $id;
							$this->checklist_model->removeItems( );
							//khi sua thi xoa hết cấp con rồi insert lại
							$this->checklist_model->removeItemChecklistCateSub();
						}
						
						foreach ( $checklist_sub_category['checklist_sub_categories'] as $v ) {
							/*
							$dataInsert = array();
							$dataInsert['checklist_category_id'] = $idCate;
							$dataInsert['title'] = $v;
							$is_insert = $this->checklist_model->insertItem( $dataInsert );
							*/
							$checklist_category['checklist_category'] = $v;
							$checklist_category['parent_category_id'] = $idCate;
							//insert checklist category sub
							$is_insert = $this->checklist_model->insertItemCate( $checklist_category );
						}
						
						//truong hop edit thi ta xoa het cai cu va insert new 
						if( $id > 0 ) {
							$this->checklist_model->checklist_category_id = $id;
							$this->checklist_model->removeItemCateUsers( );
						}
						///print_r( $data );die;
						if( isset( $data['user_id'] ) )//kiem tra nau khg chon se sinh ra loi
						foreach ( $data['user_id'] as $v ) {
							$dataInsert = array();
							$dataInsert['checklist_category_id'] = $idCate;
							$dataInsert['user_id'] = $v;
							$id = $this->checklist_model->insertItemCateU( $dataInsert );
						}
						
						$this->session->unset_userdata('checklist_category');
						$this->session->unset_userdata('checklist_sub_category');
						redirect(admin_url('checklist.html')); 
					///}//End if($this->form_validation->run()){
				break;
			}
			
		}
		
		$this->_data['data'] = $item; 
		
		$whereDept = '';
		$whereUserManager = '';
		if( $userLogin->role_id == 5 ){//nhom manager thi chi lay nhung phong ban tuoc manager do
			$whereDept = ' Where b.manager_id = ' . $userLogin->user_id;
			$whereUserManager = 'AND a.manager_id = ' . $userLogin->user_id;
			$item->manager_id = $userLogin->user_id;//neu la nhom manager thi manager_id = chinh user_id
		}		
		$listDep = $this->department_model->getAll( $whereDept ); 
		$this->_data['listDep'] = $listDep;
		
		$where = ' Where b.role_id = 5 AND b.avail = 1 ';//chi lay nhung user co role_id = 5
		if( $item->department_id > 0 ){
			$where .= ' AND a.department_id = ' . $item->department_id;
		}
		
		$listUserManager = $this->checklist_model->getUserManager( $where . $whereUserManager ); 
		$this->_data['listUserManager'] = $listUserManager;
		
		$listType = $this->checklist_model->getallType( ); 
		$this->_data['listType'] = $listType;
		
		$listWeekday = $this->checklist_model->getallWeek( ); 
		$this->_data['listWeekday'] = $listWeekday;		
		
		
		$where = ' Where b.role_id = 6 AND b.avail = 1 AND a.avail = 1 AND a.user_id NOT IN(SELECT user_id FROM ' . $this->checklist_model->table_che_cate_u . ') ';//chi lay nhung user co role_id = 6 la role Staff
		$checklist_category = $this->session->userdata('checklist_category');
		if( isset($checklist_category['manager_id']) && $checklist_category['manager_id'] > 0 ){
			$where .= ' AND a.manager_id = ' . $checklist_category['manager_id'];
		}
		
		$listUser = $this->checklist_model->getUserStaff( $where ); 
		$this->_data['listUser'] = $listUser;
		
		$cond = " Where a.parent_category_id = 0 AND a.avail = 1 ";
		if( $userLogin->role_id == 5 ){//nhom manager thi chi lay nhung phong ban tuoc manager do
			$cond .= 'AND a.manager_id = ' . $userLogin->user_id;
		}
		$listCate = $this->checklist_model->getItems($cond); 
		$this->_data['listCate'] = $listCate;
		$this->_data['step'] = $step;
        $this->_data['hospitalData'] = $this->hospital_model->getItems();
		$this->_data['content'] = 'checklist/add-checklist';
	
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
    //get department ajax on page add-checklist.tpl
	public function getdept(){
		
        $hospital_id = (int)$this->input->get('hospital_id');
        $cond = '';
        if( $hospital_id > 0 ){
            $cond .= " WHERE a.hospital_id = $hospital_id";
        }        
		$cond .= ' GROUP BY a.department_id ';
		$listDep = $this->department_model->getAll( $cond );
		$str = '<option value=""> --- ' . $this->lable['select_option'] . ' --- </option>';
		foreach ( $listDep as $item ) {
			$str .= '<option value="' . $item->department_id . '">' . $item->department_name . '</option>';
		}
		echo json_encode( array('data' => $str ) );
		die;
	}
    
	//get ajax on page add-user-manager-dep.tpl
	public function getusermanager(){
		
		$department_id = (int)$this->input->get('department_id'); 
		$where = ' Where b.role_id  = 5 AND b.avail = 1 ';//chi lay nhung user co role_id = 5 la role Manager 
		$where .= ' AND a.department_id = ' . $department_id;
		$listUserManager = $this->checklist_model->getUserManager( $where ); 
		
		$str = '';
		foreach ( $listUserManager as $item ) {
			$str .= '<option value="' . $item->user_id . '">' . $item->user_fullname . '</option>';
		}
		echo json_encode( array('data' => $str ) );
		die;
	}
	
	//get ajax on page add-user-assign-dept.tpl
	public function getstaff(){
		$where = ' Where a.role_id = 6 AND a.avail = 1 ';//chi lay nhung user co role_id < 6 la role Staff
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
	
	public function getdepartment(){
		
		$userLogin = $this->_data['user_data'];
		$department_id = (int)$this->input->get('departmentid'); 
		$where = ' Where a.department_id ';
		if( $userLogin->role_id > 4 ){//truong hop chi lay nhung phong ban thuoc nham manager
			$where .= ' AND b.manager_id  = ' . $userLogin->user_id;
		}	
		
		if( $department_id > 0 ){
			$where .= ' AND a.department_id = ' . $department_id;
		}
		
		$where .= ' GROUP BY a.department_id ';
		$listUserManager = $this->department_model->getAll( $where ); 
		
		$str = '';
		foreach ( $listUserManager as $item ) {
			$str .= '<option value="' . $item->department_id . '">' . $item->department_name . '</option>';
		}
		echo json_encode( array('data' => $str ) );
		die;
		
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
	
	public function insert(){
		$mess['not_error'] = '0';
		$mess['checklist_id'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();
			///print_r( $data );die;
			$dataInsert = array();
			$dataInsert['checklist_category_id'] = $data['checklist_category_id'];
			$dataInsert['parent_category_id'] = $data['parent_category_id'];			
			$dataInsert['title'] = $data['title'];
			$id = $this->checklist_model->insertItem( $dataInsert );
			$mess['checklist_id'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	public function delete(){
		$mess['not_error'] = '0';
		if($this->input->get('checklist_id')) { 
			$this->checklist_model->checklist_id = $this->input->get('checklist_id');
			$id = $this->checklist_model->removeItem();
		}
		die (json_encode( $mess ));
	}
	
	public function insertcate(){
		$mess['not_error'] = '0';
		$mess['checklist_category_id'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();
			$dataInsert = array();
			$dataInsert['department_id'] = (isset($data['department_id'])) ? $data['department_id'] : 0;
			$dataInsert['checklist_category'] = (isset($data['checklist_category'])) ? $data['checklist_category'] : '';
			$dataInsert['manager_id'] = (isset($data['manager_id'])) ? $data['manager_id'] : 0;
			$dataInsert['parent_category_id'] = (isset($data['parent_category_id'])) ? $data['parent_category_id'] : 0;
			$id = $this->checklist_model->insertItemCate( $dataInsert );
			$mess['checklist_category_id'] = $id;
		}
		die (json_encode( $mess ));
	}
	
	public function updateCate(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$data = $this->input->post();			
			$dataUpdate = array();
			$this->checklist_model->checklist_category_id = $data['id'];
			$dataUpdate['checklist_category'] = $data['checklist_category'];
			$id = $this->checklist_model->updateItemCate( $dataUpdate );
		}
		die (json_encode( $mess ));
	}
	
	public function checklistuser(){
		
		$userLogin = $this->_data['user_data'];
		if( $userLogin->role_id > 5 ){ //chi co Admin & CEO, Top manager, 5=>manager duoc vào
			redirect(admin_url('index.html'));
		}
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['checklist_user'];
		
		$where = ' Where a.manager_id > 0 AND checklist_category != "" AND parent_category_id = 0 ';
		if( $userLogin->role_id == 5 ){//nhom manager thi chi lay nhung phong ban tuoc manager do
			$where .= ' AND a.manager_id = ' . $userLogin->user_id;
		}
        
        $hospital_id = (int)$this->input->get('hospital_id');
        if( $hospital_id > 0 ){
            $where .= " AND b.hospital_id = $hospital_id";
        }
        
		$cond = '';
		$more_url = '';
		$totalItems  = $this->checklist_model->getallCate( $where , '', '', 1); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('checklist-user.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		
		$list = $this->checklist_model->getallCate($where, $per_page, $start); 
		$dataList = array();
		if( $list )
		foreach ( $list as $item ) {
			$item->staff = array();
			$cond = ' Where a.checklist_category_id = ' . (int)$item->checklist_category_id;
			$staff = $this->checklist_model->getallCateUser($cond); 
			if( $staff )
			$item->staff = $staff;
			$item->count_staff = count($staff);
			$dataList[] = $item;
		}
		$this->_data['list'] = $dataList; 
        $this->_data['hospitalData'] = $this->hospital_model->getItems();
		$this->_data['content'] = 'checklist/checklist-user';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function adduserchecklist(){
		
		$userLogin = $this->_data['user_data'];
		if( $userLogin->role_id > 5 ){ //chi co Admin & CEO, Top manager, 5=>manager duoc vào
			redirect(admin_url('index.html'));
		}
		
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['add_staff_checklist'];
		
		$item = new stdClass();
		$item->checklist_category_id = (int)$this->input->get('id');
		$data['user_id'] = array();
		
		$this->load->library('form_validation');
		///$this->form_validation->set_rules('data[user_id][]', $this->lable['staff_required'],'required');
		///$this->form_validation->set_rules('data[checklist_category_id]', $this->lable['checklist_category_id_required'],'required');
		
		$this->form_validation->set_rules('data[user_id][]', '', 'required', array('required' => $this->lable['staff_required']));
		$this->form_validation->set_rules('data[checklist_category_id]', '', 'required', array('required' => $this->lable['checklist_category_id_required']));
		
		
		if( $this->input->post() ){
			$data = $this->input->post('data');
			if($this->form_validation->run()){

				$idCate = $data['checklist_category_id'];
				$this->checklist_model->checklist_category_id = $idCate;
				$this->checklist_model->removeItemCateUsers();
				if( isset( $data['user_id'] ) )//kiem tra nau khg chon se sinh ra loi
				foreach ( $data['user_id'] as $v ) {
					$dataInsert = array();
					$dataInsert['checklist_category_id'] = $idCate;
					$dataInsert['user_id'] = $v;
					$id = $this->checklist_model->insertItemCateU( $dataInsert );
				}
				
				redirect(admin_url('checklist-user.html')); 
			}
		}
						
		
		$where = ' Where b.role_id = 6 AND b.avail = 1 AND a.avail = 1 AND a.user_id NOT IN(SELECT user_id FROM ' . $this->checklist_model->table_che_cate_u . ') OR(d.checklist_category_id = ' . $item->checklist_category_id . ') ';//chi lay nhung user co role_id = 6 la role Staff
		///$where = ' Where b.role_id = 6 AND b.avail = 1 ';//chi lay nhung user co role_id = 6 la role Staff
		if( $userLogin->role_id == 5 ){
			$where .= ' AND a.manager_id = ' . $userLogin->user_id;
		}
		$listUser = $this->checklist_model->getUserStaff( $where ); 
		
		$where = ' Where a.manager_id > 0 AND checklist_category != "" AND parent_category_id = 0 ';
		if( $userLogin->role_id == 5 ){//nhom manager thi chi lay nhung phong ban tuoc manager do
			$where .= ' AND a.manager_id = ' . $userLogin->user_id;
		}		
		$checklist_category  = $this->checklist_model->getallCate( $where ); 
		
		if( !$this->input->post() ){
			$where = ' Where a.checklist_category_id = ' . (int)$item->checklist_category_id;
			$CateUser  = $this->checklist_model->getallCateUser( $where );
			$user_idArr = array();
			foreach( $CateUser as $item ){
				$user_idArr[] = $item->user_id;
			}
		}
		else {
			$user_idArr[] = (isset($data['user_id'])) ? $data['user_id'] : array();
		}

		$this->_data['listStaff'] = $listUser;
		$this->_data['listCates'] = $checklist_category;
		$item->user_idArr = $user_idArr;
		$this->_data['data'] = $item; 
		$this->_data['content'] = 'checklist/add-user-checklist';
	
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function delchecklistofstaff(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$userLogin = $this->_data['user_data'];
			if( $userLogin->role_id <= 5 ){ //chi co Admin & CEO, Top manager, 5=>manager duoc vào
				$data = $this->input->post();
				$this->checklist_model->checklist_category_id = (int)$data['id'];
				$id = $this->checklist_model->removeItemCateUsers();
				$mess['not_error'] = $id;
			}
		}
		die (json_encode( $mess ));
	}
	
	public function delchecklist(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$userLogin = $this->_data['user_data'];
			if( $userLogin->role_id <= 5 ){ //chi co Admin & CEO, Top manager, 5=>manager duoc vào
				$data = $this->input->post();
				$this->checklist_model->checklist_category_id = (int)$data['id'];
				$id = $this->checklist_model->removeItemChecklistCate();
				$mess['not_error'] = $id;
			}
		}
		die (json_encode( $mess ));
	}
	
}