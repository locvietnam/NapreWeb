<?php
/**
* Model Backend language
* Last update 8 Jun 2017
* 
* @package backend
* @copyright A-Line
* @author Panpic team
* @author position: PHP Developer
* @since 8 Jun 2017
*/

class Lang_model extends CI_Model
{
    
    var $table = 'pp_lang_values';
    
    function items() {
        $sql = "SELECT name, value FROM $this->table WHERE lang ='ja'";
        $obj = $this->db->query($sql)->result();
        
        foreach ($obj as $vl){
            $tmp[$vl->name] = $vl->value;
        }
        
        return $tmp;
    }
    
}    
