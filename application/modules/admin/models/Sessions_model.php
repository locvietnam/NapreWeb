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

class Sessions_model extends MY_Model
{
    
    public $table = 'pp_sessions';
    
    /**
     * 
     * @param type $cond
     * @return item
     */
    function getItem( $cond = '' ){        
        $sql = "SELECT a.* FROM $this->table AS a $cond ";
        return $this->db->query($sql)->row(); 
    }
    
    /**
     * [insert or update item]
     * @param type $data
     * @return boolean
     */
    function insertItem( $data='' ){
        if(!$data) return ; 
        $user_id = (int)$data['user_id'];
        if($this->getItem(" Where a.user_id = $user_id")){
            return $this->db->update($this->table, $data, array('user_id' => $user_id)); 
        } else {
            return $this->db->insert($this->table, $data); 
        }
    }
    
    function updateItem($data=''){
        if(!$this->id) return;  
        return $this->db->update($this->table,$data, array('user_id' => $this->id)); 
    }
    
    /**
     * 
     * @param type $id
     * @return boolean
     */
    
    function removeItem(){
        if(!$this->id) return; 		
		$u = $this->getInfo();
		if( $u->avail == 1 ){
			$data['avail'] = 0;
			$status = $this->updateItem($data);
		}
		else if($u->avail == 0) {
        	return $this->db->delete($this->table_admin(), array('user_id' => $this->id));
		}
    }
    
}