<?php
/**
* Model Backend language
* Last update 27 June 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 27 June 2017
*/

class Report_model extends MY_Model
{
	public $table = 'pp_today_report';
	public $table_rd = 'pp_today_report_desc';
	public $table_u = 'pp_user';
	public $id = 0;
	
	/**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getItems( $cond = '', $num = '', $offset = '' ){
        
        $limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";
        
        $sql = "
		SELECT a.*,b.user_fullname, DATE_FORMAT(a.date_add,'%Y-%m-%d %h:%i %p') as fdate_add, 
		DATE_FORMAT(a.date_add,'%h:%i %p') as ftime 
		FROM {$this->table} as a 
		INNER JOIN {$this->table_u} as b ON a.manager_id = b.user_id
		$cond ORDER BY a.date_add DESC $limit
		";
                
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        $sql = "
		SELECT a.id FROM {$this->table} as a 
		INNER JOIN {$this->table_u} as b ON a.manager_id = b.user_id
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
    function getItemsRD( $cond = '' ){
        $sql = "
		SELECT a.*
		FROM {$this->table_rd} as a 
		$cond 
		";                
        return $this->db->query($sql)->result_array(); 
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
	
	/**
     * [insert]
     * @param type $data
     * @return last insert id
     */
    function insertItemRD( $data = '' ){
        if(!$data) return ;         
    	$this->db->insert($this->table_rd, $data); 
		return $this->db->insert_id();
    }
	
	/**
     * [update item]
     * @param type $data
     * @return boolean
     */
    function updateItem( $data = NULL ){
		if( $data == NULL || $this->user_id_received == 0 ) return ; 
        return $this->db->update( $this->table_rd, $data, array( 'user_id_received' => $this->user_id_received, 'received_viewed' => '0' )); 
    }
    
}