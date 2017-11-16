<?php
/**
* Controllers Backend login
* Last update 8 Jun 2017
* 
* @package backend
* @copyright A-Line
* @author Panpic-team
* @author position: PHP Developer
* @since 8 Jun 2017
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller{
	
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
		$this->_data['path_upload'] = $this->config->item('path_upload');
    }
    

   public function index(){

        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $this->_data['task'] = $this->lable['add'];
        $this->_data['breadcrumb'] = $this->lable['dashboard'];
        $this->_data['alert'] = '';

        $this->parser->parse("index/index.tpl", $this->_data);
    }



}