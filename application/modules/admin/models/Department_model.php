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

class Department_model extends MY_Model
{
    
    public $table = 'pp_department';
	public $table_md = 'pp_user_manager_dept';
	public $table_uad = 'pp_user_assign_dept';
	public $table_cc = 'pp_checklist_category';
    public $table_h = 'pp_hospitals';
	
    public $department_id = NULL; 
    
	
    function getById( $department_id = 0 ){
		if((int)$department_id > 0 )
      		$this->department_id = $department_id;
		
		if((int)$this->department_id == 0 ){
			return 0;
		}
        $sql = "SELECT c.* FROM {$this->table} c WHERE department_id = $this->department_id LIMIT 0,1";
        $this->db->simple_query('SET NAMES \'utf8_general_ci\'');
        return $this->db->query($sql)->result_array(); 
    }
	
    function getItemsByConds( $cond = '' ) { 
        $sql = "SELECT * FROM " . $this->table . " $cond";
        return $this->db->query($sql)->result_array();
    }
    
    
    function getAll( $cond = '' ) { 
        $sql = "
		SELECT a.*, c.hospital_name FROM $this->table as a 
		LEFT JOIN $this->table_md as b ON a.department_id = b.department_id 
        LEFT JOIN $this->table_h as c ON a.hospital_id = c.hospital_id 
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
        
        $sql = "SELECT c.*, d.role_name FROM {$this->table} c $cond ORDER BY name ASC $limit";
                
        return $this->db->query($sql)->result_array(); 
    }
    
    
    function countItems( $cond = '' ){ 
        $sql = "SELECT c.name FROM {$this->table} $cond";
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
    
    function updateItem( $data = NULL ){
		if( $data == NULL ) return ; 
        return $this->db->update( $this->table, $data, array( 'department_id' => $this->department_id )); 
    }
    
	
	
    function getCountChecklistCate( $cond = '' ){ 
		$sql = "SELECT count(checklist_category_id) as total FROM {$this->table_cc} $cond";
		$d = $this->db->query($sql)->result_array(); 
		$total = 0;
		if( is_array( $d ) )
			$total = $d[0]['total'];
		return  $total ; 
    }
    /**
     * 
     * @param type $id
     * @return boolean
     */
    
    function removeItem(){
		if( $this->department_id == NULL ) return ; 
		$this->db->delete($this->table_md, array('department_id' => $this->department_id ) );
		$this->db->delete($this->table_uad, array('department_id' => $this->department_id ) );
		$this->db->delete($this->table_cc, array('department_id' => $this->department_id ) );
        return $this->db->delete($this->table, array('department_id' => $this->department_id ) );
    }


    function monthJapanese() {

        $month = date('n');
        $arr = array(
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
            6 => '',
            7 => '',
            8 => '',
            9 => '月',
            10 => '月',
            11 => '',
            12 => ''
        );

        return $arr[(int)$month];
    }


    /**
     * @param $day = date('N');
     *
     * @return day name
     */
    function dayOfJapanese($day) {
        if($day == '') return;
        $arr = array(
            1 => '月',
            2 => '火',
            3 => '水',
            4 => '木',
            5 => '金',
            6 => '土',
            7 => '日'
        );

        return $arr[(int)$day];
    }



}