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
class Reportchecklist_model extends MY_Model {

    public $table = 'pp_submit';
    public $table_u = 'pp_user';
    public $table_uad = 'pp_user_assign_dept';
    public $table_sc = 'pp_submit_comments';
    public $table_ccu = 'pp_checklist_category_users';
    public $table_c = 'pp_checklist';
    public $table_s_c = 'pp_submit_checklist';
    public $table_cc = 'pp_checklist_category';
    public $table_d = 'pp_department';
    public $submit_id = NULL;
    public $finddate = '';

    function getTotalChecklist( $department_id = 0, $hospital_id = 0 ){
        $sql = "SELECT COUNT(`checklist_id`) as c, `parent_category_id` "
                . "FROM `$this->table_c` "
                . "WHERE `parent_category_id` IN( SELECT checklist_category_id "
                . "FROM `$this->table_cc` as a "
                . "INNER JOIN `$this->table_d` as b "
                . "WHERE a.`parent_category_id` = 0 AND a.department_id=$department_id AND a.avail = 1 AND b.hospital_id = $hospital_id "
                . ") GROUP BY parent_category_id";
        return $this->db->query($sql)->result(); //_array(); 
    }
    
    function getTotalSubmitChecklist( $department_id = 0, $year = 0, $month ){
        $sql = "SELECT COUNT(a.submit_id) as c, b.emotion_icon, tblc.parent_category_id, 
                DAY(b.`date_add`) as vday, b.date_add, a.checklist_id 
                FROM `pp_submit_checklist` as a 
                INNER JOIN `$this->table` as b ON a.submit_id = b.submit_id
                INNER JOIN `$this->table_c` as tblc ON tblc.checklist_id = a.checklist_id
                WHERE a.`checklist_id` IN(
                    SELECT bb.checklist_id FROM `$this->table_c` as bb WHERE `parent_category_id` 
                    IN(
                        SELECT s2.checklist_category_id FROM `$this->table_cc` as s2
                        WHERE s2.`parent_category_id` = 0 AND s2.avail = 1 AND s2.department_id = $department_id
                            )
                )
                AND YEAR (b.`date_add`) = '$year' AND MONTH(b.`date_add`) = '$month' AND a.checklist_checked = 1
                GROUP BY vday, tblc.parent_category_id";
        return $this->db->query($sql)->result(); //_array(); 
    }
    
    function getUserSubmit( $parent_category_id = 0, $date ){
        $sql = "SELECT a.*, b.user_fullname FROM `pp_submit` as a 
                INNER JOIN $this->table_u as b ON a.user_id = b.user_id 
                WHERE a.user_id IN( 
                SELECT cu.user_id FROM `pp_checklist_category_users` as cu WHERE `checklist_category_id` = $parent_category_id
                ) AND DATE (a.`date_add`) = DATE('$date') GROUP BY a.user_id";
        return $this->db->query($sql)->result_array();
    }
    
    /**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return list items
     */
    function getDepartmentOfChecklistCategory($cond = '', $whereSub = '') {
        
       $sql = "
		SELECT 
			d.department_name,
			( 
				SELECT count(cl.checklist_id) 
			 	FROM $this->table_c as cl WHERE cl.parent_category_id  = a.checklist_category_id
				GROUP BY cl.parent_category_id
			) as checklist_of_user,
			 a.checklist_category_id,
			 b.submit_id,
                         b.date_add  
			FROM `$this->table_ccu` as a 
			INNER JOIN $this->table as b ON a.user_id = b.user_id 
			INNER JOIN $this->table_cc as c ON a.checklist_category_id = c.checklist_category_id 
			INNER JOIN $this->table_d as d ON c.department_id = d.department_id 
			$cond Group BY a.checklist_category_id ";
        return $this->db->query($sql)->result(); //_array(); 
    }

    function getChecklistCategoryUsers($cond = '') {
        $finddate = ($this->finddate == '') ? date('Y-m-d') : $this->finddate;
        $sql = "
		SELECT b.*,c.emotion_icon,c.submit_id,
		( SELECT count(submit_id) FROM $this->table_sc WHERE submit_id = c.submit_id AND DATE(date_add) = DATE('" . $finddate . "') ) as comment 
		FROM `$this->table_ccu` as a INNER JOIN $this->table_u as b ON a.user_id = b.user_id 
		INNER JOIN $this->table as c ON a.user_id = c.user_id
$cond ";
        return $this->db->query($sql)->result_array();
    }

    /**
     * 
     * @param type $cond
     * @param type $num
     * @param type $offset
     * @return one item
     */
    function getItemCheckListCate($cond = '') {

        $sql = "
		SELECT a.* FROM {$this->table_cc} as a 
		$cond ";
        return $this->db->query($sql)->row_array();
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
        $sql = "
		SELECT a.*, b.user_name, b.user_fullname, 
		( SELECT count(submit_id) FROM $this->table_sc WHERE submit_id = a.submit_id) as comment 
		FROM {$this->table} as a 
		LEFT JOIN {$this->table_u} as b ON a.user_id = b.user_id 
		LEFT JOIN {$this->table_uad} as c ON b.user_id = c.user_id 
		$cond $limit
		";
        return $this->db->query($sql)->result_array();
    }

    /**
     * 
     * @param type $cond
     * @return list items
     */
    function getAllchecklistOfUser($cond = '') {

        $sql = "
		SELECT b.*, a.user_id  
		FROM {$this->table_ccu} as a 
		LEFT JOIN {$this->table_c} as b ON a.checklist_category_id = b.checklist_category_id 
		$cond GROUP BY b.checklist_id
		";
        return $this->db->query($sql)->result_array();
    }

    /**
     * 
     * @param type $cond
     * @return list items
     */
    function getAllSubmitChecklistOfUser($cond = '') {

        $sql = "
		SELECT a.user_id, b.*, c.checklist_category_id 
		FROM {$this->table} as a 
		LEFT JOIN {$this->table_s_c} as b ON a.submit_id = b.submit_id 
		LEFT JOIN {$this->table_c} as c ON b.checklist_id = c.checklist_id 
		$cond 
		";
        return $this->db->query($sql)->result_array();
    }

    function countItems($cond = '') {
        $sql = "SELECT c.submit_id FROM {$this->table} $cond";
        return $this->db->query($sql)->num_rows();
    }

    /**
     * [insert or update item]
     * @param type $data
     * @return boolean
     */
    function insertItem($data = NULL) {
        if ($data == NULL)
            return;
        return $this->db->insert($this->table, $data);
    }

    function updateItem($data = NULL) {
        if ($data == NULL)
            return;
        return $this->db->update($this->table, $data, array('submit_id' => $this->submit_id));
    }

    /**
     * 
     * @param type $id
     * @return boolean
     */
    function removeItem() {
        if ($this->submit_id == NULL)
            return;
        return $this->db->delete($this->table, array('submit_id' => $this->submit_id));
    }

    function getItemsByConds($cond = '') {
        $sql = "SELECT * FROM " . $this->table . " $cond";
        return $this->db->query($sql)->result_array();
    }

    function getAll($cond = '') {
        $sql = "SELECT * FROM $this->table $cond";
        return $this->db->query($sql)->result();
    }

    function getChecklistCategoryId($cond = '') {
        $sql = "
		SELECT e.checklist_category_id 
		FROM {$this->table} as a 
		INNER JOIN {$this->table_s_c} as d ON d.submit_id = a.submit_id 
		INNER JOIN {$this->table_c} as e ON d.checklist_id = e.checklist_id 
		 $cond
		GROUP BY e.checklist_category_id  
		";
        return $this->db->query($sql)->row();
    }

    //situation (tình hình công việc)
    function getStatusSituation($cond = '') {

        $sql = "
		SELECT a.*, b.checklist_category_id, c.user_id, b.title 
		FROM {$this->table_s_c} as a 
		INNER JOIN {$this->table_c} as b ON a.checklist_id = b.checklist_id 
		INNER JOIN {$this->table} as c ON a.submit_id = c.submit_id 
		 $cond
		ORDER BY b.checklist_category_id ASC
		";
        return $this->db->query($sql)->result();
    }

    function getStatusSituationListNotice($cond = '', $finddate = NULL) {
        /*
          $sql = "
          SELECT a.*, (
          SELECT b.checklist_checked FROM $this->table_s_c as b
          LEFT JOIN $this->table as c ON c.submit_id = b.submit_id
          WHERE a.checklist_id=b.checklist_id AND DATE(c.date_add) = DATE('" . $finddate . "')
          GROUP BY b.checklist_id ORDER BY b.id DESC
          )
          as  checklist_checked,
          (
          SELECT u.user_fullname FROM $this->table_s_c as b
          LEFT JOIN $this->table as c ON c.submit_id = b.submit_id
          LEFT JOIN $this->table_u as u ON c.user_id=u.user_id
          WHERE a.checklist_id=b.checklist_id AND DATE(c.date_add) = DATE('" . $finddate . "')
          ) as  user_fullname

          FROM $this->table_c as a
          $cond
          ORDER BY a.checklist_category_id ASC
          ";
         */
        $sql = "
				SELECT a.*, (
				SELECT b.checklist_checked FROM $this->table_s_c as b 
				LEFT JOIN $this->table as c ON c.submit_id = b.submit_id 
				WHERE a.checklist_id=b.checklist_id AND DATE(c.date_add) = DATE('" . $finddate . "')
				GROUP BY b.checklist_id ORDER BY b.id DESC
				) 
				as  checklist_checked,
				u.user_fullname
				FROM $this->table_c as a 
				
				LEFT JOIN $this->table_ccu as ccu ON ccu.checklist_category_id = a.parent_category_id 
				LEFT JOIN $this->table_u as u ON u.user_id = ccu.user_id 				
				$cond 
				ORDER BY a.checklist_category_id ASC
		";

        /* $sql = "SELECT a.*, u.user_fullname, b.checklist_checked
          FROM pp_checklist as a
          LEFT JOIN pp_submit_checklist as b ON a.checklist_id = b.checklist_id
          LEFT JOIN pp_submit as c ON c.submit_id = b.submit_id
          LEFT JOIN pp_user as u ON c.user_id=u.user_id
          $cond
          ORDER BY a.checklist_category_id ASC";
          ///echo '<br>'; */
        return $this->db->query($sql)->result();
    }

    public function getChecklistCateSub($cond = '') {
        $sql = "
				SELECT a.checklist_category_id, a.checklist_category
				FROM $this->table_cc as a 
				$cond
				ORDER BY a.checklist_category ASC
		";
        return $this->db->query($sql)->result();
    }

}
