<?php

/**
 * Model Backend
 * Last update 10 Jan 2017
 * 
 * @package backend
 * @copyright AirTrippy
 * @author contact@panpic.vn
 * @author pos: PHP Developer
 * @since 10 Jan 2017
 */
class Visitor_model extends MY_Model {

    private $_end_user = 'end_user';

    function table_end_user() {
        return $this->_end_user;
    }

    public function items() {
        $sql = "SELECT id,user_sku,concat_ws(' ',first_name,middle_name,last_name) AS name,email,last_update FROM $this->_end_user 
		";
        return $this->db->query($sql)->result_array();
    }

    public function countItem($cond = '') {
        $sql = "SELECT COUNT(id) AS total FROM $this->_end_user
	    	        $cond ";
        return $this->db->query($sql)->row()->total;
    }

    public function fetch_items($cond = '', $limit ='', $start = 0) {
        $limitt = ($limit) ? " LIMIT $start , $limit " : "";
        $sql = "SELECT id ,concat_ws(' ',first_name,middle_name,last_name) AS name,email,last_update FROM $this->_end_user $cond
                ORDER BY id DESC $limitt";

        return $this->db->query($sql)->result_array();
    }

    public function updateItem($id, $params) {
        $this->db->where('id', $id);
        return $this->db->update($this->table_end_user(), $params);
    }

    public function deleteItem($where) {
        if (!$where)
            return;
        $this->db->where($where);
        return $this->db->delete($this->table_end_user());
    }

}
