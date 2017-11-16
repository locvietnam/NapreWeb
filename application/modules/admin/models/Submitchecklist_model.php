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

class Submitchecklist_model extends MY_Model
{
    
    public $table = 'pp_submit_checklist';
	
    public $id = NULL,
            $submit_id = NULL,
            $checklist_id = NULL; 
    
	
    function getById( $submit_id = 0, $checklist_id = 0 ){
		if((int)$submit_id == 0 || (int)$checklist_id == 0 ){
			return 0;
		}
        $sql = "SELECT c.* FROM {$this->table} c WHERE submit_id = $submit_id AND checklist_id = $checklist_id LIMIT 0,1";
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
            return $this->db->insert($this->table, $data); 
    }
    
    function updateItem( $data = NULL, $checklist_checked0OR1 = 0 ){
		if( $data == NULL ) return ; 
        if( $checklist_checked0OR1 == 1 ){//neu $checklist_checked0OR1 = 1 co nghia la cap nhat [checklist_checked] về trạng thái 1 khi tình trạng sửa trên trang http://153.126.149.249/admin/checklist-results/list-notice.html co chọn
            return $this->db->update( $this->table, $data, array( 'submit_id' => $this->submit_id, 'checklist_id' => $this->checklist_id ));
        }
        else {//neu $checklist_checked0OR1 = 0 co nghia la cap nhat tat cả [checklist_checked] về trạng thái 0 khi tình trạng sửa trên trang http://153.126.149.249/admin/checklist-results/list-notice.html
            return $this->db->update( $this->table, $data, array( 'submit_id' => $this->submit_id)); 
        }
    }
    
    /**
     * 
     * @param type $id
     * @return boolean
     */    
    function removeItem(){
		if( $this->submit_id == NULL || $this->checklist_id == NULL ) return ; 
        return $this->db->delete($this->table, array('submit_id' => $this->submit_id,'checklist_id' => $this->checklist_id ) );
    }

}