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

class Users_model extends MY_Model
{
    
    public $table = 'pp_user';
    public $table_role = 'pp_user_role';
	public $table_a_d = 'pp_user_assign_dept';
    
    public $id = ''; 
    public  $_pathThumb  = '';
    public  $_pathLogo   = '';
    private $_admin = 'pp_user';
    private $table_s = 'pp_sessions';
    
    function table_admin(){
        return $this->_admin; 
    }
    
    function getItemsByConds($cond='') { 
        $sql = "SELECT * FROM ".$this->table_admin()." $cond";
        return $this->db->query($sql)->result_array();
    }
    
    
    function getAllRoles($cond='') { 
        $sql = "SELECT * FROM $this->table_role $cond";
        return $this->db->query($sql)->result();
    }
	
	function getAll($cond='') { 
        $sql = "
		SELECT a.*,s.last_activity FROM {$this->table_admin()} as a 
		LEFT JOIN $this->table_a_d as b ON b.user_id = a.user_id 
        LEFT JOIN $this->table_s as s ON a.user_id = s.user_id
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
    function getItems($cond='', $num='', $offset=''){
        
        $limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";
        
        $sql = "SELECT c.*, d.role_name,s.last_activity FROM {$this->table_admin()} AS c 
        LEFT JOIN $this->table_role AS d ON  d.role_id = c.role_id 
        LEFT JOIN $this->table_s AS s ON c.user_id = s.user_id
        $cond ORDER BY date_add DESC $limit";

        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems($cond=''){ 
       $sql = "SELECT c.user_id FROM {$this->table_admin()} AS c 
       LEFT JOIN $this->table_role AS d ON  d.role_id = c.role_id 
       LEFT JOIN $this->table_s as s ON c.user_id = s.user_id
       $cond ";
        return $this->db->query($sql)->num_rows();  
    }
    
    function getInfo(){ 
        if(!$this->id) return; 
		
		$tabel_name = $this->table_admin();
		$this->db->select($tabel_name . '.*,' . $this->table_role . '.role_name');
		$this->db->from( $tabel_name );
		$this->db->join($this->table_role, $this->table_role . '.role_id = ' . $tabel_name . '.role_id');
		$this->db->where( array('user_id' => $this->id) );
		$query = $this->db->get();
		
       /// $query = $this->db->get_where($this->table_admin(), array('user_id' => $this->id));
        //echo $this->db->last_query(); 
        return $query->row();//_array();
    }
	
	
	/**
     * 
     * @param type $cond
     * @return item
     */
    function getItem( $cond = '' ){
        
        $sql = "SELECT a.*, b.role_name FROM {$this->table_admin()} AS a 
		INNER JOIN $this->table_role AS b ON  b.role_id = a.role_id $cond 
		";
        return $this->db->query($sql)->row(); 
    }
    
    /**
     * [insert or update item]
     * @param type $data
     * @return boolean
     */
    function insertItem($data=''){
        if(!$data) return ; 
        $user_id = $data['user_id'];
        if($user_id){
            return $this->db->update($this->table_admin(), $data, array('user_id' => $user_id)); 
        } else {
            return $this->db->insert($this->table_admin(), $data); 
        }
    }
    
    function updateItem($data=''){
        if(!$this->id) return;  
        return $this->db->update($this->table_admin(),$data, array('user_id' => $this->id)); 
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