<?php
/**
* Model Backend language
* Last update 21 June 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 21 June 2017
*/

class Banner_model extends MY_Model
{
    
    public $table = 'pp_banners_app';
    public $id = 0; 
        
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
        
        $sql = "SELECT * FROM {$this->table} $cond ORDER BY tille ASC $limit";
                
        return $this->db->query($sql)->result();//_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        $sql = "SELECT id FROM {$this->table} $cond";
        return $this->db->query($sql)->num_rows();  
    }
    
	function getItemById( $cond = '' ) {
        $sql = "SELECT * FROM $this->table WHERE id = $this->id $cond";
        return $this->db->query($sql)->row();
    }
	
    /**
     * [insert or update item]
     * @param type $data
     * @return boolean
     */
    function insertItem( $data = NULL ){
        if( $data == NULL ) return ; 
		
		if( (int)$data['id'] > 0 ) {
			$this->id = (int)$data['id'];
            return $this->updateItem($data); 
		}
		else {
			return $this->db->insert($this->table, $data);
		}
    }
    
    function updateItem( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->update( $this->table, $data, array('id' => $this->id )); 
    }
    
    /**
     * 
     * @param type $id
     * @return boolean
     */
    
    function removeItem(){
		if( $this->id == 0 ) return ; 
        return $this->db->delete($this->table, array('id' => $this->id ) );
    }
	
}