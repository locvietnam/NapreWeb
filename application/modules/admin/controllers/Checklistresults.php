<?php
/**
* Controllers Backend login
* Last update 23 June 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 23 June 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checklistresults extends MY_Controller{
	
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
		
		//lchung add
		$this->_data['path_upload'] = $this->config->item('path_upload');
		$this->load->model('department_model');
		$this->load->model('users_model');
		$this->load->model('usermanagerdept_model');
		$this->load->model('userassigndept_model');
		$this->load->model('checklistresults_model');
		$this->load->model('checklist_model');	
        $this->load->model('hospital_model');
        $this->load->model('submit_model');
        $this->load->model('submitchecklist_model');
	}
	
    public function index_bak(){
            
	   /// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['checklist_results_title'];
		$finddate = ( $this->input->get('finddate') != '' ) ? $this->input->get('finddate') : date('Y-m-d');
		       
        $department_id  = (int)$this->input->get('department_id');
        $hospital_id    = (int)$this->input->get('hospital_id');
        $yearValue      = (int)$this->input->get('year');
        $monthValue     = $this->input->get('month');
        $dayValue     = $this->input->get('day');
        if(!isset($_GET['day'])){
            $dayValue     = date('d');
        }
        if( $monthValue == '' )
            $monthValue = date('m');
		
		$userLoging = $this->_data['user_data'];
		if( $userLoging->role_id == 5 ){//la nhom manager moi duoc update manager_viewed of table pp_submit
			$d_user = $this->userassigndept_model->getAll( "Where a.avail = 1 AND b.manager_id = " . $userLoging->user_id );
			foreach ( $d_user as $u ) {
				$dataUpdate['manager_viewed'] = 1;
				$this->checklistresults_model->db->update( 
					$this->checklistresults_model->table, $dataUpdate, array( 'user_id' => $u['user_id'], 'manager_viewed' => '0' )
				); 
			}
		}
        //echo date("Y-m-d", strtotime( $yearValue . "-" . $monthValue . "-01"));
		$maxDays =  date('t', strtotime( $yearValue . "-" . $monthValue . "-01"));
		$data = array();
		$dataChecklist = array();
		$submitChecklist = array();
		$maxUser = 0;
        
        $where = " Where a.user_id ";
        $whereSub= " Where b.submit_id = smc.submit_id ";
        $is_whereMonth = 0;
        if( $monthValue != '' && $dayValue != '' ){
            $finddate = $yearValue . '-' . $monthValue . '-' . $dayValue;
            $where .= " AND DATE(b.date_add) = DATE('" . $finddate . "') ";
            $whereSub .= " AND  DATE(b.date_add) = DATE('" . $finddate . "') ";
            $this->checklistresults_model->finddate = $finddate;
            $this->checklistresults_model->where_finddate_month = '';
        }
        
        if( $monthValue != '' && $dayValue == '' ){
            $where .= " AND YEAR (b.`date_add`) = '$yearValue' AND MONTH(b.`date_add`) = '$monthValue' ";		
            $whereSub .= " AND  YEAR (b.`date_add`) = '$yearValue' AND MONTH(b.`date_add`) = '$monthValue' ";
            $this->checklistresults_model->finddate = '';
            $this->checklistresults_model->where_finddate_month = "YEAR (`date_add`) = '$yearValue' AND MONTH(`date_add`) = '$monthValue'";
            $is_whereMonth = 1;
            $finddate = $yearValue . '-' . $monthValue;
        }        
        $where_manager_id = " AND c.manager_id = " . (int)$userLoging->user_id;
		if( $userLoging->role_id >= 5 ){
			$where .= $where_manager_id;
			$whereSub .= $where_manager_id;
		}
        if( $department_id > 0 ){
            $where .= " AND c.department_id = $department_id ";
        }
        if( $hospital_id > 0 ){
            $where .= " AND d.hospital_id = $hospital_id ";
        }
        //echo $finddate;die;
		$list = $this->checklistresults_model->getDepartmentOfChecklistCategory( $where, $whereSub );		
		foreach ( $list as $item ) {
			$item->fdate_add = date('d/m/Y', strtotime($item->date_add));
			$inUser_id = array();
			$inSubmit_id = array();
			$where = " Where c.submit_id = $item->submit_id AND a.checklist_category_id = $item->checklist_category_id AND DATE(c.date_add) = DATE('" . $finddate . "')";
			if($is_whereMonth){
                $where = " Where c.submit_id = $item->submit_id AND a.checklist_category_id = $item->checklist_category_id AND YEAR (c.`date_add`) = '$yearValue' AND MONTH(c.`date_add`) = '$monthValue' ";
            }
            $user = $this->checklistresults_model->getChecklistCategoryUsers( $where );
			///print_r( $user );
			$cUser = count( $user );
			$item->users = $user;
			$item->situation = 1;
			$checkListCate = $this->checklistresults_model->getItemCheckListCate(" Where a.checklist_category_id = $item->checklist_category_id AND avail = 1 ");
			$item->checklist_category = '';
			if( !empty( $checkListCate ) ){
				if( $checkListCate['parent_category_id'] == 0 ){
					$item->checklist_category = $checkListCate['checklist_category'];
				} else {
					$checklist_category_id = (int)$checkListCate['parent_category_id'];
					$checkListCate = $this->checklistresults_model->getItemCheckListCate(" Where a.checklist_category_id = $checklist_category_id AND avail = 1 ");
					$item->checklist_category = $checkListCate['checklist_category'];
				}
			}
			
			/*if( $cUser == 0 ){
				$item->situation = 0;//chua hoan thanh cong viec
			}*/
			
			if( $maxUser < $cUser ){
				$maxUser = $cUser;
			}
			//situation (tình hình công việc)
			//print_r( $user );die;
			foreach ( $user as $u ) {
				 $inUser_id[] = $u['user_id'];
			}
			
			$checklistOfUser = array();
			$submitChecklistOfUser = array();
			if( !empty( $inUser_id ) ){ //kiem tra tinh hinh cong viec hoan thanh hay chua
				//lay tất cả Submit checklist của user
				$checklist_category_id = array();
				$where = " Where c.user_id IN(" . implode(",", $inUser_id) . ") AND DATE(c.date_add) = DATE('" . $finddate . "') ";
                if($is_whereMonth){
                    $where = " Where c.user_id IN(" . implode(",", $inUser_id) . ") AND YEAR (c.`date_add`) = '$yearValue' AND MONTH(c.`date_add`) = '$monthValue' ";
                }
				$Submitd = $this->checklistresults_model->getStatusSituation( $where );
				$cSubmitd = count( $Submitd );
				$item->submit_checklist_of_user = $cSubmitd;
				if( $item->checklist_of_user >  $cSubmitd ){//neu tong so checklist_of_user > hon nhung user submit thi la chua hoan thanh khg can phai foreach phia duoi nua
					$item->situation = 0;//chua hoan thanh cong viec
				}
				else {//truong hop con user submit het nhung kiem tra tinh trang hoan thanh chua
					foreach( $Submitd as $v ){
						if( $v->checklist_checked == 0 ){
							$item->situation = 0;//chua hoan thanh cong viec
							//break;
						}
					}
				}
			}
			else {//chua co user nào submit cong viec
				$item->situation = 0;//chua hoan thanh cong viec
			}
			
			if( $cUser > 0 ) {
				$data[] = $item;
			}
		}
		//die;
		
        
        $yearData = array();
        $strY = '';
        $y = date('Y');
        $yE = $y - 9;//10 nam
        for( $i = $y; $i >= $yE; $i--){
            $selected = '';
            if( $yearValue == $i ){
                $selected = 'selected';
            }
            $strY .= '<option ' . $selected . ' value="' . $i . '">' . $i . '</option>';
        }
        
        $strM = '';        
        for( $i = 1; $i <= 12; $i++){
            $selected = '';
            $iStr = ($i < 10 ) ? '0' . $i : $i;            
            if( $monthValue == $iStr ){
                $selected = 'selected';
            }            
            $strM .= '<option ' . $selected . ' value="' . $iStr . '">' . $iStr . '</option>';
        }
        
        $strD = '<option value="">---</option>';         
        for( $i = 1; $i <= $maxDays; $i++ ){
            $selected = '';
            $iStr = ($i < 10 ) ? '0' . $i : $i;            
            if( $dayValue == $iStr ){
                $selected = 'selected';
            }            
            $strD .= '<option ' . $selected . ' value="' . $iStr . '">' . $iStr . '</option>';
        }
        $this->_data['dayData'] = $strD;
        $this->_data['yearData'] = $strY;
        $this->_data['monthData'] = $strM;
        $this->_data['finddate'] = $finddate;
		$this->_data['maxUser'] = $maxUser;
		$this->_data['list'] = $data;
        $this->_data['hospitalData'] = $this->hospital_model->getItems();
        $departmentData = array();        
        if( $hospital_id != '' ) {
            $cond = " Where a.hospital_id = $hospital_id ";
            $departmentData = $this->department_model->getAll($cond);  
        }
        $this->_data['departmentData'] = $departmentData;
		
		$this->_data['content'] = 'checklistresults/index';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
    
	public function index(){
            
	   /// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['checklist_results_title'];
		$finddate = ( $this->input->get('finddate') != '' ) ? $this->input->get('finddate') : date('Y-m-d');
		       
        $department_id  = (int)$this->input->get('department_id');
        $hospital_id    = (int)$this->input->get('hospital_id');
        $yearValue      = (int)$this->input->get('year');
        $monthValue     = $this->input->get('month');
        $dayValue     = $this->input->get('day');
        if(!isset($_GET['day'])){
            $dayValue     = date('d');
        }
        if(!isset($_GET['year'])){
            $yearValue     = date('Y');
        }
        if(!isset($_GET['month'])){
            $monthValue     = date('m');
        }
        if( $monthValue == '' )
            $monthValue = date('m');
		
		$userLoging = $this->_data['user_data'];
		if( $userLoging->role_id == 5 ){//la nhom manager moi duoc update manager_viewed of table pp_submit
			$d_user = $this->userassigndept_model->getAll( "Where a.avail = 1 AND b.manager_id = " . $userLoging->user_id );
			foreach ( $d_user as $u ) {
				$dataUpdate['manager_viewed'] = 1;
				$this->checklistresults_model->db->update( 
					$this->checklistresults_model->table, $dataUpdate, array( 'user_id' => $u['user_id'], 'manager_viewed' => '0' )
				); 
			}
		}
        //echo date("Y-m-d", strtotime( $yearValue . "-" . $monthValue . "-01"));
		$maxDays =  date('t', strtotime( $yearValue . "-" . $monthValue . "-01"));
		$data = array();
		$dataChecklist = array();
		$submitChecklist = array();
		$maxUser = 0;
        
        $where = " Where a.checklist_category_id > 0 ";          
        $where_manager_id = " AND c.manager_id = " . (int)$userLoging->user_id;
		if( $userLoging->role_id >= 5 ){
			$where .= $where_manager_id;
		}
        if( $department_id > 0 ){
            $where .= " AND c.department_id = $department_id ";
        }
        if( $hospital_id > 0 ){
            $where .= " AND d.hospital_id = $hospital_id ";
        }
        //echo $finddate;die;
        
        $iday = 1;
        $staff_id     = (int)$this->input->get('staff_id');        
        if($dayValue != '' ) {
            $finddate = $yearValue . "-" . $monthValue . "-" . $dayValue;
        }
        
        if($dayValue > 0 ){
            $iday = $dayValue;
            $maxDays = $dayValue;
        }
		$list = $this->checklistresults_model->getDepartmentOfChecklistCategory( $where );
        $dataList = array();
        for($i = $iday; $i<=$maxDays; $i++){
            $d = ($i >= 10 ) ? $i : '0' . (int)$i;
            $finddates = $yearValue . '-' . $monthValue . '-' . $d;
            foreach ( $list as $item ){
                $item['submit_checklist_of_user'] = 0;
                $checklist_category_id = $item['checklist_category_id'];
                
                $sql ="SELECT count(cl.checklist_id) as total
			 	FROM pp_checklist as cl WHERE cl.parent_category_id  = $checklist_category_id
				GROUP BY cl.parent_category_id";
                
                $item['checklist_of_user'] = $this->db->query($sql)->row()->total;;
                $item['fdate_add'] = date('d/m/Y', strtotime($finddates));
                $item['finddates'] = $finddates;
                $inUser_id = array();
                $inSubmit_id = array();
                
                $where = " Where a.checklist_category_id = $checklist_category_id AND DATE(c.date_add) = DATE('" . $finddates . "')";                
                $user = $this->checklistresults_model->getChecklistCategoryUsers( $where );
                //print_r( $user );
                //echo"\n";
                $cUser = count( $user );
                $item['users'] = $user;
                $item['situation'] = 0;
                $checkListCate = $this->checklistresults_model->getItemCheckListCate(" Where a.checklist_category_id = $checklist_category_id AND avail = 1 ");
                $item['checklist_category'] = '';
                if( !empty( $checkListCate ) ){
                    if( $checkListCate['parent_category_id'] == 0 ){
                        $item['checklist_category'] = $checkListCate['checklist_category'];
                    } else {
                        $checklist_category_idS = (int)$checkListCate['parent_category_id'];
                        $checkListCate = $this->checklistresults_model->getItemCheckListCate(" Where a.checklist_category_id = $checklist_category_idS AND avail = 1 ");
                        $item['checklist_category'] = $checkListCate['checklist_category'];
                    }
                }    
                
                foreach ( $user as $u ) {
                     $inUser_id[] = $u['user_id'];
                }
                $checklistOfUser = array();
                $submitChecklistOfUser = array();
                $cSubmitd = 0;
                if( !empty( $inUser_id ) ){ //kiem tra tinh hinh cong viec hoan thanh hay chua
                    //lay tất cả Submit checklist của user
                    //$checklist_category_id = array();
                    $where = " Where c.user_id IN(" . implode(",", $inUser_id) . ") AND DATE(c.date_add) = DATE('" . $finddates . "') ";                    
                    $Submitd = $this->checklistresults_model->getStatusSituation( $where );
                    $cSubmitd = count( $Submitd );
                    $item['submit_checklist_of_user'] = $cSubmitd;
                    if( $item['checklist_of_user'] ==  $cSubmitd ){//neu tong so checklist_of_user > hon nhung user submit thi la chua hoan thanh khg can phai foreach phia duoi nua
                        $t = 1;
                        foreach( $Submitd as $v ){
                            if( $v->checklist_checked == 0 ){
                                $item['situation'] = 0;//chua hoan thanh cong viec
                                $t = 0;
                            }
                        }
                        if($t && $cSubmitd > 0 ){
                            $item['situation'] = 1;//da hoan thanh cong viec
                        }
                    }
                } 
                else{//truong hop con user submit het nhung kiem tra tinh trang hoan thanh chua
                    $item['situation'] = 0;//chua hoan thanh cong viec
                    
                }
                $data[] = $item;
            }//End foreach;            
        }
        
        $yearData = array();
        $strY = '';
        $y = date('Y');
        $yE = $y - 9;//10 nam
        for( $i = $y; $i >= $yE; $i--){
            $selected = '';
            if( $yearValue == $i ){
                $selected = 'selected';
            }
            $strY .= '<option ' . $selected . ' value="' . $i . '">' . $i . '</option>';
        }
        
        $strM = '';        
        for( $i = 1; $i <= 12; $i++){
            $selected = '';
            $iStr = ($i < 10 ) ? '0' . $i : $i;            
            if( $monthValue == $iStr ){
                $selected = 'selected';
            }            
            $strM .= '<option ' . $selected . ' value="' . $iStr . '">' . $iStr . '</option>';
        }
        
        $strD = '<option value="">---</option>';         
        $maxDayNow =  date('t', strtotime( $yearValue . "-" . $monthValue . "-01"));        
        for( $i = 1; $i <= $maxDayNow; $i++ ){
            $selected = '';
            $iStr = ($i < 10 ) ? '0' . $i : $i;            
            if( $dayValue == $iStr ){
                $selected = 'selected';
            }            
            $strD .= '<option ' . $selected . ' value="' . $iStr . '">' . $iStr . '</option>';
        }
        $this->_data['dayData'] = $strD;
        $this->_data['yearData'] = $strY;
        $this->_data['monthData'] = $strM;
        $this->_data['finddate'] = $finddate;
		//$this->_data['maxUser'] = $maxUser;
		$this->_data['list'] = $data;
        $this->_data['hospitalData'] = $this->hospital_model->getItems();
        $departmentData = array();        
        if( $hospital_id != '' ) {
            $cond = " Where a.hospital_id = $hospital_id ";
            $departmentData = $this->department_model->getAll($cond);  
        }
        $this->_data['departmentData'] = $departmentData;
		
		$this->_data['content'] = 'checklistresults/index';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	///$cond = 
			///$d = $this->checklistresults_model->getChecklistCateSub();
	
    public function rsnew(){
        
        /// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['checklist_results_title'];
		$finddate = ( $this->input->get('finddate') != '' ) ? $this->input->get('finddate') : date('Y-m-d');
		       
        $department_id  = (int)$this->input->get('department_id');
        $hospital_id    = (int)$this->input->get('hospital_id');
        $yearValue      = ((int)$this->input->get('year')) ? $this->input->get('year') : date('Y');
        $monthValue     = ($this->input->get('month')) ? $this->input->get('month') : date('m');
        $dayValue     = (!isset($_GET['day'])) ? date('d') : $this->input->get('day');//) ? $this->input->get('day') : date('d');
        $iday = 1;
        $staff_id     = (int)$this->input->get('staff_id');        
        $is_whereMonth = 0;
        if( $monthValue != '' && $dayValue == '' ){
            $is_whereMonth = 1;
        }
        elseif($dayValue != '' ) {
            $finddate = $yearValue . "-" . $monthValue . "-" . $dayValue;
        }
        
        if( $monthValue == '' )
            $monthValue = date('m');
        
        $maxDays =  date('t', strtotime( $yearValue . "-" . $monthValue . "-01"));
        if($dayValue > 0 ){
            $iday = $dayValue;
            $maxDays = $dayValue;
        }
		$data = array();
		$dataChecklist = array();
		$submitChecklist = array();
		$maxUser = 0;
		
		$userLoging = $this->_data['user_data'];
		if( $userLoging->role_id == 5 ){//la nhom manager moi duoc update manager_viewed of table pp_submit
			$d_user = $this->userassigndept_model->getAll( "Where a.avail = 1 AND b.manager_id = " . $userLoging->user_id );
			foreach ( $d_user as $u ) {
				$dataUpdate['manager_viewed'] = 1;
				$this->checklistresults_model->db->update( 
					$this->checklistresults_model->table, $dataUpdate, array( 'user_id' => $u['user_id'], 'manager_viewed' => '0' )
				); 
			}
		}
        
        $sql = "SELECT 
                cc.parent_category_id,
                cc.checklist_category_id,
                cc.checklist_category as title,
                u.user_id,
                u.user_fullname,
                ( 
				SELECT count(cl.checklist_id) 
                    FROM pp_checklist as cl WHERE 
                    cl.checklist_category_id = cc.checklist_category_id GROUP BY cl.checklist_category_id
                ) as checklist_of_user
                FROM `pp_checklist_category` AS cc 
                INNER JOIN `pp_checklist_category_users` AS cu ON cu.checklist_category_id = cc.parent_category_id 
                INNER JOIN `pp_user` AS u ON u.user_id = cu.user_id 
                WHERE cc.department_id > 0 ";  
        if((int)$staff_id > 0 )
            $sql .= " AND cu.user_id = $staff_id ";
        if((int)$department_id > 0 )
        $sql .= " AND cc.department_id = $department_id ";
        
        //echo $sql;
        //die;
        $query = $this->db->query($sql);
        $dataCu = $query->result_array();
        //die;
        for($i = $iday; $i<=$maxDays; $i++){
            $d = ($i >= 10 ) ? $i : '0' . (int)$i;
            $finddates = $yearValue . '-' . $monthValue . '-' . $d;    
            //echo $finddates."\n";
            foreach ( $dataCu as $item ){
                $checklist_category_id = $item['checklist_category_id'];
                $user_id = $item['user_id'];
                $item['situation'] = 0;
                $item['fdate_add'] = date('Y月m月d日', strtotime( $finddates ) );
                $sqlSub = "SELECT 
                            s.submit_id, s.emotion_icon, COUNT(s.submit_id) as is_submit,
                            DATE_FORMAT(s.date_add,'%d/%m/%Y') AS sfdate_add,
                            s.date_add
                            FROM `pp_submit` AS s 
                            INNER JOIN `pp_submit_checklist` AS sc ON s.submit_id = sc.submit_id
                            INNER JOIN `pp_checklist` AS c ON c.checklist_id = sc.checklist_id
                            WHERE 
                            c.`checklist_category_id` = $checklist_category_id  
                            AND
                            s.`user_id` = $user_id
                            AND
                            DATE(s.`date_add`) = DATE('$finddates')
                            GROUP BY  s.submit_id";

                $querySub = $this->db->query($sqlSub);
                $dataSub = $querySub->result();
                
                
                //lay tất cả Submit checklist của user
				$where = " Where b.checklist_category_id =$checklist_category_id AND c.user_id = $user_id AND DATE(c.date_add) = DATE('" . $finddates . "') ";
				$Submitd = $this->checklistresults_model->getStatusSituation( $where );
				$cSubmitd = count( $Submitd );
				$item['submit_checklist_of_user'] = $cSubmitd;
				if( $item['checklist_of_user'] ==  $cSubmitd ){//neu tong so checklist_of_user > hon nhung user submit thi la chua hoan thanh khg can phai foreach phia duoi nua
					$t = 1;
                    foreach( $Submitd as $v ){
						if( $v->checklist_checked == 0 ){
							$item['situation'] = 0;//chua hoan thanh cong viec
							$t = 0;
						}
					}
                    if($t){
                        $item['situation'] = 1;//da hoan thanh cong viec
                    }
				}
				else {//truong hop con user submit het nhung kiem tra tinh trang hoan thanh chua
					$item['situation'] = 0;//chua hoan thanh cong viec
				}
                //print_r($item);die;
                //print_r( $dataSub );
                if( $dataSub ){
                    $item['submit_id'] = $dataSub[0]->submit_id;
                    $item['emotion_icon'] = $dataSub[0]->emotion_icon;
                    $item['is_submit'] = 1;
                    $item['date_add'] = $dataSub[0]->date_add;
                    $strTotime = strtotime($dataSub[0]->date_add);
                    $item['fdate_add'] = date('Y月m月d日', $strTotime);// . '月' . date('m', $strTotime) . '月'. date('d', $strTotime) . '日';
                
                    $submit_id = $dataSub[0]->submit_id;
                    $s = "SELECT COUNT(scm.submit_id) as is_comment FROM `pp_submit_comments` AS scm 
                            WHERE scm.submit_id = $submit_id  GROUP BY scm.submit_id";
                    $queryS = $this->db->query($s);
                    $dataS = $queryS->result();                
                    if( $dataS ){
                        $item['is_comment'] = $dataS[0]->is_comment;
                    }
                    else {
                        $item['is_comment'] = 0;
                    }
                }
                else {
                    $item['submit_id'] = 0;
                    $item['emotion_icon'] = 0;
                    $item['is_submit'] = 0;
                    $item['date_add'] = '';                    
                    $item['is_comment'] = 0;
                }
                
                $item['finddates'] = $finddates;
                $data[] = $item;
            }//End foreach
        }//End for day fo month
        ///print_r( $data );
        //die;
        $yearData = array();
        $strY = '';
        $y = date('Y');
        $yE = $y - 9;//10 nam
        for( $i = $y; $i >= $yE; $i--){
            $selected = '';
            if( $yearValue == $i ){
                $selected = 'selected';
            }
            $strY .= '<option ' . $selected . ' value="' . $i . '">' . $i . '</option>';
        }
        
        $strM = '';        
        for( $i = 1; $i <= 12; $i++){
            $selected = '';
            $iStr = ($i < 10 ) ? '0' . $i : $i;            
            if( $monthValue == $iStr ){
                $selected = 'selected';
            }            
            $strM .= '<option ' . $selected . ' value="' . $iStr . '">' . $iStr . '</option>';
        }
        
        $strD = '<option value="">---</option>'; 
        $maxDayNow =  date('t', strtotime( $yearValue . "-" . $monthValue . "-01"));        
        for( $i = 1; $i <= $maxDayNow; $i++ ){
            $selected = '';
            $iStr = ($i < 10 ) ? '0' . $i : $i;            
            if( $dayValue == $iStr ){
                $selected = 'selected';
            }            
            $strD .= '<option ' . $selected . ' value="' . $iStr . '">' . $iStr . '</option>';
        }
        $this->_data['dayData'] = $strD;
        $this->_data['yearData'] = $strY;
        $this->_data['monthData'] = $strM;
        $this->_data['finddate'] = $finddate;
		$this->_data['is_whereMonth'] = $is_whereMonth;
        
        $cond = " Where a.role_id = 6 "; 
        if( $department_id > 0 ){
            $cond .= " AND b.department_id = $department_id"; 
        }
        $datastaff = $this->users_model->getAll($cond);
        $this->_data['datastaff'] = $datastaff;
		$this->_data['list'] = $data;
        $this->_data['hospitalData'] = $this->hospital_model->getItems();
        $departmentData = array();        
        if( $hospital_id > 0 ) {
            $cond = " Where a.hospital_id = $hospital_id ";
            $departmentData = $this->department_model->getAll($cond);  
        }
        $this->_data['departmentData'] = $departmentData;
		
		$this->_data['content'] = 'checklistresults/rsnew';
		$this->parser->parse("layout/index.tpl", $this->_data);
        
    }
	
    public function updateresultchecklist(){
        
        $this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['update_result_checklist_title'];
		$finddate = $this->input->get('date');
        $checklistid  = (int)$this->input->get('checklistid');
        
        $this->_data['date_add'] = date('Y/m/d');
        
        $this->_data['content'] = 'checklistresults/update-result-checklist';
		$this->parser->parse("layout/index.tpl", $this->_data);
    }
    
    public function getuserAjax(){
        
        $department_id  = (int)$this->input->get('department_id');               
        $userData = array();
        if( $department_id >0 ) {
            $cond = " Where a.role_id = 6 AND b.department_id = $department_id"; 
            $userData = $this->users_model->getAll($cond);  
        }
        $str = "";
        foreach( $userData as $item ){
           $str .= '<option value="' . $item->user_id . '">' . $item->user_fullname . '</option>'; 
        }        
        echo json_encode( array('data' => $str ) );
        die;
        
    }
    
    public function delete(){
        
        if( $this->_data['user_data']->role_id <= 5 ){			
            $submitid  = (int)$this->input->get('submitid'); 
            if( $submitid > 0 ) {
                $this->db->delete('pp_submit_comments', array('submit_id' => $submitid) );
                $this->db->delete('pp_submit_checklist', array('submit_id' => $submitid) );
                $this->db->delete('pp_submit', array('submit_id' => $submitid) );        
            }
        }
        echo json_encode( array('data' => 1 ) );
        die;
    }
    
	public function listnotice(){
		$is_pudate = 1;
        if( $this->input->post() ){
            $data = $this->input->post('data');
            $submitid = (int)$data['submitid'];
            if( $submitid == 0 ){
                $is_pudate = 0;
                $dataInsert['user_id'] = $data['staffid'];
                $dataInsert['emotion_icon'] = $data['emoticon'];
                $dataInsert['manager_viewed'] = '0';
                $dataInsert['date_add'] = $data['date_add'] .' '. date('H:i:s');
                $submitid = $this->submit_model->insertItem($dataInsert);
                $submit_checklist_idArr = array();
                if( $data['submit_checklist_id'] != '')
                    $submit_checklist_idArr = explode(",", $data['submit_checklist_id'] );
                foreach( $submit_checklist_idArr as $v ){
                    $dataInsertS['submit_id'] = $submitid;
                    $dataInsertS['checklist_id'] = $v;
                    $dataInsertS['checklist_checked'] = '1';
                    $this->submitchecklist_model->insertItem($dataInsertS);
                }
            }
            else{//cap nhat  
                $is_pudate = 1;
                $this->submitchecklist_model->submit_id = $submitid;
                $dataUpdateS['checklist_checked'] = '0';
                $this->submitchecklist_model->updateItem($dataUpdateS, 0);                
                $submit_checklist_idArr = array();
                if( $data['submit_checklist_id'] != '')
                    $submit_checklist_idArr = explode(",", $data['submit_checklist_id'] );
                foreach( $submit_checklist_idArr as $v ){
                    $check = $this->submitchecklist_model->getById( $submitid, $v);
                    if( !$check ){//khg co thi insert new
                        $dataInsertS['submit_id'] = $submitid;
                        $dataInsertS['checklist_id'] = $v;
                        $dataInsertS['checklist_checked'] = '1';
                        $this->submitchecklist_model->insertItem($dataInsertS);
                    }
                    else {
                        $this->submitchecklist_model->checklist_id = $v;
                        $this->submitchecklist_model->submit_id = $submitid;
                        $dataUpS['checklist_checked'] = '1';
                        $this->submitchecklist_model->updateItem($dataUpS, 1);
                    }
                }                
            }
            if($is_pudate == 1){
                die('no_replace');
            }
            echo $submitid;
            die;
            die('listnotice OK');
        }
        
		$this->_data['title_page'] = $this->lable['list_notice'];
		$checklistcategoryid = $this->input->get('checklistcategoryid');
		$finddate = ( $this->input->get('finddate') != '' ) ? $this->input->get('finddate') : date('Y-m-d');
		$this->_data['finddate'] = $finddate;
		
		//lay cap tra
        $listArr = array();
        if(!empty($checklistcategoryid)) {
            $cond = ' WHERE checklist_category_id IN(' . $checklistcategoryid . ') AND parent_category_id = 0 ';
            $listArr = $this->checklist_model->getallCate( $cond );
        }
		$list = array();
		foreach ( $listArr as $itemP ) {
			
			$id1 = $itemP->checklist_category_id;
			$cond = 'Where a.parent_category_id = ' . $id1 . ' AND a.avail = 1 ';
			$listArrS = $this->checklist_model->getallCate( $cond );
			$itemP->subcate = array();			
			$list[$id1] = (array)$itemP;
			foreach ($listArrS as $item ) {
				$id2 = $item->checklist_category_id;
				$cond = ' WHERE a.checklist_category_id = ' . (int)$id2;
				///$cond .= " AND DATE(c.date_add) = DATE('" . $finddate . "') ";
				$item->checklist = $this->checklistresults_model->getStatusSituationListNotice( $cond, $finddate );
				$list[$id1]['subcate'][] = (array)$item;
			}
			//khi khg co parent_category_id thi lay theo duoi nay
			///$cond = ' WHERE a.checklist_category_id = ' . (int)$item->checklist_category_id;
			///$item->checklist = $this->checklistresults_model->getStatusSituationListNotice( $cond );
			///$list[] = (array)$item;
		}
		///print_r( $list );die;
		$this->_data['list'] = $list;
		$this->_data['content'] = 'checklistresults/list-notice';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
}