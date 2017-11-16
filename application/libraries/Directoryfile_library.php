<?php

Class DirectoryFile_library
{
    var $CI = ''; 
    function __construct()
    {
        $this->CI = & get_instance();
        
        
    }
    
    function directoryFile($pathType=''){
        $year  = date('Y'); 
        $month = date('m'); 
        $day   = date('d'); 

        $file_path_year = $pathType.'/'. $year;
        if (! file_exists($file_path_year)) { mkdir($file_path_year,0777, TRUE); }

        $file_path_month = $file_path_year .'/'.  $month;
        if (! file_exists($file_path_month)) { mkdir($file_path_month,0777, TRUE); }

        $file_path_day = $file_path_month .'/'.  $day ; 
        if (! file_exists($file_path_day)) { mkdir($file_path_day,0777, TRUE);}

        $new_path = $year.'/'.$month.'/'.$day;
        
        return $arr = array(
            'file_path_day' => $file_path_day, 
            'new_path'      => $new_path, 
        ); 
    }
    
    
    
}