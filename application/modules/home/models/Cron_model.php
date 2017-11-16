<?php
/**
* Model Backend Cron
* Last update 23 Jan 2017
* 
* @package Cron
* @copyright AirTrippy
* @author @contact@panpic.vn
* @author position: PHP Developer
* @since 23 Jan 2017
*/

class Cron_model extends MY_Model
{
    
    private $_tour = 'tour';
   
    function table_tour(){ return $this->_tour;}
   
   

    function updateLastAvailTours() { 
        $sql = "UPDATE ".$this->table_tour()." SET last_avail = NOW() WHERE avail = 1";
        return $this->db->query($sql);
    }
     
    
    
}