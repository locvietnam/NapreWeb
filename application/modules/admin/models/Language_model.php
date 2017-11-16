<?php
/**
* Model Backend language
* Last update 8 Jun 2017
* 
* @package backend
* @copyright A-Line
* @author Panpic-team
* @author position: PHP Developer
* @since 8 Jun 2017
*/

class Language_model extends MY_Model
{
    
    var $table = 'pp_lang_values';
    public $name;
    
    function getKeyString() { return "d.name ='$this->name'"; }	
    
    
    /**
     * 
     * @param $name string
     * @return array
     */
    function getItemById(){
        
        $sql = "SELECT * FROM $this->table AS d WHERE d.lang ='ja' AND ".$this->getKeyString();
        
        return $this->db->query($sql)->row_array();
    }
    
    
    function insertItem($params){
        return $this->db->insert($this->table, $params);
    }
    
    public function updateItem($params) {

        $this->db->where('name', $this->name);
        return $this->db->update($this->table, $params);

    }
    
    
    function checkNameExist($name){
        $sql = "SELECT name FROM $this->table AS d WHERE d.lang ='ja' AND d.name = '$name'"; //.$this->getKeyString();
        return $this->db->query($sql)->row_array();
    }
    
    
    
    
}