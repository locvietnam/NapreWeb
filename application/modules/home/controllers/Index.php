<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Controllers Frontend
* Last update 08 Jun 2017
* 
* @package Frontend Login Social
* @copyright A-Line
* @author contact@panpic.vn
* @author pos: PHP Developer
* @since 08 Jun 2017
*/

class Index extends FRONT_Controller{
    
    private $_data;
    private $_control;
    private $_session_enduser;
    private $_user_data;
    private $_pathThumb;
    
    
    public function __construct(){ 
        parent::__construct();
        
    }
    
    function index() {
        redirect( admin_url('login') ); 
    }


}