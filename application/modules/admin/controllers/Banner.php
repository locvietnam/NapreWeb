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

class Banner extends MY_Controller{
	
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
		$this->load->model('banner_model');
		//nhung nhom staff, manager, top manager khong duoc vào
		if( $this->_data['user_data']->role_id >= 4 ){
			redirect(admin_url('index.html'));
		}
		
	}
	
	public function index(){
            
		//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['manager_banner'];
		
		$more_url = '';
		$page_more_url = '';
		$cond = ""; 
		$keyword = trim(strip_tags($this->input->get('keyword')));
		
		if($keyword){
			$cond .= " Where title LIKE '%$keyword%' OR short_description LIKE '%$keyword%'";
			$more_url .= "&keyword=$keyword";
			$page_more_url = "keyword=$keyword";
		}
		
		$this->_data['keyword'] = $keyword;
		$this->_data['more_url'] = $more_url;
		
		$totalItems  = $this->banner_model->countItems($cond); 
		
		$per_page    = $this->lable['per_item_admin']; 
		$base_url    = admin_url('banner.html'); 
		$uri_segment = 4;
		
		$this->load->library('pagination_library'); 
		$this->pagination_library->pagination($base_url, $totalItems,$per_page,$uri_segment, $more_url); 
		$this->_data['links'] = $this->pagination->create_links(); 
		
		$curpage = $this->input->get('per_page');
		$offset = ($curpage) ? $curpage : 0;      
		$start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;
		$list = $this->banner_model->getItems($cond, $per_page, $start); 

		$this->_data['list'] = $list;
		$this->_data['path_upload'] = $this->config->item('path_upload');
		
		$this->_data['content'] = 'banner/index';
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function add(){
		$this->_data['task'] = '';
		$this->_data['breadcrumb'] = '';
		$this->_data['alert'] = '';
		$this->_data['title_page'] = $this->lable['add_banner'];
		
		$this->load->library('form_validation');
		$step = 1;
			
		$item = new stdClass();
		$item->tille = '';
		$item->id = 0;
		$item->short_description = '';
		$item->file_img = '';
		$id = (int)$this->input->get('id');
		$this->_data['error'] = '';
		if( $id > 0 ){
			$this->banner_model->id = $id;
			$item = $this->banner_model->getItemById();
		}
		if( $this->input->post() ){
			$data = $this->input->post('data');
			
			$this->form_validation->set_rules('data[tille]', $this->lable['banner_title_required'],'required');
			///$this->form_validation->set_rules('data[file_img]', $this->lable['banner_file_img_required'],'required');

			$item->tille = $data['tille'];					
			$item->short_description = $data['short_description'];
			///$item->file_img = $data['file_img'];
			
			//chech validate
			if($this->form_validation->run()){
				//print_r( $_FILES["file_img"] );die;
				$d = array();
				if( (int)$data['id'] > 0  && !$_FILES["file_img"]['error'] || (int)$data['id'] == 0 ) {
					$d = $this->do_upload();
				}
				///$d = $this->do_upload();
				//print_r( $d );die;
				if( isset( $d['error'] ) ){
					$this->_data['error'] = $d['error']; 
				}
				else {
					
					if( isset( $data['delete'] ) ) {
						$dataInsert['file_img'] = '';
						$path = $this->config->item('path_upload');
						if(file_exists( $path . "/" . $data['fileCurent'] )){
							unlink($path . "/" . $data['fileCurent']);
						}
					}
					if( !empty($d) ) {
						if( isset( $data['fileCurent'] ) ) {
							$path = $this->config->item('path_upload');
							if(file_exists( $path . "/" . $data['fileCurent'] )){
								unlink($path . "/" . $data['fileCurent']);
							}
						}
						$dataInsert['file_img'] = $d['file_path'];
					}
					
					$dataInsert['tille'] = $data['tille'];
					$dataInsert['short_description'] = $data['short_description'];					
					$dataInsert['date_add'] = date('Y-m-d H:i:s');
					$dataInsert['avail'] = 1;
					$dataInsert['id'] = $data['id'];
					$this->banner_model->insertItem( $dataInsert );
					redirect(admin_url('banner.html')); 
				}
			}
		}
		
		$this->_data['data'] = $item; 
		$this->_data['path_upload'] = $this->config->item('path_upload');
		$this->_data['content'] = 'banner/add';
	
		$this->parser->parse("layout/index.tpl", $this->_data);
	}
	
	public function do_upload()
	{
		$path = $this->config->item('path_upload');
		$pathY = date('Y');
		if( !is_dir($path . "/" . $pathY ) ) //create the folder if it's not already exists
		{
		  mkdir($path . "/" . $pathY, 0755, TRUE);
		}
		
		$path_M = "/" . date('m');
		if( !is_dir( $path . "/" . $pathY . $path_M ) ){
			mkdir($path . "/" . $pathY . $path_M, 0755, TRUE);
		}
		
		$path_D = "/" . date('d');
		if( !is_dir( $path . "/" . $pathY . $path_M . $path_D ) ){
			mkdir($path . "/" . $pathY . $path_M . $path_D, 0755, TRUE);
		}
		
		$file_path = $pathY . $path_M . $path_D;
		
		///echo $this->config->item('path_upload');die;
		$config['upload_path']          = $this->config->item('path_upload') . "/" . $file_path;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2500;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
	
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload('file_img'))
		{
				$error = array('error' => $this->upload->display_errors());
				return $error;
				///$this->load->view('upload_form', $error);
		}
		else
		{
			$info_upload = $this->upload->data();
			return $data = array(
			'upload_data' => $info_upload,
			'file_path' => $file_path . "/" . $info_upload['file_name']
			);
		}
	}
	
	public function del(){
		$mess['not_error'] = '0';
		if($this->input->post()) { 
			$path = $this->config->item('path_upload');
			$data = $this->input->post();
			$this->banner_model->id = (int)$data['id'];
			if( $data['fileCurent'] != '' ) {
				if(file_exists( $path . "/" . $data['fileCurent'] )){
					unlink($path . "/" . $data['fileCurent']);
				}
			}			
			$id = $this->banner_model->removeItem();
			$mess['not_error'] = $id;
		}
		die (json_encode( $mess ));
	}
}