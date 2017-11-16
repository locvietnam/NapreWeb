<?php
/**
* Model Backend language
* Last update 20 June 2017
* 
* @package backend
* @copyright AirTrippy
* @author 
* @author position: PHP Developer
* @since 20 June 2017
*/

class Message_model extends MY_Model
{
	public $table = 'pp_message';
	public $table_mes_rece = 'pp_message_received';
	public $user_id_received = 0, $message_id = 0;
	
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
		SELECT 
		b.*, DATE_FORMAT(b.date_add,'%Y-%m-%d %h:%i %p') as fdate_add, DATE_FORMAT(b.date_add,'%h:%i %p') as ftime,
		a.user_id_received 
		FROM {$this->table_mes_rece} as a 
		LEFT JOIN {$this->table} as b ON a.message_id = b.id 
		$cond ORDER BY b.date_add DESC $limit
		";
                
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        $sql = "
		SELECT a.message_id FROM {$this->table_mes_rece} as a 
		LEFT JOIN {$this->table} as b ON a.message_id = b.id 
		$cond 
		";
        return $this->db->query($sql)->num_rows();  
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
    function insertItemMesRece( $data = '' ){
        if(!$data) return ;         
    	$this->db->insert($this->table_mes_rece, $data); 
		return $this->db->insert_id();
    }
	
	/**
     * [update item]
     * @param type $data
     * @return boolean
     */
    function updateItem( $data = NULL ){
		if( $data == NULL || $this->user_id_received == 0 ) return ; 
        return $this->db->update( $this->table_mes_rece, $data, array( 'user_id_received' => $this->user_id_received, 'received_viewed' => '0' )); 
    }
	
	/**
     * 
     * @param type $user_id_received
     * @return boolean
     */
    function removeItemMess( ){
		if( $this->user_id_received == 0 && $this->message_id == 0 ) return ; 
        return $this->db->delete($this->table_mes_rece, array('user_id_received' => $this->user_id_received, 'message_id' => $this->message_id ) );
    }
    
}