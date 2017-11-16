<?php

/**
* Library Nested Algorilthm
* Last update 17 Jan 2017
* 
* @package library
* @copyright AirTrippy
* @author contact@panpic.vn
* @author position: PHP Developer
* @since 17 Jan 2017
*/

class Nestedtourdestination_library {

    var $CI = ''; 
    function __construct()
    {
        $this->CI = & get_instance();
    }
    

    /**
     * combobox career nested
     *
     * @param array mix $data
     * @param string $action
     * @param int $id_edit
     * @param array row $row
     * @return string
     */
    function cmbNested($data, $action = '', $id_edit = '', $row = '') {
        $cat_name = '';
        $cmb = '';
        $arr = array();
        
        
        //pre($data); 
        if (sizeof($data) > 0)
            foreach ($data as $key => $val) {

                $id = $val['tour_destination_id'];
                $parents = $val['parents'];
                $level = $val['level'];
                $lft = $val['lft'];
                $rgt = $val['rgt'];
                $levelCss = '';

                if ($action == 'edit' && $id_edit == $id) {
                    $tour_destination_id = $val['tour_destination_id'];
                    $cat_name = $val['cat_name'];
                    $cat_name_lable = $val['cat_name_lable'];
                    $starting_latitude = $val['starting_latitude'];
                    $starting_longtitude = $val['starting_longtitude'];
                    $seo_title = $val['seo_title'];
                    $seo_keyword = $val['seo_keyword'];
                    $seo_description = $val['seo_description'];
                }


                if ($level == 0) {
                    $name = '<span style="color:red">--- ' . $val['cat_name'] . ' ---</span>';
                } else if ($level == 1) {
                    $name = '<b>+ ' . $val['cat_name'] . '</b>';
                } else {
                    $name = $this->stringChar($val['level']) . $val['cat_name'];
                    $levelCss = 'padding-left:' . (5 * $val['level']) . 'px;';
                }

                if ($action == 'edit' && !empty($row) && $id == $row['parents']) {
                    $selected = 'selected="selected"';
                } elseif ($action == 'sub' && !empty($row) && $id == $id_edit) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }

                $cmb .= '<option value="' . $id . '" ' . $selected . ' style="' . $levelCss . '">' . $name . '</option>';
            }

        if ($cat_name != '') {
            $arr['tour_destination_id'] = $tour_destination_id;
            $arr['cat_name'] = stripslashes($cat_name);
            $arr['cat_name_lable'] = stripslashes($cat_name_lable);
            $arr['starting_latitude'] = $starting_latitude;
            $arr['starting_longtitude'] = $starting_longtitude;
            $arr['seo_title'] = stripslashes($seo_title);
            $arr['seo_keyword'] = $seo_keyword;
            $arr['seo_description'] = stripslashes($seo_description);
        }

        $arr['cmb'] = $cmb;
        return $arr;
    }

    
    function cmbNoRoot($data, $action = '', $id_edit = '') {
        $cmb = '';
        $arr = array();

        if (sizeof($data) > 0) {
            foreach ($data as $key => $val) {

                $id = $val['tour_destination_id'];
                $cat_name = stripslashes($val['cat_name']);
                $level = $val['level'];
                $levelCss = '';

                if ($level > 0) {
                    if ($level == 1) {
                        $name = $cat_name;
                    } else {
                        $name = $this->stringChar($val['level']) . $hscode_world . ' &nbsp; ' . $cat_name;
                        $levelCss = 'padding-left:' . (5 * $val['level']) . 'px;';
                    }

                    $selected = ($action == 'sub' && $id == $id_edit) ? 'selected="selected"' : '';

                    $cmb .= '<option value="' . $id . '" ' . $selected . ' style="' . $levelCss . '">' . $name . '</option>';
                }
            }

            $arr['cmb'] = $cmb;
        }

        return $arr;
    }

    /**
     * @param $tree - menu data array
     * @param $parent - 0
     * 
     * @return $arr menu true: parent node to last sub
     */
    function formatTree($tree, $parent) {
        $tree2 = null;
        foreach ($tree as $i => $item) {
            if ($item['parents'] == $parent) {
                $tree2[$item['tour_destination_id']] = $item;
                $tree2[$item['tour_destination_id']]['submenu'] = $this->formatTree($tree, $item['tour_destination_id']);
            }
        }

        return $tree2;
    }

    /**
     * string space level of category
     *
     * @param int $int
     * @return string
     */
    function stringChar($int) {
        $char = '-';
        $n = 1;
        while ($n < $int) {
            $char .= ' - ';
            $n++;
        }

        return $char;
    }

    /**
     * Categories return catID String
     *
     * @param array mix $cats
     * @return string Id
     */
    function catStringID($cats) {
        $i = 1;
        $strId = '';
        if (empty($cats))
            return;

        foreach ($cats as $vl) {
            $strId .= ($i > 1) ? ',' . $vl['tour_destination_id'] : $vl['tour_destination_id'];

            $i++;
        }

        return $strId;
    }

    /**
     * Multi Selected
     * Jan 10 2017
     * 
     * @param array mix $data
     * @param string $action
     * @param array row $id_edit
     * @param array mix $row
     * @return string
     */
    function cmbtour_destination_idLanding($data, $action = '', $id_edit, $row = '') {
        $cat_name = '';
        $cmb = '';
        $arr = array();

        if (sizeof($data) > 0)
            foreach ($data as $key => $val) {

                $id = $val['tour_destination_id'];
                $parents = $val['parents'];
                $level = $val['level'];
                $lft = $val['lft'];
                $rgt = $val['rgt'];
                $levelCss = '';

                if ($action == 'edit' && array_key_exists($id, $id_edit)) {
                    $tour_destination_id = $val['tour_destination_id'];
                    $cat_name = $val['cat_name'];
                    $cat_name_lable = $val['cat_name_lable'];
                    
                    $starting_latitude = $val['starting_latitude'];
                    $starting_longtitude = $val['starting_longtitude'];
                    $seo_title = $val['seo_title'];
                    $seo_keyword = $val['seo_keyword'];
                    $seo_description = $val['seo_description'];
                }


                if ($level == 0) {
                    $name = '<span style="color:red">--- ' . $val['cat_name'] . ' ---</span>';
                } else if ($level == 1) {
                    $name = '<b>+ ' . $val['cat_name'] . '</b>';
                } else {
                    $name = $this->stringChar($val['level']) . $val['cat_name'];
                    $levelCss = 'padding-left:' . (5 * $val['level']) . 'px;';
                }

                if ($action == 'edit' && !empty($row) && $id == $row['parents']) {
                    $selected = 'selected="selected"';
                } elseif ($action == 'sub' && array_key_exists($id, $id_edit)) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }

                $cmb .= '<option value="' . $id . '" ' . $selected . ' style="' . $levelCss . '">' . $name . '</option>';
            }

        if ($cat_name != '') {
            $arr['tour_destination_id'] = $tour_destination_id;
            $arr['cat_name'] = $cat_name;
            $arr['cat_name_lable'] = $cat_name_lable;
            $arr['starting_latitude'] = $starting_latitude;
            $arr['starting_longtitude'] = $starting_longtitude;
            $arr['seo_title'] = $seo_title;
            $arr['seo_keyword'] = $seo_keyword;
            $arr['seo_description'] = $seo_description;
        }

        $arr['cmb'] = $cmb;
        return $arr;
    }
    
    /**
     * 
     * @param type $data
     * @return string
     */
    function parseNested($data) {
        $temp = array();
        
        foreach ($data as $key => $val) {

            $tour_destination_id = $val['tour_destination_id'];
            $level = $val['level'];
            $cat_name = $val['cat_name'];
            $cat_name_lable = $val['cat_name_lable'];
            $starting_latitude = $val['starting_latitude'];
            $starting_longtitude = $val['starting_longtitude'];
            $seo_title = $val['seo_title'];
            $seo_keyword = $val['seo_keyword'];
            $seo_description = $val['seo_description'];

            if ($level > 0) {
                
                if ($level == 1) {
                    $name = '<b>+ ' . $val['cat_name'] . '</b>';
                } else {
                    $name = $this->stringChar($val['level']) . $val['cat_name'];
                    $padding = 'padding-left:' . (5 * $val['level']) . 'px;';
                }

                $val['cat'] = $name;
                $val['padding'] = $padding;
                $temp[] = $val;
            }
        }

        return $temp;
    }
    
    
    function groupSub($data) {
        $temp = array();
        
        foreach ($data as $key => $val){
            if($val['level'] == 1) {
                $val['sub'] = $this->formatTree($data, $val['tour_destination_id']);
                $temp[] = $val;
            }
        }

        return $temp;
    } 

    
}
