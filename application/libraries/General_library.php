<?php

/**
* Library General variable
* Last update 11 Jan 2017
* 
* @package library
* @copyright AirTrippy
* @author contact@panpic.vn
* @author position: PHP Developer
* @since 10 Jan 2017
*/

class General_library {

    var $CI = ''; 
    
    /**
     * Checkbox checked
     * @string checked=1 
     * @var array
     */
    public $arr_starting_date = array(
        'day_amount' => array('day_amount'=>'','checked'=>''),
        'night_amount' => array('night_amount'=>'','checked'=>''),
        'day_date' => array('day_date'=>'','checked'=>0),
        'is_daily' => array('is_daily'=>'','checked'=>0),
        'is_day_of_week' => array('is_day_of_week'=>'','checked'=>0),
        'is_other' => array('is_other'=>'','checked'=>0)
    );
    
    
    function __construct()
    {
        $this->CI = & get_instance();
    }
    
    /**
     * Define Constant in database
     * @return array
     */
    function general() {
        return array(
            'service'   => 'Dịch vụ',
            'hotel'     => 'Khách sạn', 
            'tour_day'  => 'Ngày',
            'tour_night'=> 'Đêm',
            'transport'  =>'Phương tiện',
            'dayofweek'  => 'Hàng tuần',
            'des_suggest'=> 'Địa điểm gợi ý'
        );
    }
    
    
    /**
     * Parse Tour starting Date
     * 
     * @param array $params
     * @return array
     */
    function tourStartingDate($params){
        
        $this->arr_starting_date['day_amount'] = array(
                'day_amount'  => $params['day_amount'],
                'checked'   => '',
            );
        
        $this->arr_starting_date['night_amount'] = array(
                'night_amount'  => $params['night_amount'],
                'checked'   => '',
            );
        
        if($params['day_date'] != NULL) {
            $this->arr_starting_date['day_date'] = array(
                'day_date'  => $params['day_date'],
                'checked'   => 1,
            );
        }
        
        if($params['is_daily'] == 1) {
            $this->arr_starting_date['is_daily'] = array(
                'is_daily'  => $params['is_daily'],
                'checked'   => 1,
            );
        }
        
        if($params['is_day_of_week'] == 1) {
            $this->arr_starting_date['is_day_of_week'] = array(
                'is_day_of_week'  => $params['is_day_of_week'],
                'checked'   => 1,
            );
        }
        
        if($params['is_other'] != NULL) {
            $this->arr_starting_date['is_other'] = array(
                'is_other'  => $params['is_other'],
                'checked'   => 1,
            );
        }
        
        return $this->arr_starting_date;
    }
    
    
}    
