<?php
/**
* Model Backend language
* Last update 5 Jan 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 5 Jan 2017
*/

class Setup_model extends MY_Model
{
    
    public $table = 'pp_lang_values';
    
    public $id = ''; 
        
    function getItemsByConds( $cond = '' ) { 
        $sql = "SELECT * FROM " . $this->table . " $cond";
        return $this->db->query($sql)->result_array();
    }
    
    
    function getAll( $cond = '' ) { 
        $sql = "SELECT * FROM $this->table $cond";
        return $this->db->query($sql)->result();
    }
    
    
    /**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getItems( $cond='', $num='', $offset='' ){
        
        $limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";
        
        $sql = "SELECT * FROM {$this->table} $cond ORDER BY name ASC $limit";
                
        return $this->db->query($sql)->result();//_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        $sql = "SELECT name FROM {$this->table} $cond";
        return $this->db->query($sql)->num_rows();  
    }
    
    /**
     * [insert or update item]
     * @param type $data
     * @return boolean
     */
    function insertItem( $data = NULL ){
        if( $data == NULL ) return ; 
            return $this->db->insert($this->table, $data); 
    }
    
    function updateItem( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->update( $this->table, $data, array('name' => $data['name'], 'lang' => $data['lang'] )); 
    }
    
    /**
     * 
     * @param type $id
     * @return boolean
     */
    
    function removeItem( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->delete($this->table, array('name' => $data['name'], 'lang' => $data['lang'] ) );
    }
	
}