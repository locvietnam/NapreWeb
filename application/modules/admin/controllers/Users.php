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

class Users extends MY_Controller {

    private $_data;
    private $_control;
    private $_action;
    private $_pathLogo;

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');

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
        if ($this->_data['user_data']->role_id >= 4 && $this->_action != 'profile') {
            redirect(admin_url('index.html'));
        }
    }

    public function index($start = 0) {
        $cond = '';
        $this->_data['breadcrumb'] = '';
        $this->_data['alert'] = $this->session->flashdata('alert');
        $this->_data['msg'] = $this->session->flashdata('msg');
        $this->_data['title_page'] = $this->lable['list_user'];
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
            $cond .= " Where (c.user_name LIKE '%$keyword%' OR c.user_fullname LIKE '%$keyword%') AND c.avail = $avail";
            $more_url .= "&keyword=$keyword&avail=$avail";
            $page_more_url = "keyword=$keyword&avail=$avail";
        } else if ($avail_str == '') {
            $cond .= " Where c.avail = $avail";
            $more_url .= "&avail=$avail";
            $page_more_url = "avail=$avail";
        }

        $this->_data['keyword'] = $keyword;
        $this->_data['more_url'] = $more_url;

        $totalItems = $this->users_model->countItems($cond);
        $trash = $this->users_model->countItems(' Where c.avail = 0 ');

        $per_page = $this->lable['per_item_admin'];
        $base_url = admin_url('users.html');
        $uri_segment = 4;

        $this->load->library('pagination_library');
        $this->pagination_library->pagination($base_url, $totalItems, $per_page, $uri_segment, $more_url);
        $this->_data['links'] = $this->pagination->create_links();

        $curpage = $this->input->get('per_page');
        $offset = ($curpage) ? $curpage : 0;
        $start = ($offset > 0) ? (($offset - 1) * $per_page) : $offset;

        //$limit = $this->config->item('limit_of_user');

        $items = $this->users_model->getItems($cond, $per_page, $start);
        // pre($items); 
        //print_r($items);die;
        $this->_data['action_url'] = admin_url($this->_control);
        $this->_data['action_url_add'] = admin_url($this->_control . '/add.html');
        $this->_data['action_url_delete_multi'] = admin_url($this->_control . '/deletemulti.html');
        $this->_data['list'] = $items;
        $this->_data['trash'] = $trash;

        $this->_data['content'] = 'users/index';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }

    public function add() {
        $this->_data['breadcrumb'] = '';
        $this->_data['title_page'] = $this->lable['add_member'];
        $id = (int) $this->input->get('id');
        $item = new stdClass();
        $item->user_id = 0;
        $item->user_name = '';
        $item->role_id = 0;
        $item->user_fullname = '';
        $item->user_email = '';
        $item->user_phone = '';
        $is_check_email = 0;
        $is_check_phone = 0;
        $is_check_username = 0;

        if ($id > 0) {
            $this->users_model->id = $id;
            $item = $this->users_model->getInfo();
        }
        if ($this->input->post()) {
            $data = $this->input->post('data');
            $item->user_id = $data['user_id'];
            $item->user_name = $data['user_name'];
            $item->user_fullname = $data['user_fullname'];
            $item->user_email = $data['user_email'];
            $item->user_phone = $data['user_phone'];
            $where_id = '';
            if ((int) $data['user_id'] > 0) {
                $where_id = ' AND user_id != ' . (int) $data['user_id'];
            } else {//case add new
                $item->role_id = (isset($data['role_id'])) ? $data['role_id'] : 0;
            }

            if ($data['user_email'] != '') {
                $cond = ' Where a.user_email = "' . $data['user_email'] . '"' . $where_id;
                $checkEmail = $this->users_model->getItem($cond);
                if (is_object($checkEmail)) {
                    $is_check_email = 1;
                    ///$this->form_validation->set_rules('data[user_email_exist]', sprintf( $this->lable['user_email_exist'], $data['user_email']),'required');
                    $this->form_validation->set_rules('data[user_email_exist]', '', 'required', array('required' => sprintf($this->lable['user_email_exist'], $data['user_email'])));
                }
            }

            if ($data['user_phone'] != '') {
                $cond = ' Where a.user_phone = "' . $data['user_phone'] . '"' . $where_id;
                $checkPhone = $this->users_model->getItem($cond);
                if (is_object($checkPhone)) {
                    $is_check_phone = 1;
                    ///$this->form_validation->set_rules('data[user_phone_exist]', sprintf( $this->lable['user_phone_exist'], $data['user_phone']),'required');
                    $this->form_validation->set_rules('data[user_phone_exist]', '', 'required', array('required' => sprintf($this->lable['user_phone_exist'], $data['user_phone'])));
                }
            }

            if ($data['user_name'] != '') {
                $cond = ' Where a.user_name = "' . $data['user_name'] . '"' . $where_id;
                $checkUsername = $this->users_model->getItem($cond);
                if (is_object($checkUsername)) {
                    $is_check_username = 1;
                    ///$this->form_validation->set_rules('data[user_name_exist]', sprintf( $this->lable['user_name_exist'], $data['user_name']),'required');
                    $this->form_validation->set_rules('data[user_name_exist]', '', 'required', array('required' => sprintf($this->lable['user_name_exist'], $data['user_name'])));
                }
            }
            ///print_r( $data );die;
        }//End if( $this->input->post() ){
        ///$this->form_validation->set_rules('data[user_name]', $this->lable['user_name_required'],'required');
        $this->form_validation->set_rules('data[user_name]', '', 'required', array('required' => $this->lable['user_name_required']));
        if ($id == 0) {
            ///$this->form_validation->set_rules('data[user_password]', $this->lable['password_required'],'required');
            ///$this->form_validation->set_rules('data[repassword]', $this->lable['password_not_matches'],'matches[data[user_password]]');
            ///$this->form_validation->set_rules('data[role_id]', $this->lable['role_id_required'],'required');

            $this->form_validation->set_rules('data[user_password]', '', 'required', array('required' => $this->lable['password_required']));
            $this->form_validation->set_rules('data[repassword]', '', 'matches[data[user_password]]', array('matches' => $this->lable['password_not_matches']));
            $this->form_validation->set_rules('data[role_id]', '', 'required', array('required' => $this->lable['role_id_required']));
        }
        ///$this->form_validation->set_rules('data[user_fullname]', $this->lable['fullname_required'],'required');
        $this->form_validation->set_rules('data[user_fullname]', '', 'required', array('required' => $this->lable['fullname_required']));
        //chech validate
        if ($this->form_validation->run() && $is_check_email == 0 && $is_check_phone == 0 && $is_check_username == 0) {
            $data = $this->input->post('data');

            $_data = array(
                'user_id' => $data['user_id'],
                'user_name' => $data['user_name'],
                'user_fullname' => $data['user_fullname'],
                'user_email' => $data['user_email'],
                'user_phone' => $data['user_phone']
            );

            if ((int) $data['user_id'] == 0) { //khi add new				
                $_data['role_id'] = $data['role_id'];
                $_data['date_add'] = date('Y:m:d H:i:s');
                $_data['user_password'] = md5($data['user_password']);
            }

            $status = $this->users_model->insertItem($_data);
            redirect(admin_url($this->_control . '.html'));
            //save
        }

        $roles = $this->users_model->getAllRoles();
        $this->_data['roles'] = $roles;
        $this->_data['data'] = $item;
        $this->_data['alert'] = $this->session->flashdata('alert');
        $this->_data['msg'] = $this->session->flashdata('msg');
        $this->_data['action_url'] = admin_url($this->_control . '/process');

        $this->_data['content'] = 'users/add';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }

    public function del() {
        $mess['not_error'] = '0';
        $id = (int) $this->input->get('id');
        $this->users_model->id = $id;
        $status = $this->users_model->removeItem();
        die(json_encode($mess));
    }

    public function resetuser() {
        $id = (int) $this->input->get('id');
        $this->users_model->id = $id;
        $data['avail'] = 1;
        $this->users_model->updateItem($data);
        redirect(admin_url($this->_control . '.html'));
    }

    public function register() {
        $this->_data['title_page'] = $this->lable['add_member'];
        //Bắt đầu set tập lệnh
        $this->form_validation->set_rules('username', 'Tài khoản', 'required|min_length[6]');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
        $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'required|min_length[6]|matches[password]');
        //Bắt đầu chạy kiểm tra tập lệnh
        if ($this->form_validation->run()) {
            //�?ăng ký thành công, muốn làm gì thêm thì làm :D
        }
        $this->_data['content'] = 'users/register';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }

    public function profile() {

        $this->_data['title_page'] = $this->lable['profile'];

        $this->load->library('form_validation');
        $userLogin = $this->_data['user_data'];
        if ($this->input->post()) {
            $data = $this->input->post('data');
            $is_check_email = 0;
            $is_check_phone = 0;
            if ($data['user_email'] != '') {
                $cond = ' Where a.user_email = "' . $data['user_email'] . '" AND user_id != ' . (int) $userLogin->user_id;
                $checkEmail = $this->users_model->getItem($cond);
                if (is_object($checkEmail)) {
                    $is_check_email = 1;
                    ///$this->form_validation->set_rules('data[user_email_exist]', sprintf( $this->lable['user_email_exist'], $data['user_email']),'required');
                    $this->form_validation->set_rules('data[user_email_exist]', '', 'required', array('required' => sprintf($this->lable['user_email_exist'], $data['user_email'])));
                }
            }
            if ($data['user_phone'] != '') {
                $cond = ' Where a.user_phone = "' . $data['user_phone'] . '" AND user_id != ' . (int) $userLogin->user_id;
                $checkPhone = $this->users_model->getItem($cond);
                if (is_object($checkPhone)) {
                    $is_check_phone = 1;
                    ///$this->form_validation->set_rules('data[user_phone_exist]', sprintf( $this->lable['user_phone_exist'], $data['user_phone']),'required');
                    $this->form_validation->set_rules('data[user_phone_exist]', '', 'required', array('required' => sprintf($this->lable['user_phone_exist'], $data['user_phone'])));
                }
            }

            ///$this->form_validation->set_rules('data[user_fullname]', $this->lable['user_fullname_required'],'required');
            $this->form_validation->set_rules('data[user_fullname]', '', 'required', array('required' => $this->lable['user_fullname_required']));

            $userLogin->user_fullname = $data['user_fullname'];
            $this->_data['user_data'] = $userLogin;
            //chech validate
            if ($this->form_validation->run() && $is_check_email == 0 && $is_check_phone == 0) {
                //print_r( $_FILES["file_img"] );die;
                $d = array();
                if (!$_FILES["file_img"]['error']) {
                    $d = $this->do_upload();
                }
                if (isset($d['error'])) {
                    $this->_data['error'] = $d['error'];
                } else {

                    if (isset($data['delete'])) {
                        $dataUpdate['user_avatar'] = '';
                        $path = $this->config->item('path_upload');
                        if (file_exists($path . "/" . $data['fileCurent'])) {
                            unlink($path . "/" . $data['fileCurent']);
                        }
                    }
                    if (!empty($d)) {
                        if (isset($data['fileCurent'])) {
                            $path = $this->config->item('path_upload');
                            if (file_exists($path . "/" . $data['fileCurent'])) {
                                unlink($path . "/" . $data['fileCurent']);
                            }
                        }
                        $dataUpdate['user_avatar'] = $d['file_path'];
                    }

                    $dataUpdate['user_phone'] = $data['user_phone'];
                    $dataUpdate['user_fullname'] = $data['user_fullname'];
                    $dataUpdate['last_update'] = date('Y-m-d H:i:s');

                    $userLogin->last_update = $dataUpdate['last_update'];
                    $userLogin->user_fullname = $dataUpdate['user_fullname'];
                    $userLogin->user_phone = $dataUpdate['user_phone'];
                    $userLogin->user_avatar = $dataUpdate['user_avatar'];

                    $this->session->set_userdata('login', $userLogin);
                    $this->users_model->id = $userLogin->user_id;
                    $this->users_model->updateItem($dataUpdate);
                    redirect(admin_url('profile.html'));
                }
            }
        }

        $this->_data['path_upload'] = $this->config->item('path_upload');
        $this->_data['content'] = 'users/profile';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }

    public function do_upload() {
        $path = $this->config->item('path_upload');
        $userLogin = $this->_data['user_data'];
        $pathU = $userLogin->user_name;
        if (!is_dir($path . "/" . $pathU)) { //create the folder if it's not already exists
            mkdir($path . "/" . $pathU, 0755, TRUE);
        }

        $file_path = $pathU;

        ///echo $this->config->item('path_upload');die;
        $config['upload_path'] = $this->config->item('path_upload') . "/" . $file_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024000*3; //1 MB(1024 Kb)
		//'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_img')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
            ///$this->load->view('upload_form', $error);
        } else {
            $info_upload = $this->upload->data();
            return $data = array(
                'upload_data' => $info_upload,
                'file_path' => $file_path . "/" . $info_upload['file_name']
            );
        }
    }

}
