<?php
/**
* Model Backend Blogs
* Last update 12 Jan 2017
* 
* @package backend
* @copyright AirTrippy
* @author @contact@panpic.vn
* @author position: PHP Developer
* @since 12 Jan 2017
*/

class Blogs_model extends MY_Model
{
    
    private $_table_blog = 'blog';
    private $_table_blog_cat = 'special_locations';
    private $_table_slug    = 'blog_slug';


    public $id;
    
    function getKeyString() { return "c.id ='$this->id'"; }	
    
    
    public function get_slug_exist($slug, $blog_id='') {
        
        $cond = ($blog_id != '') ? " AND blog_id <> $blog_id " : '';
        
        $sql = "SELECT slug FROM $this->_table_slug WHERE slug = '$slug' $cond";
        $exist_slug = $this->db->query($sql)->row()->slug;
        
        if($exist_slug) {
            $exist_slug .= '-1';
            return $this->get_slug_exist($exist_slug);
        }
        
        return $slug;
    }
    
    
    /**
     * 
     * @param $id int
     * @return array
     */
    function getItemById(){
        if($this->id == '') return;
        
         $sql = "SELECT c.*, d.category AS category_name FROM $this->_table_blog AS c
                    JOIN $this->_table_blog_cat AS d ON c.category = d.id AND ".$this->getKeyString();
        return $this->db->query($sql)->row_array();
    }
    
    
    function getSlugById(){
        if($this->id == '') return;
        
         $sql = "SELECT * FROM $this->_table_slug WHERE blog_id = $this->id";
        return $this->db->query($sql)->row_array();
    }
    
    
    function insertItem($params, $param_slug=''){
        $this->db->trans_begin();
        
            $this->db->insert($this->_table_blog, $params);
            $primary = $this->db->insert_id();
            // update field
            $sku = $this->config->item('blog_sku').'-'.$primary;
            $this->db->update($this->_table_blog, array('blog_sku'=>$sku), array('id'=>$primary));
            
            if($param_slug != '') {
                $param_slug['blog_id'] = $primary;
                $this->db->insert($this->_table_slug, $param_slug);
            }
            
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback(); 
            return FALSE; 
        } else {
            $this->db->trans_commit(); 
            return $primary; 
        }
    }
    
    function updateItem($params, $param_slug='') {
        $this->db->trans_begin();
            
            $this->db->update($this->_table_blog,$params, array('id'=>$this->id));
            
            if($param_slug != '') {
                $this->db->update($this->_table_slug,$param_slug, array('blog_id'=>$this->id));
            }
            
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback(); 
            return FALSE; 
        } else {
            $this->db->trans_commit(); 
            return TRUE; 
        } 
    }
    
    
    function updateByFields($params) {
        if($this->id == '') return;
        
        return $this->db->update($this->_table_blog,$params, array('id'=>$this->id));
        
        // $sql = "UPDATE $this->_table_blog SET $fields WHERE id = $this->id";
        // return $this->db->query($sql);
    }
    
    
    function deleteItem($where) {
        if(!$where) return;
        
        $this->db->where($where); 
        return $this->db->delete($this->_table_blog);
    }
    
    
    function countItems($cond) {
        $sql = "SELECT COUNT(c.id) AS total FROM $this->_table_blog AS c
                    JOIN $this->_table_blog_cat AS d ON c.category = d.id $cond";
        
        return $this->db->query($sql)->row()->total;
    }
    
    
    function getItems($cond='', $num='', $offset=''){
        $limit = ($num > 0 ) ? "LIMIT $offset, $num" : "";
        
        $sql = "SELECT s.slug, c.*, d.category AS category_name FROM $this->_table_blog AS c
                JOIN $this->_table_slug AS s 
                    ON c.id = s.blog_id 
                JOIN $this->_table_blog_cat AS d 
                ON c.category = d.id $cond 
                ORDER BY c.date_add DESC $limit ";
        
        return $this->db->query($sql)->result('array');
    }
    
    
    function blogCategories($cond=''){
        
        $sql = "SELECT * FROM $this->_table_blog_cat $cond";
        
        return $this->db->query($sql)->result('array');
    }
    
    
    
    
    
}