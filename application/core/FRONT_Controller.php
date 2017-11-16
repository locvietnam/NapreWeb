<?php

/**
* Optimize Front modules
* Last update 11 Jan 2017
* 
* @package Front
* @copyright AirTrippy
* @author contact@panpic.vn
* @author pos: PHP Developer
* @since 11 Jan 2017 
* 
*/

Class FRONT_Controller extends CI_Controller
{
    //bien gui du lieu sang ben view
    public $data = array();
    
    public $lable;

            
    function __construct()
    {
        //ke thua tu CI_Controller
        parent::__construct();
        
        $this->load->helper('front');

    }
    
    
    

    
}
