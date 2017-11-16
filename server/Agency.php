<?php
/**
* Controllers Backend login
* Last update 4 Jan 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 3 Jan 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agency extends MY_Controller{
	
	private $_data;
        private $_control; 
        private $_action;
        private $_pathLogo; 
        
	public function __construct(){
            parent::__construct();
            $this->load->model('Agency_model'); 
            $this->load->library('Slim_library'); 

            $this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];
            $this->_data['base_url']           = $this->config->item("base_url");
            $this->_data['base_tlp_admin']     = $this->config->item("base_tlp_admin");
            $this->_data['base_url_admin']     = $this->config->item("base_url_admin");
            $this->_data['lable']              = $this->lable;
            $this->_data['user_data']          = $this->session->userdata('login');
            
            $this->_control                 = $this->router->class;
            $this->_action                  = $this->router->method; 
            $this->_pathLogo                = $this->config->item('path_logo');
            $this->_data['current_control'] = $this->_control; 
            $this->_data['current_method']  = $this->_action; 

            $back_url = admin_url($this->_control.'/add');			
	}
        
	
	function index($start=0){
            $cond = ''; 
            $this->_data['breadcrumb'] = '';
            $this->_data['task']       = "List of agencies";
            $this->_data['alert']      = $this->session->flashdata('alert'); 
            $this->_data['msg']        = $this->session->flashdata('msg');
            
            //$get = http_build_query($_GET);
            $this->load->library('sortagency_library');
            
            $more_url = '';
            $page_more_url = '';
            $cond .= " AND a.avail = 1"; 
            $keyword = trim(strip_tags($this->input->get('keyword')));
            if($keyword){
                $cond .= " AND ( a.agency_sku LIKE '%$keyword%' OR a.agency_name LIKE '%$keyword%' )";
                $more_url .= "&keyword=$keyword";
                $page_more_url = "keyword=$keyword";
            }
            
            $this->_data['keyword'] = $keyword; 
            
            $params  = $this->input->get('sort'); 
            $params  = isset($params) ? $params : '';
            $order_by  = ''; 
            if($params){
                $order_by = $this->sortagency_library->mySort($params);
            }
            $this->_data['sort'] = $params;
            $this->_data['more_url'] = $more_url;
            
            $totalItems  = $this->Agency_model->countItems($cond); 
            $per_page    = $this->lable['per_item_admin']; 
            $base_url    = admin_url('agency/index'); 
            $uri_segment = 4;
            
            $this->load->library('pagination_library'); 
            $this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment); 
            $this->_data['links'] = $this->pagination->create_links(); 
            
            $curpage = $this->input->get('per_page');
            $offset = ($curpage) ? $curpage : 0;      
            $start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
            
            
            $items = $this->Agency_model->getItems($cond, $per_page, $start, $order_by);
            
            //pre($items); 
            $this->_data['action_url']         = admin_url($this->_control);
            $this->_data['action_pass']        = admin_url($this->_control.'/updatepass');
            $this->_data['action_send_letter'] = admin_url($this->_control.'/sendnewletter');
            $this->_data['items']              = $items; 
            
            $this->parser->parse("agency/index.tpl", $this->_data);
	}

        
        function outstanding($start=0){
            $cond = ''; 
            $this->_data['breadcrumb'] = '';
            $this->_data['task']       = "List of agencies";
            $this->_data['alert']      = $this->session->flashdata('alert'); 
            $this->_data['msg']        = $this->session->flashdata('msg');
            
            //$get = http_build_query($_GET);
            $this->load->library('sortagency_library');
            
            $more_url = '';
            $page_more_url = '';
            $cond .= " AND a.avail = 1 AND tp.isoutstanding = 1 "; 
            $keyword = trim(strip_tags($this->input->get('keyword')));
            if($keyword){
                $cond .= " AND ( a.agency_id LIKE '%$keyword%' OR a.agency_name LIKE '%$keyword%' )";
                $more_url .= "&keyword=$keyword";
                $page_more_url = "keyword=$keyword";
            }
            
            $this->_data['keyword'] = $keyword; 
            
            $params  = $this->input->get('sort'); 
            $params  = isset($params) ? $params : '';
            $order_by  = ''; 
            if($params){
                $order_by = $this->sortagency_library->mySort($params);
            }
            $this->_data['sort'] = $params;
            $this->_data['more_url'] = $more_url;
            
            $totalItems  = $this->Agency_model->countItems($cond); 
            $per_page    = $this->lable['per_item_admin']; 
            $base_url    = admin_url('agency/index'); 
            $uri_segment = 4;
            
            $this->load->library('pagination_library'); 
            $this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment); 
            $this->_data['links'] = $this->pagination->create_links(); 
            
            $curpage = $this->input->get('per_page');
            $offset = ($curpage) ? $curpage : 0;      
            $start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
            
            
            $items = $this->Agency_model->getItems($cond, $per_page, $start, $order_by);
            
            //pre($items); 
            $this->_data['action_url']         = admin_url($this->_control);
            $this->_data['action_pass']        = admin_url($this->_control.'/updatepass');
            $this->_data['action_send_letter'] = admin_url($this->_control.'/sendnewletter');
            $this->_data['items']              = $items; 
            
            $this->parser->parse("agency/index.tpl", $this->_data);
	}
        
        
        function add() {
            
            $option    = $this->input->get('option');
            $agency_id = $this->input->get('id'); 
            
            $agency_id = !empty($agency_id) ? $agency_id : -1; 
            $data      = $this->Agency_model->getInfoItemById($agency_id);
             
            $option = empty($option) ? 'add' : $option; 
            $listPakage = $this->Agency_model->getPackage(); 
            $this->_data['pathLogo']   = $this->_data['base_url'].$this->config->item('dir_logo');
            
            $this->_data['listPacke']  = $listPakage; 
            $this->_data['data']       = $data; 
            $this->_data['option']     = $option; 
            $this->_data['breadcrumb'] = '';
            $this->_data['task']       = "Add an agency";
            
            $this->_data['action_url']  = $this->config->item('base_url_admin').'/'.$this->_control.'/process';
            $this->_data['action_url1'] = $this->config->item('base_url_admin').'/'.$this->_control.'/add_brand'; 
            $this->_data['packageList'] =  $this->Agency_model->getBrands($agency_id);
            
            //delete list brand have egency_id = -1; 
            $where = array('agency_id'=>-1);
            $this->Agency_model->deleteBrand($where); 
            
            //load notifaction 
            $this->_data['alert'] = $this->session->flashdata('alert'); 
            $this->_data['msg']   = $this->session->flashdata('msg');
            
            
            $this->parser->parse("agency/add.tpl", $this->_data);
        }
        
        
        /**
         * Process add & Update
         */
        function process(){
			
            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
            
            $option    = $this->input->post('option'); 
            $agency_id = $this->input->post('primary'); 
            $old = $this->input->post('old');
            
            $option    = empty($option) ? 'add' : $option;
            if ($this->input->server('REQUEST_METHOD') == 'POST'){
                $_data = $this->input->post('data'); 
            }
            
            $year  = date('Y'); 
            $month = date('m'); 
            $day   = date('d'); 
            
            $file_path_year = $this->_pathLogo.'/'. $year;
            if (! file_exists($file_path_year)) { mkdir($file_path_year,0777, TRUE); }
			
            $file_path_month = $file_path_year .'/'.  $month;
            if (! file_exists($file_path_month)) { mkdir($file_path_month,0777, TRUE); }

            $file_path_day = $file_path_month .'/'.  $day ; 
            if (! file_exists($file_path_day)) { mkdir($file_path_day,0777, TRUE);}

            $new_path = $year.'/'.$month.'/'.$day.'/';
			
            $flag_logo_url  = 0;
            $flag_logo_home = 0;
            $flag_background_url = 0;
            
            $old_logo_url  = $this->slim_library->oldImageName($old['logo_url']);
            $old_logo_home = $this->slim_library->oldImageName($old['logo_home']);
            $old_background_url = $this->slim_library->oldImageName($old['background_url']);
            
            $inputNames = array('logo_url' ,'logo_home', 'background_url'); 
            //$inputNames = array('background_url'); 
            
            
            foreach($inputNames as $k => $inputName){ 
                $images    = $this->slim_library->getImages($inputName);
                $image     = $images[0];
                $new_img   = addslashes($image['output']['name']);
                $data      = $image['output']['data'];
                
                
                if($inputName == 'logo_url' && $new_img != $old_logo_url) { // check if not change image
                    $file  = $this->slim_library->saveFile($data, $new_img, $file_path_day);
                    $_data[$inputName] = $new_path.$file['name']; //$file['path']
                    $flag_logo_url = 1;
                }
                
                if($inputName == 'logo_home' && $new_img != $old_logo_home) { // check if not change image
                    $file  = $this->slim_library->saveFile($data, $new_img, $file_path_day);
                    $_data[$inputName] = $new_path.$file['name']; //$file['path']
                    $flag_logo_home = 1;
                }
                
                if($inputName == 'background_url' && $new_img != $old_background_url) { // check if not change image
                    $file  = $this->slim_library->saveFile($data, $new_img, $file_path_day);
                    $_data[$inputName] = $new_path.$file['name']; //$file['path']
                    $flag_background_url = 1;
                } 
                
                
            }
            
            
            $agency_data = array(
                'email'                  => $_data['email'], 
                'password'               => md5($_data['password']), 
                'agency_name'            => addslashes($_data['agency_name']),
		'slug'                	 => url_convert($_data['slug']),
                'website'                => $_data['website'],
                'contact_email'          => $_data['contact_email'],
                'phone'                  => trim($_data['phone']),
                'hotline'                => trim($_data['hotline']),
                'description'            => addslashes($_data['description']),
                'facebook'               => $_data['facebook'],
                'youtube'                => $_data['youtube'],
                'monthly_report_email_1' => $_data['monthly_report_email_1'],
                'monthly_report_email_2' => $_data['monthly_report_email_2'],
                'tax_number'             => $_data['tax_number'],
                'address_get_invoice'    => $_data['address_get_invoice'],
                'latitude'               => $_data['latitude'],
                'longtitude'             => $_data['longtitude'],
                'avail'                  => $_data['avail'],

            ); 
            
            /*
            'logo_url'      => $_data['logo_url'],
            'background_url'=> $_data['background_url'],
            */
            
            if($flag_logo_url == 1) {
                $agency_data['logo_url'] = $_data['logo_url'];
            }
            
             if($flag_logo_home == 1) {
                $agency_data['logo_home'] = $_data['logo_home'];
            }
            
            if($flag_background_url == 1) {
                $agency_data['background_url'] = $_data['background_url'];
            }
                
            $package_data = array(
               'package_id'    => $_data['package_id'],
               'expired_date'  => $_data['expired_date'],
               'isoutstanding' => empty($_data['isoutstanding']) ? 0 : $_data['isoutstanding'],
               'date_add'      => date('Y-m-d H:i:s'),
            ); 
            
            
            if($option=='edit' && $agency_id != ''){
                $status  = $this->Agency_model->updateAgency($agency_id, $agency_data, $package_data); 
                
                if($status){
                   
                    if($flag_logo_url) { @unlink($this->_pathLogo.'/'.$old['logo_url']); } 
                    if($flag_logo_home) { @unlink($this->_pathLogo.'/'.$old['logo_home']); } 
                    if($flag_background_url) { @unlink($this->_pathLogo.'/'.$old['background_url']); }
                   
                   $where = array('agency_id'=>-1);
                   $data_brand['agency_id'] = $status; 
                   $ok = $this->Agency_model->updateBrand($data_brand, $where);
                   $this->session->set_flashdata('alert','success');
                   $this->session->set_flashdata('msg', $this->lable['update_succ']);
                    
                } else {
                    $where = array('agency_id'=>-1);
                    $this->Agency_model->deleteBrand($where); 
                    $this->session->set_flashdata('msg', $this->lable['update_fail']);  
                    $this->_data['data'] = $_data;
                }
                
                redirect(admin_url($this->_control));
                
            } else {
                $status = $this->Agency_model->insertAgency($agency_data,$package_data);
                if($status){
                    
                    $where                   = array('agency_id'=>-1);
                    $data_brand['agency_id'] = $status; 
                    $ok                      = $this->Agency_model->updateBrand($data_brand, $where); 
                    $this->session->set_flashdata('alert','success');
                    $this->session->set_flashdata('msg', $this->lable['add_succ']);
                    
                } else {
                    $where = array('agency_id'=>-1);
                    $this->Agency_model->deleteBrand($where); 
                    $this->session->set_flashdata('msg', $this->lable['add_fail']);  
                    $this->_data['data'] = $_data; 
                }
                
                redirect(admin_url($this->_control.'/add')); 
            }
            
        }
        
        
        function add_brand(){
            
            $agency_id = $this->input->post('data[agency_id]');
            $agency_id = !empty($agency_id) ? $agency_id : -1 ; 
            $option    = $this->input->post('option'); 
            
            if ($this->input->server('REQUEST_METHOD') == 'POST'){
                $data = $this->input->post('data');
            }
            
            //pre($data); 
            
            
            if($option == 'edit'){
                $where = array('brand_id'=>$data['brand_id']);
                $ok = $this->Agency_model->updateBrand($data, $where);
                
            } else {
                
                $ok = $this->Agency_model->insertBrand($data); 
                
            }
            
            $this->_data['data']        = $data; 
            $this->_data['action_url1'] = $this->config->item('base_url_admin').'/'.$this->_control.'/add_brand'; 
            $this->_data['packageList'] =  $this->Agency_model->getBrands($agency_id); 
            
            if($ok){
                $this->parser->parse("agency/form_brand.tpl", $this->_data);
            }    
        }
        
        
        function dell_brand(){
            $agency_id = $this->input->post('egency_id'); 
            $agency_id = !empty($agency_id) ? $agency_id : -1 ; 
            $option    = $this->input->post('option'); 
            
            if ($this->input->server('REQUEST_METHOD') == 'POST'){
                $data = $this->input->post('data'); 
            }
            
            $where = array('brand_id'=>$data['brand_id']);
            
            $ok = $this->Agency_model->deleteBrand($where);
            
            $this->_data['data'] = $data; 
            $this->_data['action_url1'] = $this->config->item('base_url_admin').'/'.$this->_control.'/add_brand'; 
            $this->_data['packageList'] =  $this->Agency_model->getBrands($agency_id); 
            
            if($ok){
                $this->parser->parse("agency/form_brand.tpl", $this->_data);
            } 
        }
        
        
        /**
         * 
         */
        function checkEmailExist(){
            $data = $this->input->post();
            
            $exits = $this->Agency_model->checkEmailExist($data['email']);
            
            if($exits == FALSE){
                $arr = array(
                    'message' => $this->lable['email_exist'], 
                    'flag'   => 0, 
                ); 
                echo json_encode($arr);
            } elseif($data['test'] == 0) {
                $arr = array(
                    'message' => $this->lable['please_enter_valid_email'], 
                    'flag'   => 0, 
                ); 
                echo json_encode($arr);
            } else {
                $arr = array(
                    'message' => "<i class='blue'>".$this->lable['email_valid']."</i>", 
                    'flag'   => 1, 
                ); 
                echo json_encode($arr);
            }
        }
        
        
        function remove(){
            $agency_id = $this->input->get('id'); 
            $status    = $this->Agency_model->removeAgency($agency_id); 
            if($status){
                $this->session->set_flashdata('alert','success');
                $this->session->set_flashdata('msg', $this->lable['delete_succ']);
            } else {
                $this->session->set_flashdata('msg', $this->lable['delete_fail']); 
            }
            
            redirect(admin_url($this->_control));
            
        }
        
        
        function update(){
            $id     = $this->input->post('agency_id'); 
            $data   = array('avail'=>0); 
            $status = $this->Agency_model->updateAgency($id,$data );
            if($status){
                return TRUE;
            } else {
                return FALSE; 
            }   
            
        }
        
        
        function active(){
            $id     = $this->input->get('id'); 
            $data   = array('avail'=>1);
            $status = $this->Agency_model->updateAgency($id, $data); 
            if($status){
                $this->session->set_flashdata('alert', 'success'); 
                $this->session->set_flashdata('msg',$this->lable['update_succ']);
            } else {
                $this->session->set_flashdata('msg', $this->lable['update_fail']); 
            }
            
            redirect(admin_url($this->_control.'/listInactive'));
        }
        
        
        function listInactive($start=0){
            $cond = ''; 
            $this->_data['breadcrumb'] = '';
            $this->_data['task']       = "List of agencies";
            $this->_data['alert']      = $this->session->flashdata('alert'); 
            $this->_data['msg']        = $this->session->flashdata('msg');
            
            //$get = http_build_query($_GET);
            $this->load->library('sortagency_library');
            
            $more_url = '';
            
            $cond .= " AND a.avail = 0"; 
            $keyword = trim(strip_tags($this->input->get('keyword')));
            if($keyword){
                $cond .= " AND ( a.agency_id LIKE '%{$keyword}%' OR a.agency_name LIKE '%{$keyword}%' )";
                $more_url .= "&keyword=$keyword";
            }
            
            $this->_data['keyword'] = $keyword; 
            
            $params  = $this->input->get('sort'); 
            $params  = isset($params) ? $params : '';
            $order_by  = ''; 
            if($params){
                $order_by = $this->sortagency_library->mySort($params);
            }
            $this->_data['sort'] = $params;
            $this->_data['more_url'] = $more_url;
            
            $totalItems  = $this->Agency_model->countItems($cond); 
            $per_page    = $this->lable['per_item_admin']; 
            $base_url    = admin_url('agency/index'); 
            $uri_segment = 4;
            $this->load->library('pagination_library'); 
            $this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment); 
            $this->_data['links'] = $this->pagination->create_links(); 
            
            $items = $this->Agency_model->getItems($cond,$per_page,$start,$order_by);
            $this->_data['action_url']         = admin_url($this->_control);//$this->config->item('base_url_admin').'/'.$this->_control;
            $this->_data['action_pass']        = admin_url($this->_control.'/updatepass');//$this->config->item('base_url_admin').'/'.$this->_control.'/updatepass';
            $this->_data['action_send_letter'] = admin_url($this->_control.'/sendnewletter');//$this->config->item('base_url_admin').'/'.$this->_control.'/sendnewletter';
            $this->_data['items']              = $items; 
            
            $this->parser->parse("agency/index.tpl", $this->_data);
	}
        
        
        function updatePass(){
            $this->load->library('form_validation'); 
            $this->load->helper('form'); 
            if($this->input->post()){
                $data = $this->input->post('data'); 
                if($data['old_email'] != $data['email']){
                   $this->form_validation->set_rules('data[email]',$this->lable['email'], 'callback_check_email_exists'); 
                } else {
                   $this->form_validation->set_rules('data[email]',$this->lable['email'],'required');
                }
                if($this->form_validation->run()){
                    $agency_data = array(
                        'email' => $data['email'],
                        'password' => md5($data['password']),
                    ); 
                    $status = $this->Agency_model->updateAgency($data['agency_id'], $agency_data);
                    if($status){
                        $this->session->set_flashdata('alert', 'success'); 
                        $this->session->set_flashdata('msg', $this->lable['update_succ']);
                    } else {
                        $this->session->set_flashdata('msg', $this->lable['update_fail']); 
                    }
                    
                    redirect(admin_url($this->_control)); 
                }
            } 
        }
        
        
        function check_email_exists(){
            $data   = $this->input->post('data'); 
            $email  = $data['email']; 
            $exists = $this->Agency_model->checkEmailExist($data['email']);
            if($exists == FALSE){
                $this->session->set_flashdata('alert','danger'); 
                $this->session->set_flashdata('msg', $this->lable['email_exist']);
                redirect(admin_url($this->_control));
            }
            return TRUE; 
            
        }
        
        function checkOutstanding(){
            $data = $this->input->post(); 
            $flag = $data['flag'];
            $agency_id = $this->input->post('id'); 
            
            $cond = " AND a.agency_id = $agency_id "; 
            $checkId = $this->Agency_model->checkLableExist($cond);  
            if($checkId) return FALSE; 
            if($flag == 1){
                $count = $this->Agency_model->checkOutstanding(); 
                if($count >= 4){
                    echo 1;
                } else {
                    echo 0; 
                }
            }
            
        }
        
        /**
         *  export to excel 
         */
        function sendNewLetter(){
            
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Agency-".date('d-m-Y').".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            
            $agency_ids  = $this->input->post('data_items'); 
            $ids = implode(',', $agency_ids); 
            
            $cond = "WHERE FIND_IN_SET( agency_id, '$ids')";
            $items = $this->Agency_model->getInfoAgency($cond);
            $this->_data['items'] = $items; 
            $this->parser->parse("agency/sendnewletter.tpl", $this->_data);
            
        }
        
    

}