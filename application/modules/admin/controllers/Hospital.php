
<?php

/**
 * Controllers Backend Forgot password
 * Last update 14 Jun 2017
 * 
 * @package backend
 * @copyright A-Line
 * @author Panpic-team
 * @author position: PHP Developer
 * @since 14 Jun 2017
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hospital extends MY_Controller {

    private $_data;
    private $_control;
    private $_action;
    private $_pathLogo;

    public function __construct() {
        parent::__construct();
        $this->load->model('hospital_model');

        $this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];
        $this->_data['base_url'] = $this->config->item("base_url");
        $this->_data['base_tlp_admin'] = $this->config->item("base_tlp_admin");
        $this->_data['base_url_admin'] = $this->config->item("base_url_admin");
        $this->_data['lable'] = $this->lable;
        $this->_data['user_data'] = $this->session->userdata('login');

        $this->_control = $this->router->class;
        $this->_action = $this->router->method;
        $this->_pathLogo = $this->config->item('path_logo');
        $this->_data['current_control'] = $this->_control;
        $this->_data['current_method'] = $this->_action;

        //lchung add
        $this->_data['path_upload'] = $this->config->item('path_upload');
        $back_url = admin_url($this->_control . '/add.html');
        $this->load->library('form_validation');
        if ($this->_data['user_data']->role_id >= 3 ) {
            redirect(admin_url('index.html'));
        }
    }

    public function index($start = 0) {
        $cond = '';
        $this->_data['breadcrumb'] = '';
        $this->_data['alert'] = $this->session->flashdata('alert');
        $this->_data['msg'] = $this->session->flashdata('msg');
        $this->_data['title_page'] = $this->lable['list_hospital'];
        $more_url = '';
        $page_more_url = '';
        //$cond .= " Where c.avail = 1"; 
        $keyword = trim(strip_tags($this->input->get('keyword')));
        $avail_str = trim(strip_tags($this->input->get('avail')));

        if ($avail_str != 'trash') {
            $avail = '1';
        } else {
            $avail = '0';
        }
        if ($keyword || $avail_str == 'trash') {
            $cond .= " Where a.hospital_name LIKE '%$keyword%' AND a.avail = $avail";
            $more_url .= "&keyword=$keyword&avail=$avail";
            $page_more_url = "keyword=$keyword&avail=$avail";
        } else if ($avail_str == '') {
            $cond .= " Where a.avail = $avail";
            $more_url .= "&avail=$avail";
            $page_more_url = "avail=$avail";
        }

        $this->_data['keyword'] = $keyword;
        $this->_data['more_url'] = $more_url;

        $totalItems = $this->hospital_model->countItems($cond);
        $trash = $this->hospital_model->countItems(' Where a.avail = 0 ');

        $per_page = $this->lable['per_item_admin'];
        $base_url = admin_url('hospital.html');
        $uri_segment = 4;

        $this->load->library('pagination_library');
        $this->pagination_library->pagination($base_url, $totalItems, $per_page, $uri_segment, $more_url);
        $this->_data['links'] = $this->pagination->create_links();

        $curpage = $this->input->get('per_page');
        $offset = ($curpage) ? $curpage : 0;
        $start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;

        //$limit = $this->config->item('limit_of_user');

        $items = $this->hospital_model->getItems($cond, $per_page, $start);
        
        $this->_data['action_url'] = admin_url($this->_control);
        $this->_data['action_url_add'] = admin_url($this->_control . '/add.html');
        $this->_data['action_url_delete_multi'] = admin_url($this->_control . '/deletemulti.html');
        $this->_data['list'] = $items;
        $this->_data['trash'] = $trash;

        $this->_data['content'] = 'hospital/index';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }

    public function add() {
        $this->_data['breadcrumb'] = '';
        $this->_data['title_page'] = $this->lable['add_hospital'];
        $id = (int) $this->input->get('id');
        $item = new stdClass();
        $item->hospital_id = 0;
        $item->hospital_name = '';

        if ($id > 0) {
            $this->hospital_model->id = $id;
            $item = $this->hospital_model->getItemById();
        }
        if ($this->input->post()) {
            $data = $this->input->post('data');
            $item->hospital_id = $data['hospital_id'];
            $item->hospital_name = $data['hospital_name'];
            $where_id = '';
            if ((int) $data['hospital_id'] > 0) {
                $where_id = ' AND hospital_id != ' . (int) $data['hospital_id'];
            }

            if ($data['hospital_name'] != '') {
                $cond = ' Where a.hospital_name = "' . $data['hospital_name'] . '"' . $where_id;
                $checkName = $this->hospital_model->getItem($cond);
                if (is_object($checkName)) {
                    $is_check_name = 1;
                    $this->form_validation->set_rules('data[hospital_name_exist]', '', 'required', array('required' => sprintf($this->lable['hospital_name_exist'], $data['hospital_name'])));
                }
            }

            ///print_r( $data );die;
        }//End if( $this->input->post() ){
        $this->form_validation->set_rules('data[hospital_name]', '', 'required', array('required' => $this->lable['hospital_name_required']));
       //chech validate
        if ($this->form_validation->run() && $is_check_name == 0 ) {
            $data = $this->input->post('data');

            $_data = array(
                'hospital_id' => $data['hospital_id'],
                'hospital_name' => $data['hospital_name']
            );

            if ((int) $data['hospital_id'] == 0) { //khi add new
                $_data['date_add'] = date('Y:m:d H:i:s');
            }

            $status = $this->hospital_model->insertItem($_data);
            redirect(admin_url($this->_control . '.html'));
            //save
        }

        $this->_data['data'] = $item;
        $this->_data['alert'] = $this->session->flashdata('alert');
        $this->_data['msg'] = $this->session->flashdata('msg');
        $this->_data['action_url'] = admin_url($this->_control . '/process');

        $this->_data['content'] = 'hospital/add';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }

    public function del() {
        $mess['not_error'] = '0';
        $id = (int) $this->input->get('id');
        $this->hospital_model->id = $id;
        $status = $this->hospital_model->removeItem();
        die(json_encode($mess));
    }

    public function resethospital() {
        $id = (int) $this->input->get('id');
        $this->hospital_model->id = $id;
        $data['avail'] = 1;
        $this->hospital_model->updateItem($data);
        redirect(admin_url($this->_control . '.html'));
    }

}
