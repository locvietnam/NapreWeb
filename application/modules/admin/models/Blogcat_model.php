<?php
/**
* Model Backend Blog categories
* Last update 12 Jan 2017
* 
* @package backend
* @copyright AirTrippy
* @author @contact@panpic.vn
* @author position: PHP Developer
* @since 12 Jan 2017
*/

class Blogcat_model extends MY_Model
{
    
    var $table = 'special_locations';
    public $id;
    
    function getKeyString() { return "id ='$this->id'"; }	
    
    
    /**
     * 
     * @param $id int
     * @return array
     */
    function getItemById(){
        
        $sql = "SELECT * FROM $this->table WHERE ".$this->getKeyString();
        return $this->db->query($sql)->row_array();
    }
    
    
    function insertItem($params){
        return $this->db->insert($this->table, $params);
    }
    
    public function updateItem($params) {

        $this->db->where('id', $this->id);
        return $this->db->update($this->table, $params);

    }
    
    
    function items($cond=''){
        
        $sql = "SELECT * FROM $this->table $cond";
        return $this->db->query($sql)->result('array');
    }
    
    
    
    
    
}