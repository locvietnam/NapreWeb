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

class Usermanagerdept_model extends MY_Model
{
    
    public $table = 'pp_user_manager_dept';
    public $table_role = 'pp_user_role';
    public $table_user = 'pp_user';
	public $table_department = 'pp_department';
	
	/**
     * 
     * @param type $cond
     * @return list items
     */
    function getAll( $cond = '' ){
        
		$sql = "SELECT 
				b.*, d.department_name, a.user_fullname, a.user_name , c.role_name, a.user_id as Amanager_id, b.manager_id as Bmanager_id
				FROM {$this->table_user} AS a 
				LEFT JOIN $this->table AS b ON a.user_id = b.manager_id  
				LEFT JOIN $this->table_role AS c ON c.role_id = a.role_id 
				LEFT JOIN $this->table_department AS d ON b.department_id = d.department_id 
				$cond GROUP BY a.user_id,d.department_id  ORDER BY a.user_fullname ASC";
		
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
        
        $sql = "SELECT b.*, c.role_name,d.department_name,a.manager_id,a.department_id 
		FROM {$this->table} AS a
		LEFT JOIN $this->table_user AS b ON a.manager_id = b.user_id 
		LEFT JOIN $this->table_role AS c ON c.role_id = b.role_id 
		INNER JOIN $this->table_department AS d ON a.department_id = d.department_id 
		$cond ORDER BY b.user_fullname ASC $limit";
                
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond='' ){ 
	
		 $sql = "SELECT b.user_id FROM {$this->table} AS a
		LEFT JOIN $this->table_user AS b ON a.manager_id = b.user_id 
		LEFT JOIN $this->table_role AS c ON c.role_id = b.role_id 
		INNER JOIN $this->table_department AS d ON a.department_id = d.department_id 
		$cond ORDER BY b.user_fullname";
		
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
     * 
     * @param type $id
     * @return boolean
     */
    
    function removeItem( $data = NULL ){
        if($data == NULL ) return; 
		if( is_array( $data['user_id'] ) ) {
			foreach ( $data['user_id'] as $user_id ){
				$this->db->delete($this->table, array('department_id' => $data['department_id'], 'manager_id' => $user_id ));
			}
			return 1;
		}
		else
        return $this->db->delete($this->table, array('department_id' => $data['department_id'], 'manager_id' => $data['user_id']));
    }
}