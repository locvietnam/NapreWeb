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

class Checklist_model extends MY_Model
{
	public $table = 'pp_checklist';
	public $table_che_cate = 'pp_checklist_category';
	public $table_dept = 'pp_department';
	public $table_che_cate_u = 'pp_checklist_category_users';
	public $table_che_type = 'pp_checklist_type';
	public $table_che_week = 'pp_checklist_weekdays';
	public $table_u = 'pp_user';
	public $table_u_m_d = 'pp_user_manager_dept';
	public $table_u_a_d = 'pp_user_assign_dept';
	public $table_u_r = 'pp_user_role';
	
	
	
	public $checklist_id = NULL;
	public $checklist_category_id = NULL;
	public $user_id = NULL;
	
	
	 /**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getItems( $cond='', $num='', $offset='' ){
        
        $limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";
        
        $sql = "
		SELECT a.*, b.department_name, c.user_fullname as manager_name, d.checklist_type, e.day_of_week,
		 ( SELECT count(checklist_id) FROM {$this->table} as f WHERE a.checklist_category_id = f.checklist_category_id) as count_checklist
		FROM {$this->table_che_cate} as a 
		LEFT JOIN {$this->table_dept} as b ON a.department_id = b.department_id 
		LEFT JOIN {$this->table_u} as c ON a.manager_id = c.user_id 
		LEFT JOIN {$this->table_che_type} as d ON a.checklist_type_id = d.checklist_type_id 
		LEFT JOIN {$this->table_che_week} as e ON a.weekday_num = e.weekday_num 
		$cond ORDER BY checklist_category ASC $limit
		";
                
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        $sql = "SELECT c.name FROM {$this->table} $cond";
		
		$sql = "
		SELECT a.checklist_category_id FROM {$this->table_che_cate} as a 
		LEFT JOIN {$this->table_dept} as b ON a.department_id = b.department_id 
		LEFT JOIN {$this->table_u} as c ON a.manager_id = c.user_id 
		LEFT JOIN {$this->table_che_type} as d ON a.checklist_type_id = d.checklist_type_id 
		LEFT JOIN {$this->table_che_week} as e ON a.weekday_num = e.weekday_num 
		$cond 
		";
        return $this->db->query($sql)->num_rows();  
    }
	
	function getAll( $cond = '' ) { 
        $sql = "SELECT * FROM $this->table $cond";
        return $this->db->query($sql)->result();
    }
	
	function getallCate( $cond='', $num='', $offset='', $count = 0 ) { 
		
		$limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";
        $sql = "
		SELECT a.*, c.user_fullname as manager_name, b.department_name FROM $this->table_che_cate as a 
		INNER JOIN {$this->table_dept} as b ON a.department_id = b.department_id 
		LEFT JOIN {$this->table_u} as c ON a.manager_id = c.user_id 
		$cond $limit ";
		if( $count == 1 )
			return $this->db->query($sql)->num_rows();  
		else
        	return $this->db->query($sql)->result();
    }
	
	function getallCateUser( $cond = '' ) { 
        $sql = "
		SELECT a.*, c.user_fullname FROM $this->table_che_cate_u as a 
		LEFT JOIN {$this->table_u} as c ON a.user_id = c.user_id 
		$cond";
        return $this->db->query($sql)->result();
    }
	
	function getallType( $cond = '' ) { 
        $sql = "SELECT * FROM $this->table_che_type $cond";
        return $this->db->query($sql)->result();
    }
	
	function getallWeek( $cond = '' ) { 
        $sql = "SELECT * FROM $this->table_che_week $cond";
        return $this->db->query($sql)->result();
    }
	
	function getUserManager( $cond = '' ) { 
        $sql = "SELECT a.*,b.* FROM $this->table_u_m_d as a INNER JOIN $this->table_u as b ON a.manager_id = b.user_id 
		$cond GROUP BY b.user_id";
        return $this->db->query($sql)->result();
    }
	
	function getUserStaff( $cond = '' ) { 
        $sql = "SELECT a.manager_id, a.department_id, a.avail, b.*, c.role_name FROM $this->table_u_a_d as a 
		INNER JOIN $this->table_u as b ON a.user_id = b.user_id 
		INNER JOIN $this->table_u_r as c ON b.role_id = c.role_id 
		LEFT JOIN {$this->table_che_cate_u} as d ON a.user_id = d.user_id 
		$cond GROUP BY b.user_id";
        return $this->db->query($sql)->result();
    }
	
	
	 /**
     * [insert]
     * @param type $data
     * @return boolean
     */
    function insertItem( $data = NULL ){
        if( $data == NULL ) return ; 
            $this->db->insert($this->table, $data); 
		return $this->db->insert_id();
    }
    
	 /**
     * [update item]
     * @param type $data
     * @return boolean
     */
    function updateItem( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->update( $this->table, $data, array( 'checklist_id' => $this->checklist_id )); 
    }
    
    /**
     * 
     * @param type $id
     * @return boolean
     */
    function removeItem(){
		if( $this->checklist_id == NULL ) return ; 
        return $this->db->delete($this->table, array('checklist_id' => $this->checklist_id ) );
    }
	
	/**
     * 
     * @param type $id
     * @return boolean
     */
    function removeItems( ){
		if( $this->checklist_category_id == null ) return ; 
        return $this->db->delete($this->table, array('checklist_category_id' => $this->checklist_category_id) );
    }
	
	/**
     * 
     * @param type $id
     * @return boolean
     */
    function removeItemCateUsers( ){
		if( $this->checklist_category_id == null ) return ; 
        return $this->db->delete($this->table_che_cate_u, array('checklist_category_id' => $this->checklist_category_id ) );
    }
	
	
	 /**
     * [insert]
     * @param type $data
     * @return boolean
     */
    function insertItemCate( $data = NULL ){
        if( $data == NULL ) return ; 
            $this->db->insert($this->table_che_cate, $data); 
			return $this->db->insert_id();
    }
    
	 /**
     * [update item]
     * @param type $data
     * @return boolean
     */
    function updateItemCate( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->update( $this->table_che_cate, $data, array( 'checklist_category_id' => $this->checklist_category_id )); 
    }
	
	/**
     * [insert]
     * @param type $data
     * @return boolean
     */
    function insertItemCateU( $data = NULL ){
        if( $data == NULL ) return ; 
            $this->db->insert($this->table_che_cate_u, $data); 
			return $this->db->insert_id();
    }
    
	 /**
     * [update item]
     * @param type $data
     * @return boolean
     */
    function updateItemCateU( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->update( $this->table_che_cate_u, $data, array( 'checklist_category_id' => $this->checklist_category_id, 'user_id' => $this->user_id )); 
    }
	
	 /**
     * 
     * @param type $checklist_category_id
     * @return boolean
     */
    function removeItemChecklistCate(){
		if( $this->checklist_category_id == NULL ) return ; 
		
		//xoa het cap con
		$this->removeItemChecklistCateSub();
		
        return $this->db->delete($this->table_che_cate, array('checklist_category_id' => $this->checklist_category_id ) );
    }
	
	/**
     * 
     * @param type $checklist_category_id
     * @return boolean
     */
    function removeItemChecklistCateSub(){
		if( $this->checklist_category_id == NULL ) return ; 
		//xoa het cap con
		return $this->db->delete($this->table_che_cate, array('parent_category_id' => $this->checklist_category_id ) );
    }
	
}
