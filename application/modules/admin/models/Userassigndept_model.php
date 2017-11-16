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

class Userassigndept_model extends MY_Model
{
    
	
	public $table = 'pp_user_assign_dept';
    public $table_user_manager = 'pp_user_manager_dept';
    public $table_role = 'pp_user_role';
    public $table_user = 'pp_user';
	public $table_department = 'pp_department';
	public $id = NULL;
	
	/**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getAll($cond=''){
        
		$sql = "SELECT 
				b.*, a.user_fullname, a.user_name , c.role_name, a.user_id as Auser_id, b.user_id as Buser_id
				FROM {$this->table_user} AS a 
				LEFT JOIN $this->table AS b ON a.user_id = b.user_id 
				LEFT JOIN $this->table_role AS c ON c.role_id = a.role_id 
				LEFT JOIN $this->table_department AS d ON b.department_id = d.department_id 
				$cond ORDER BY a.user_fullname ASC";
		
        return $this->db->query($sql)->result_array(); 
    }
	
    /**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getItems($cond='', $num='', $offset=''){
        
        $limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";
        
       $sql = "SELECT 
		a.*, b.user_fullname, b.user_name, u.user_fullname as manager_fullname , 
		c.role_name,d.department_name,a.manager_id,a.department_id 
		FROM {$this->table} AS a
		LEFT JOIN $this->table_user AS b ON a.user_id = b.user_id 
		LEFT JOIN $this->table_user AS u ON a.manager_id = u.user_id 
		LEFT JOIN $this->table_role AS c ON c.role_id = b.role_id 
		INNER JOIN $this->table_department AS d ON a.department_id = d.department_id 
		$cond ORDER BY b.user_fullname ASC $limit";
                
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond='' ){ 
	
		$sql = "SELECT 
		a.*, b.user_fullname, b.user_name, u.user_fullname as manager_fullname , 
		c.role_name,d.department_name,a.manager_id,a.department_id 
		FROM {$this->table} AS a
		LEFT JOIN $this->table_user AS b ON a.user_id = b.user_id 
		LEFT JOIN $this->table_user AS u ON a.manager_id = u.user_id 
		LEFT JOIN $this->table_role AS c ON c.role_id = b.role_id 
		INNER JOIN $this->table_department AS d ON a.department_id = d.department_id 
		$cond ORDER BY b.user_fullname ASC";
		
        return $this->db->query($sql)->num_rows();  
    }
    
    /**
     * [insert]
     * @param type $data
     * @return boolean
     */
    function insertItem( $data = '' ){
        if( $data == '' ) return ; 
        return $this->db->insert($this->table, $data); 
    }
    
	/**
     * [update item]
     * @param type $data
     * @return boolean
     */
    function updateItem( $data = NULL ){
		if( $data == NULL || $this->id == NULL ) return ; 
        return $this->db->update( $this->table, $data, array( 'id' => $this->id )); 
    }
	
	function getItemById( ) {
		if( $this->id == NULL ) return ; 
        $sql = "SELECT * FROM $this->table WHERE id = $this->id ";
        return $this->db->query($sql)->row();
    }
	
    /**
     * 
     * @param type $id
     * @return boolean
     */
    
    function removeItem( $data = NULL ){
        if($this->id == NULL ) return; 
		$info = $this->getItemById();
		if( $info->avail == 1 ){ //xoa lan dau tien thi update = 0 de cho vao trash
			$dataUpdate['avail'] = 0; 
			$this->updateItem( $dataUpdate );
		}
		else {
        	return $this->db->delete($this->table, array('id' => $this->id));
		}
    }
}