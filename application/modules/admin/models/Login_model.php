<?php
class Login_model extends MY_Model
{
    
    public $table = 'pp_user';
    
    public $id;


    /*
     * lay thong tin thanh vien
     */
    public function get_info_user($where = array())
    {
        //tao dieu kien cho cau truy van
        
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->row();
        
    }
    
    
    function getItemByCond($cond) {
        $sql = "SELECT * FROM $this->table WHERE $cond";
        return $this->db->query($sql)->row();
    }

    
    public function updateItem($params) {
        
        $this->db->trans_begin();
        
        $this->db->where('user_id', $this->id);
        $this->db->update($this->table, $params);
            
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback(); 
            return FALSE; 
        } else {
            $this->db->trans_commit(); 
            return TRUE; 
        }
    }

}