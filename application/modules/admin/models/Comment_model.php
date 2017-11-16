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

class Comment_model extends MY_Model
{
    
    public $table = 'pp_submit_comments';
	public $table_u_a_d = 'pp_user_assign_dept';
	public $table_s = 'pp_submit';
	public $table_u = 'pp_user';
	public $table_dept = 'pp_department';
	
	
    
    public $id = NULL; 
    
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
		SELECT a.*, DATE_FORMAT(a.date_add,'%Y/%m/%d %h:%i %p') as fdate_add, c.user_fullname, d.user_fullname as manager_fullname, DATE_FORMAT(a.date_add,'%h:%i %p') as ftime 
		FROM {$this->table} as a 
		LEFT JOIN $this->table_s as b ON a.submit_id = b.submit_id
		LEFT JOIN $this->table_u as c ON b.user_id = c.user_id
		LEFT JOIN $this->table_u as d ON a.manager_id = d.user_id
		LEFT JOIN $this->table_u_a_d as e ON b.user_id = e.user_id
		$cond ORDER BY a.id ASC $limit
		";
		//die;    
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        
		$sql = "
		SELECT a.id
		FROM {$this->table} as a 
		LEFT JOIN $this->table_s as b ON a.submit_id = b.submit_id
		LEFT JOIN $this->table_u as c ON b.user_id = c.user_id
		LEFT JOIN $this->table_u as d ON a.manager_id = d.user_id
		LEFT JOIN $this->table_u_a_d as e ON b.user_id = e.user_id
		$cond 
		";
		
        return $this->db->query($sql)->num_rows();  
    }
    
	
	/**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getOne( $cond='' ){
        
       	$sql = "
		SELECT b.department_name
		FROM {$this->table_u_a_d} as a 
		LEFT JOIN $this->table_dept as b ON a.department_id = b.department_id
		LEFT JOIN $this->table_s as c ON c.user_id = a.user_id
		$cond 
		";
		//die;    
        return $this->db->query($sql)->row(); 
    }
	
	function getOneById( $cond='' ){
        
       	$sql = "
		SELECT a.*
		FROM {$this->table} as a 
		$cond 
		";
		//die;    
        return $this->db->query($sql)->row(); 
    }
   
   
   /**
     * [insert]
     * @param type $data
     * @return last insert id
     */
    function insertItem( $data = '' ){
        if(!$data) return ;         
    	$this->db->insert($this->table, $data); 
		return $this->db->insert_id();
    }
	
}