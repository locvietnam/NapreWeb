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

class Submit_model extends MY_Model
{
    
    public $table = 'pp_submit',
           $table_sc = 'pp_submit_checklist';
	
    public $submit_id = NULL; 
    
	
    function getById( $id = 0 ){
		if((int)$id > 0 )
      		$this->id = $id;
		
		if((int)$this->id == 0 ){
			return 0;
		}
        $sql = "SELECT c.* FROM {$this->table} c WHERE id = $this->id LIMIT 0,1";
        $this->db->simple_query('SET NAMES \'utf8_general_ci\'');
        return $this->db->query($sql)->result_array(); 
    }
	
    function getItemsByConds( $cond = '' ) { 
        $sql = "SELECT * FROM " . $this->table . " $cond";
        return $this->db->query($sql)->result_array();
    }
    
    
    function getAll( $cond = '' ) { 
        $sql = "
		SELECT a.* FROM $this->table as a 
		$cond
		";
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
        $sql = "SELECT c.* FROM {$this->table} c $cond ORDER BY id ASC $limit";                
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        $sql = "SELECT c.id FROM {$this->table} $cond";
        return $this->db->query($sql)->num_rows();  
    }
    
    /**
     * [insert or update item]
     * @param type $data
     * @return boolean
     */
    function insertItem( $data = NULL ){
        if( $data == NULL ) return ; 
        $this->db->insert($this->table, $data); 
        return $this->db->insert_id();
    }
    
    function updateItem( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->update( $this->table, $data, array( 'id' => $this->submit_id )); 
    }
    
    /**
     * 
     * @param type $id
     * @return boolean
     */    
    function removeItem(){
		if( $this->submit_id == NULL || $this->checklist_id == NULL ) return ; 
        $this->db->delete($this->table_sc, array('submit_id' => $this->submit_id,'checklist_id' => $this->checklist_id ) );
        return $this->db->delete($this->table, array('submit_id' => $this->submit_id) );
    }

}