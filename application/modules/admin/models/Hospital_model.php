
<?php
/**
* Model Backend Hospital
* Last update 8 Jun 2017
* 
* @package backend
* @copyright A-Line
* @author Panpic-team
* @author position: PHP Developer
* @since 8 Jun 2017
*/

class Hospital_model extends MY_Model
{
    
    var $table = 'pp_hospitals';
    public $id = 0;
    
  
    function getItemById( ){
        if( (int) $this->id == 0 )
            return null;
        
        $sql = "SELECT * FROM $this->table AS a WHERE a.hospital_id = $this->id ";        
        return $this->db->query($sql)->row();
    }
    
    
    /**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getItems($cond = '', $num = '', $offset = '') {

        $limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";

        $sql = "SELECT a.* FROM {$this->table} AS a $cond ORDER BY a.hospital_name ASC $limit";

        return $this->db->query($sql)->result_array();
    }

    function countItems($cond = '') {
        $sql = "SELECT * FROM {$this->table} AS a $cond ";
        return $this->db->query($sql)->num_rows();
    }
    
    /**
     * 
     * @param type $cond
     * @return item
     */
    function getItem($cond = '') {

        $sql = "SELECT a.* FROM {$this->table} AS a $cond ";
        return $this->db->query($sql)->row();
    }
    
    /**
     * [insert or update item]
     * @param type $data
     * @return boolean
     */
    function insertItem($data = '') {
        if (!$data)
            return;
        $this->id = $data['hospital_id'];
        if ($this->id) {
            return $this->db->update($this->table, $data, array('hospital_id' => $this->id));
        } else {
            return $this->db->insert($this->table, $data);
        }
    }

    function updateItem($data = '') {
        if (!$this->id)
            return;
        return $this->db->update($this->table, $data, array('hospital_id' => $this->id));
    }

    /**
     * 
     * @param type $id
     * @return boolean
     */
    function removeItem() {
        if (!$this->id)
            return;
        $u = $this->getItemById();
        if ($u->avail == 1) {
            $data['avail'] = 0;
            $status = $this->updateItem($data);
        } else if ($u->avail == 0) {
            return $this->db->delete($this->table, array('hospital_id' => $this->id));
        }
    }
    
}