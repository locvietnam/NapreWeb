<?php


/**
 * 
 * tao ra cac link trong modules user
 * 
 */ 
function user_url($url = '')
{
    return base_url('user/'.$url);
}


function explode_cookie_user($cookie) {
    return explode('-', base64_decode($cookie));
}


function user_url_convert($str) {
    
    if(!$str) return; 

    $str = trim($str);
    $unicode = array( 
        'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'), 
        'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'), 
        'd'=>array('đ'), 
        'D'=>array('Đ'), 
        'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'), 
        'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'), 
        'i'=>array('í','ì','ỉ','ĩ','ị'), 
        'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'), 
        'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'), 
        '0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'), 
        'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'), 
        'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'), 
        'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'), 
        'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'), 
        '-'=>array(';','.','.','/', '#', '--', ':'), 
        ''=>array('(',')','>','<','!','?','%','“','”','"',"'",',')
    );
    
    foreach($unicode as $nonUnicode => $uni){
        foreach($uni as $value) { $str = str_replace($value,$nonUnicode,$str); }
    } 

    return strtolower(str_replace('  ','-', str_replace(' ','-', str_replace('--','-',$str))) );
}
