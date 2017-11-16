<?php
/**
* Library Agency_chart
* Last update 02 Mar 2017
* 
* @package library
* @copyright AirTrippy
* @author contact@panpic.vn
* @author position: PHP Developer
* @since 02 Mar 2017
*/


class Agency_chart {
    
    var $CI = ''; 
    
    
    function __construct()
    {
        $this->CI = & get_instance();
    }
    
    function arrChooseDayLable() {
        return array(
            1 => 'Chọn ngày'
        );
    }
    
    function arrTourAgencyLable() {
        return array(
            1 => 'Xem trang tour',
            2 => 'Xem trang nhà cung cấp'
        );
    }
    
    function arrTypesLable() {
        return array(
            1 => 'Lượt xem',
            2 => 'Lượt so sánh',
            4 => 'Lượt gọi',
            5 => 'Yêu cầu gọi lại'
        );
    }
    
    
    function arrTypesOthers() {
        return array(
            1 => 'Xem nhiều nhất',
            2 => 'So sánh nhiều nhất',
            3 => 'Like nhiều nhất',
            4 => 'Yêu cầu gọi lại nhiều nhất',
            5 => 'Gọi nhiều nhất',
        );
    }
    
    function arrMonthLable() {
        return array(
            1  => 'Jan',
            2  => 'Feb',
            3  => 'Mar',
            4  => 'Apr',
            5  => 'May',
            6  => 'Jun',
            7  => 'Jul',
            8  => 'Aug',
            9  => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        );
    }
    
    function sortArrayViewByTours($arr_tour, $arr_view, $current_month) {
        
        $temp = array();
        foreach ($arr_tour as $tour_id) { 
            
            $temp_view = array('view'=>0);
            foreach($arr_view as $vl) {
                if($vl['month'] == $current_month && $vl['tour_id'] == $tour_id) {
                    $temp_view = $vl;
                } 
            } 
            
            $temp[$tour_id] = $temp_view;
        }
        
        return $temp;
    }


    function sortArrayTours($tour_id, $arr) {
        if(!$tour_id || ! $arr) return ;

        $temp = array();
        foreach ($arr as $vl) {
            if($vl['tour_id'] == $tour_id) {
                $temp[$vl['types']] = $vl['total_view'];
            }
        }

        return $temp;
    }

    
}

